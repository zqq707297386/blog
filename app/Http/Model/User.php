<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\User
 *
 * @property integer $user_id
 * @property string $user_name //用户名
 * @property string $user_pass //用户密码
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\User whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\User whereUserName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\User whereUserPass($value)
 * @mixin \Eloquent
 */
class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
}
