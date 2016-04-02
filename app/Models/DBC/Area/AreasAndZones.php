<?php

namespace App\Models\DBC\Area;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DBC\Area\AreasAndZones
 *
 * @property integer $m_ID
 * @property integer $m_ParentAreaID
 * @property string $m_AreaName_lang
 * @method static \Illuminate\Database\Query\Builder|AreasAndZones whereMID($value)
 * @method static \Illuminate\Database\Query\Builder|AreasAndZones whereMParentAreaID($value)
 * @method static \Illuminate\Database\Query\Builder|AreasAndZones whereMAreaNameLang($value)
 * @mixin \Eloquent
 */
class AreasAndZones extends Model
{
    protected $connection = "sqlite";
    protected $table = "areas_and_zones_wotlk";
    protected $primaryKey = "m_ID";
}
