<?php

namespace App\Models\DBC;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DBC\Emote
 *
 * @property integer $id
 * @property string $emote
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DBC\Emote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DBC\Emote whereEmote($value)
 * @mixin \Eloquent
 */
class Emote extends Model
{
    protected $connection = "sqlite";
    protected $table = "emotes_wotlk";
}
