<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @mixin \Eloquent
 * @property integer $id Identifier
 * @property string $username
 * @property string $sha_pass_hash
 * @property string $sessionkey
 * @property string $v
 * @property string $s
 * @property string $token_key
 * @property string $email
 * @property string $reg_mail
 * @property string $joindate
 * @property string $last_ip
 * @property string $last_attempt_ip
 * @property integer $failed_logins
 * @property boolean $locked
 * @property string $lock_country
 * @property string $last_login
 * @property boolean $online
 * @property boolean $expansion
 * @property integer $mutetime
 * @property string $mutereason
 * @property string $muteby
 * @property boolean $locale
 * @property string $os
 * @property integer $recruiter
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereShaPassHash($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereSessionkey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereV($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereS($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTokenKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRegMail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereJoindate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastIp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastAttemptIp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFailedLogins($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLocked($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLockCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereOnline($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereExpansion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereMutetime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereMutereason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereMuteby($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereOs($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRecruiter($value)
 */
class User extends Authenticatable
{
    protected $connection = "auth";
    protected $table = "account";
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'sha_pass_hash',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'sha_pass_hash', 'remember_token',
    ];

    /**
     * Getting password
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->sha_pass_hash;
    }

    /**
     * Getting username
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->username;
    }
}
