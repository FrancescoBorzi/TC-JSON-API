<?php

namespace App\Http\Controllers\World;

use App\Helpers\TCAPI;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\World\Version;
use Symfony\Component\Process\Process;

/**
 * Class EmotesController
 *
 * Managing emotes
 *
 * @package App\Http\Controllers\DBC
 */
class VersionController extends Controller
{
    private $api;

    /**
     * EmotesController constructor.
     *
     * @param TCAPI $api
     */
    public function __construct(TCAPI $api)
    {
        $this->api = $api;
    }

    /**
     * Display trinitycore database info.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Version::first();
    }

    /**
     * Display api version info.
     *
     * @return \Illuminate\Http\Response
     */
    public function getApiVersion()
    {
        $branch = "unknown";

        try {
            $process = new Process("git rev-parse --symbolic-full-name --abbrev-ref @{u}");
            $process->run();

            if ($process->isSuccessful())
                $branch = trim($process->getOutput());

        } catch(\Exception $exception) {}

        return ["api_version" => $this->api->getApiVersion(), "api_branch" => $branch];
    }
}
