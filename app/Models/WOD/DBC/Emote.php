<?php

namespace App\Models\WOD\DBC;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WOD\DBC\Emote
 *
 * @property integer $id
 * @property string $emote
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WOD\DBC\Emote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WOD\DBC\Emote whereEmote($value)
 * @mixin \Eloquent
 */
class Emote extends Model
{
    protected $connection = "sqlite";
    protected $table = "emotes_wod";
}
