<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\About
 *
 * @property integer $about_id
 * @property string $about_thumb 头像
 * @property string $about_name 姓名
 * @property string $about_region 地区
 * @property string $about_description 个人简介
 * @property string $about_autograph 个性签名
 * @property string $about_title //标题
 * @property string $about_content 关于我的内容
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\About whereAboutId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\About whereAboutThumb($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\About whereAboutName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\About whereAboutRegion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\About whereAboutDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\About whereAboutAutograph($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\About whereAboutTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\About whereAboutContent($value)
 * @mixin \Eloquent
 */
class About extends Model
{
    protected $table = 'about';
    protected $primaryKey = 'about_id';
    public $timestamps = false;
    protected $guarded = [];

}
