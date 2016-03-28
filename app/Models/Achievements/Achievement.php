<?php

namespace App\Models\Achievements;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Achievements\Achievement
 *
 * @property integer $ID
 * @property integer $Faction
 * @property integer $Map
 * @property integer $Previous
 * @property string $Name
 * @property string $field6
 * @property string $field7
 * @property string $field8
 * @property string $field9
 * @property string $field10
 * @property string $field11
 * @property string $field12
 * @property string $field13
 * @property string $field14
 * @property string $field15
 * @property string $field16
 * @property string $field17
 * @property string $field18
 * @property string $field19
 * @property string $field20
 * @property string $field21
 * @property string $Description
 * @property string $field23
 * @property string $field24
 * @property string $field25
 * @property mixed $field26
 * @property string $field27
 * @property string $field28
 * @property string $field29
 * @property string $field30
 * @property string $field31
 * @property string $field32
 * @property string $field33
 * @property string $field34
 * @property string $field35
 * @property string $field36
 * @property string $field37
 * @property string $field38
 * @property integer $Category
 * @property integer $Points
 * @property integer $OrderInGroup
 * @property integer $Flags
 * @property integer $SpellIcon
 * @property string $Reward
 * @property string $field45
 * @property string $field46
 * @property string $Bonus
 * @property string $field48
 * @property string $field49
 * @property string $field50
 * @property string $field51
 * @property string $field52
 * @property string $field53
 * @property string $field54
 * @property string $field55
 * @property string $field56
 * @property string $field57
 * @property string $field58
 * @property string $field59
 * @property string $field60
 * @property integer $Demands
 * @property integer $ReferencedAchievement
 * @property string $icon
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereFaction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereMap($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement wherePrevious($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement wherePoints($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereOrderInGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereFlags($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereSpellIcon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereReward($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereBonus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereDemands($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereReferencedAchievement($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereIcon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField6($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField7($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField8($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField9($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField10($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField11($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField12($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField13($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField14($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField15($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField16($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField17($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField18($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField19($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField20($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField21($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField23($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField24($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField25($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField26($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField27($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField28($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField29($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField30($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField31($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField32($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField33($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField34($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField35($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField36($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField37($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField38($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField45($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField46($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField48($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField49($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField50($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField51($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField52($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField53($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField54($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField55($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField56($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField57($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField58($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField59($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement whereField60($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\Achievement withExtra($extra = false)
 * @mixin \Eloquent
 */
class Achievement extends Model
{
    protected $table = "achievement";
    protected $connection = "achievement";

    /**
     * Returning extra fields
     *
     * @param $query
     * @param bool $extra
     * @return Achievement
     */
    public function scopeWithExtra($query, $extra = false) {
        return $query->select($extra ? ['*'] :
            ['ID', 'Faction', 'Map', 'Name', 'Description', 'Category', 'Points', 'Flags', 'SpellIcon', 'icon']);
    }
}
