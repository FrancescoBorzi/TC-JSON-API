<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class CORSAccess
 *
 * Add CORS headers to all requests 
 *
 * @package App\Http\Middleware
 */
class CORSAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
