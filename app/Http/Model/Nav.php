<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\Nav
 *
 * @property integer $nav_id
 * @property string $nav_name
 * @property string $nav_alias //别名
 * @property string $nav_url
 * @property integer $nav_order
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Nav whereNavId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Nav whereNavName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Nav whereNavAlias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Nav whereNavUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Nav whereNavOrder($value)
 * @mixin \Eloquent
 */
class Nav extends Model
{
    protected $table = 'nav';
    protected $primaryKey= 'nav_id';
    public $timestamps   = false;
    protected $guarded   = [];
}
