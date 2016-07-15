<?php namespace App\Http\Controllers\Auth;

use App\Extending\SHA1Hasher;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;

class AuthController extends Controller {

    use ThrottlesLogins;

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    private $hasher;

    /**
     * Create a new authentication controller instance.
     *
     * @param SHA1Hasher $hasher
     */
    public function __construct(SHA1Hasher $hasher)
    {
        $this->hasher = $hasher;

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function login(Request $request) {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return response()->json([
                "error" => "too_many_login_attempts",
                "next_request_at" => $this->secondsRemainingOnLockout($request)], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // grab credentials from the request
        $credentials = $request->only('username', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                // If the login attempt was unsuccessful we will increment the number of attempts
                // to login and redirect the user back to the login form. Of course, when this
                // user surpasses their maximum number of attempts they will get locked out.
                if ($throttles && ! $lockedOut) {
                    $this->incrementLoginAttempts($request);
                }

                return response()->json(['error' => 'invalid_credentials'], Response::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            "username" => 'required', 'password' => 'required',
        ]);
    }

    public function register(Request $request)
    {
        $this->validateRegister($request);
        $user = User::create([
            "username" => $request->get("username"),
            "sha_pass_hash" => $this->hasher->make($request->get("username") . ":" . $request->get("password")),
            "email" => $request->get("email")
        ]);
        return $user;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateRegister(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:255|unique:auth.account',
            'email' => 'required|email|max:255|unique:auth.account',
            'password' => 'required|min:6|max:255',
        ]);
    }

    /**
     * Determine if the class is using the ThrottlesLogins trait.
     *
     * @return bool
     */
    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(
            ThrottlesLogins::class, class_uses_recursive(static::class)
        );
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return "username";
    }

    /**
     * Throw the failed validation exception.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Validation\Validator $validator
     * @throws ValidationException
     */
    protected function throwValidationException(Request $request, $validator)
    {
        throw new ValidationException($validator, new JsonResponse($this->formatValidationErrors($validator),
            Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
