<?php

namespace App\Models\DBC\Achievements;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DBC\Achievements\Achievement
 *
 * @property integer $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DBC\Achievements\Achievement whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DBC\Achievements\Achievement whereName($value)
 * @mixin \Eloquent
 */
class Achievement extends Model
{
    protected $connection = "sqlite";
    protected $table = "achievements_wotlk";
}
