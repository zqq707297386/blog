<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Model\Category
 *
 * @property integer $cate_id
 * @property string $cate_name //栏目名称
 * @property string $cate_title //栏目标题
 * @property string $cate_keywords //关键词
 * @property string $cate_description //描述
 * @property integer $cate_view //查看次数
 * @property boolean $cate_order //排序
 * @property integer $cate_pid //父级ID
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Category whereCateId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Category whereCateName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Category whereCateTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Category whereCateKeywords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Category whereCateDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Category whereCateView($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Category whereCateOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Http\Model\Category whereCatePid($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    protected $guarded = [];

    /**
     * 递归找出父栏目 两层
     *
     * @return array
     */
    public function tree ()
    {
        $categorys = $this->orderBy('cate_order', 'asc')->get();
        return $this->getTree($categorys, 'cate_pid', 0, 'cate_name', 'cate_id', 'cate_title');
    }

    /**
     * @param $data
     * @param $filed_pid
     * @param $pid
     * @param $filed_name
     * @param $filed_id
     * @param $filed_title
     * @return array
     */
    public function getTree ($data, $filed_pid, $pid, $filed_name, $filed_id, $filed_title)
    {
        $arr = array();
        foreach ($data as $k => $v) {
            if ($v->$filed_pid == $pid) {
                $data[$k]['_' . $filed_name] = $data[$k][$filed_name];
                $data[$k]['_' . $filed_title] = $data[$k][$filed_title];
                $arr[] = $data[$k];
                foreach ($data as $m => $n) {
                    if ($n->$filed_pid == $v->$filed_id) {
                        $data[$m]['_' . $filed_name] = '----' . $data[$m][$filed_name];
                        $data[$m]['_' . $filed_title] = '- - - -' . $data[$m][$filed_title];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
