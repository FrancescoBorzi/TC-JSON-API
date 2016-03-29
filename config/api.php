<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Supported versions
    |--------------------------------------------------------------------------
    |
    | Here we bind all supported versions, and setting default which used when
    | version doesn`t provide.
    |
    */

    "version" => [
        "default" => "wotlk",

        "versions" => [
            "wod" => [6, "wod", "6.x.x"],
            "wotlk" => [3, "wotlk", "3.3.5a"]
        ]
    ],
];