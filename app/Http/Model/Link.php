<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\Link
 *
 * @property integer $link_id
 * @property string $link_name
 * @property string $link_title
 * @property string $link_url
 * @property integer $link_order
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Link whereLinkId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Link whereLinkName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Link whereLinkTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Link whereLinkUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Link whereLinkOrder($value)
 * @mixin \Eloquent
 */
class Link extends Model
{
    protected $table = 'link';
    protected $primaryKey = 'link_id';
    public $timestamps = false;
    protected $guarded = [];
}
