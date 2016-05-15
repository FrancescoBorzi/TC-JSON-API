<?php

namespace App\Models\Achievements;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Achievements\AchievementCategory
 *
 * @property integer $ID
 * @property integer $ParentID
 * @property string $Name
 * @property string $field4
 * @property string $field5
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
 * @property integer $ui_order
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereParentID($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereUiOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField4($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField5($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField6($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField7($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField8($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField9($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField10($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField11($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField12($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField13($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField14($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField15($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField16($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField17($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField18($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory whereField19($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Achievements\AchievementCategory withExtra($extra = false)
 * @mixin \Eloquent
 */
class AchievementCategory extends Model
{
    protected $table = "achievementCategory";
    protected $connection = "dbc";

    /**
     * Returning extra fields
     * 
     * @param $query
     * @param bool $extra
     * @return AchievementCategory
     */
    public function scopeWithExtra($query, $extra = false) {
        return $query->select($extra ? [] : ['ID', 'ParentID', 'Name']);
    }
}
