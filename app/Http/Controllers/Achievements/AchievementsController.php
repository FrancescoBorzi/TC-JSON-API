<?php
namespace App\Http\Controllers\Achievements;

use App\Exceptions\UnsupportedVersion;
use App\Helpers\TCAPI;
use App\Models\Achievements\Achievement;
use App\Models\Achievements\AchievementCategory;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

/**
 * Class AchievementsController
 * @package App\Http\Controllers\Achievements
 */
class AchievementsController extends Controller
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
     * Get achievements list or achievement by ID
     *
     * @param Request $request
     * @param int $id
     * @return Achievement|array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|static[]
     */
    public function getAchievements(Request $request, $id = 0) {

        $result = Achievement::withExtra($request->has('no_extra_fields'));

        if ($id)
            $result = $result->findOrFail($id);
        else {
            if ($category = $request->get("category"))
                $result->where('category', '=', $category);

            if ($faction = $request->get('faction'))
                switch ($faction) {
                    case "horde":
                        $result->where('Faction', '!=', '1');
                        break;
                    case "alliance":
                        $result->where('Faction', '!=', '0');
                        break;
                }

            $result = $result->get();
        }

        return $result;
    }

    /**
     * Get achievements categories list or category by ID
     *
     * @param Request $request
     * @param int $id
     * @return AchievementCategory|array
     */
    public function getAchievementCategories(Request $request, $id = 0) {

        $result = AchievementCategory::withExtra($request->has('no_extra_fields'));

        //backward compatibility
        $id = $id ?: $request->get("id");

        if ($id)
            $result = $result->findOrFail($id);
        else {
            //TODO::Search by other fields
            $result = $result->get();
        }

        return $result;
    }

    /**
     * Get achievements dbc information
     *
     * @param Request $request
     * @param int $id
     * @return AchievementCategory|array
     */
    public function getDbcAchievements(Request $request, $id = 0) {
        switch ($this->api->getGameVersion()) {
            case "wod": {
                if ($id)
                    $result = \App\Models\WOD\DBC\Achievements\Achievement::findOrFail($id);
                else
                    $result = \App\Models\WOD\DBC\Achievements\Achievement::all();

                break;
            }
            case "wotlk": {
                if ($id)
                    $result = \App\Models\DBC\Achievements\Achievement::findOrFail($id);
                else
                    $result = \App\Models\DBC\Achievements\Achievement::all();

                break;
            }
            default:
                throw new UnsupportedVersion();
        }

        //TODO::Search by name and supporting translate

        return $result;
    }
}