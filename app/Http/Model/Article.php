<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\Article
 *
 * @property integer $art_id //主键
 * @property string $art_title //标题
 * @property string $art_tag //关键词
 * @property string $art_description //描述
 * @property string $art_thumb //缩略图
 * @property string $art_editor //编辑者
 * @property string $art_time //编辑时间
 * @property string $art_content //内容
 * @property integer $art_view //查看次数
 * @property integer $cate_id //栏目id
 * @property boolean $r_pic_id 推荐图片id
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Article whereArtId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Article whereArtTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Article whereArtTag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Article whereArtDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Article whereArtThumb($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Article whereArtEditor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Article whereArtTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Article whereArtContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Article whereArtView($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Article whereCateId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Article whereRPicId($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    protected $table = 'article';
    protected $primaryKey = 'art_id';
    public $timestamps = false;
    protected $guarded = [];
}
