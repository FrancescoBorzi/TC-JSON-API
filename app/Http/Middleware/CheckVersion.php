<?php

namespace App\Http\Middleware;

use App\Exceptions\UnsupportedVersion;
use App\Helpers\TCAPI;
use Closure;

class CheckVersion
{
    /**
     * CheckVersion constructor.
     * @param TCAPI $api
     */
    public function __construct(TCAPI $api)
    {
        $this->api = $api;
    }

    /**
     * Checking version
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $versions = \Config::get("api.version");

        if ($version = $request->get("version")) {

            $foundVersion = false;
            array_walk($versions['versions'], function($value, $key) use (&$foundVersion, $version) {
                if (in_array($version, $value))
                    $foundVersion = $key;
            });

            if (!$foundVersion) 
                throw new UnsupportedVersion();

            app("App\Helpers\TCAPI")->setGameVersion($foundVersion);
        } else
            $this->api->setGameVersion($versions['default']);
        
        return $next($request);
    }
}

