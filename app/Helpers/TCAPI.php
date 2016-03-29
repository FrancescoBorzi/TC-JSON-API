<?php
namespace App\Helpers;

/**
 * Information about API
 *
 * Class TCAPI
 * @package App\Helpers
 */
class TCAPI
{
    /**
     * Game version for current request, available versions in api config
     *
     * @var string
     */
    private $gameVersion = "";

    /**
     * @var string
     */
    private $apiVersion = "0.0.0";

    /**
     * @return string
     */
    public function getGameVersion()
    {
        return $this->gameVersion;
    }

    /**
     * @param string $gameVersion
     */
    public function setGameVersion($gameVersion)
    {
        $this->gameVersion = $gameVersion;
    }

    /**
     * Checking version
     *
     * @param $version
     * @return mixed
     */
    public static function is($version) {
        return hash_equals(app("App\Helpers\TCAPI")->getGameVersion(), $version);
    }
}