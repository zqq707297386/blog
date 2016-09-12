<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\Conf
 *
 * @property integer $conf_id
 * @property string $conf_title //配置项标题
 * @property string $conf_name //配置项变量名
 * @property string $conf_content //说明
 * @property integer $conf_order
 * @property string $conf_tips //解释
 * @property string $field_type //字段类型
 * @property string $field_value //字段值
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Conf whereConfId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Conf whereConfTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Conf whereConfName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Conf whereConfContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Conf whereConfOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Conf whereConfTips($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Conf whereFieldType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Conf whereFieldValue($value)
 * @mixin \Eloquent
 */
class Conf extends Model
{
    protected $table = 'conf';
    protected $primaryKey = 'conf_id';
    public $timestamps = false;
    protected $guarded = [];
}
