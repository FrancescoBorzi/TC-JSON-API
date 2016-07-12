<?php 
namespace App\Http\Controllers;

use App\Helpers\TCAPI;
use App\Models\World\Version;

class WelcomeController extends Controller {

    /*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

    private $tcapi = null;

    /**
     * Create a new controller instance.
     * @param TCAPI $api
     */
    public function __construct(TCAPI $api)
    {
        $this->middleware('guest');
        $this->tcapi = $api;
    }

    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return \Response
	 */
    public function index()
    {
        $tdbInfo = Version::first();
        $apiVersion = $this->tcapi->getApiVersion();

        return view('welcome', compact('tdbInfo', 'apiVersion'));
    }

}
