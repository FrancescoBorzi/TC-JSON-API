<?php

namespace App\Http\Controllers\DBC;

use App\Exceptions\UnsupportedVersion;
use App\Helpers\TCAPI;
use App\Models\DBC\Emote as EmoteWotlk;
use App\Models\WOD\DBC\Emote as EmoteWod;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class EmotesController
 *
 * Managing emotes
 *
 * @package App\Http\Controllers\DBC
 */
class EmotesController extends Controller
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
     * Display a listing of emotes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch ($this->api->getGameVersion()) {
            case "wod": {
                $result = EmoteWod::all();
                break;
            }
            case "wotlk": {
                $result = EmoteWotlk::all();
                break;
            }
            default:
                throw new UnsupportedVersion();
        }

        return $result;
    }
    
    /**
     * Display emote by id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        switch ($this->api->getGameVersion()) {
            case "wod": {
                $result = EmoteWod::findOrFail($id);
                break;
            }
            case "wotlk": {
                $result = EmoteWotlk::findOrFail($id);
                break;
            }
            default:
                throw new UnsupportedVersion();
        }

        return $result;
    }
}
