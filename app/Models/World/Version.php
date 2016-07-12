<?php

namespace App\Models\World;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\World\Version
 *
 * @property string $core_version Core revision dumped at startup.
 * @property string $core_revision
 * @property string $db_version Version of world DB.
 * @property integer $cache_id
 * @mixin \Eloquent
 */
class Version extends Model
{
    protected $connection = "world";
    protected $table = "version";
}
