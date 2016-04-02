<?php

namespace App\Http\Controllers\Areas;

use App\Models\DBC\Area\AreasAndZones as AreasAndZonesWotlk;
use App\Models\WOD\DBC\Area\AreasAndZones as AreasAndZonesWod;
use App\Models\DBC\Area\AreaTrigger as AreaTriggerWotlk;
use App\Models\WOD\DBC\Area\AreaTrigger as AreaTriggerWod;
use App\Exceptions\UnsupportedVersion;
use App\Helpers\TCAPI;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Routing\Controller;

class AreasController extends Controller
{
    private $api;

    /**
     * AchievementsController constructor.
     *
     * @param TCAPI $api
     */
    public function __construct(TCAPI $api)
    {
        $this->api = $api;
    }

    /**
     * Getting area or zone by id, without id returning all
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static[]
     */
    public function getAreaOrZone(Request $request, $id = 0) {
        switch ($this->api->getGameVersion()) {
            case "wod": {
                if ($id)
                    $result = AreasAndZonesWod::findOrFail($id);
                else
                    $result = AreasAndZonesWod::all();

                break;
            }
            case "wotlk": {
                if ($id)
                    $result = AreasAndZonesWotlk::findOrFail($id);
                else
                    $result = AreasAndZonesWotlk::all();

                break;
            }
            default:
                throw new UnsupportedVersion();
        }
        
        return $result;
    }

    public function getAreaTrigger(Request $request, $id = 0) {
        switch ($this->api->getGameVersion()) {
            case "wod": {
                if ($id)
                    $result = AreaTriggerWod::findOrFail($id);
                else
                    $result = AreaTriggerWod::all();

                break;
            }
            case "wotlk": {
                if ($id)
                    $result = AreaTriggerWotlk::findOrFail($id);
                else
                    $result = AreaTriggerWotlk::all();

                break;
            }
            default:
                throw new UnsupportedVersion();
        }

        return $result;
    }

}
