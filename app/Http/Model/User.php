<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table     = 'user';     //自己定义数据库表名，因为不这样做，会多个S.自定义的时候不用加表前缀
    protected $primaryKey='user_id';  //设置主键跟数据表一样
    public $timestamps   =false;      //因为修改数据Larvel机制会自动添加时间戳，数据表没这字段，所以禁掉
}
