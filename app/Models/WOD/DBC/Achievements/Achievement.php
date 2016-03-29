<?php

namespace App\Models\WOD\DBC\Achievements;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WOD\DBC\Achievements\Achievement
 *
 * @property integer $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WOD\DBC\Achievements\Achievement whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WOD\DBC\Achievements\Achievement whereName($value)
 * @mixin \Eloquent
 */
class Achievement extends Model
{
    protected $connection = "sqlite";
    protected $table = "achievements_wod";
}
