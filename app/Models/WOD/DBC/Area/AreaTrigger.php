<?php

namespace App\Models\WOD\DBC\Area;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WOD\DBC\Area\AreaTrigger
 *
 * @property integer $m_id
 * @property integer $m_mapId
 * @property float $m_posX
 * @property float $m_posY
 * @property float $m_posZ
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WOD\DBC\Area\AreaTrigger whereMId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WOD\DBC\Area\AreaTrigger whereMMapId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WOD\DBC\Area\AreaTrigger whereMPosX($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WOD\DBC\Area\AreaTrigger whereMPosY($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WOD\DBC\Area\AreaTrigger whereMPosZ($value)
 * @mixin \Eloquent
 */
class AreaTrigger extends Model
{
    protected $connection = "sqlite";
    protected $table = "areatriggers_wod";
    protected $primaryKey = "m_id";
}
