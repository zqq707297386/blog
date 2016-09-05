<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table     =  'category'; //自己定义数据库表名，因为不这样做，会多个S.自定义的时候不用加表前缀
    protected $primaryKey= 'cate_id';  //设置主键跟数据表一样
    public $timestamps   = false;      //因为修改数据Larvel机制会自动添加时间戳，数据表没这字段，所以禁掉,如有需要可加
    protected $guarded   = [];         //这句表示不想给某字段赋值。设置为空就表示全都赋值

    /**1:升序的方式获取数据库的数据
     * 2:本页面中用$this指向本页面的方法，范围：只限于public 如果是private 范围：private方法大括号内
     * @return array
     */
    public function tree()
    {
        $categorys = $this->orderBy('cate_order','asc')->get();
        return $this->getTree($categorys,'cate_pid',0,'cate_name','cate_id','cate_title');
    }
    /**此封装的函数在tree()方法里被调用。封装函数的好处是可移植
     * 递归查找父栏目。只有两层
     * 1：定义一个空数组，最后要返回到$this->getTree($categorys)赋给$data输入到模版里
     * 2：遍历数组
     * 3：如果有父级栏目==0的
     * 4: 先把父级栏目压进数组
     * 5：再次遍历数组。只为把子栏目压进数组
     * 6: 如果有子栏目pid==父栏目id
     * 7: 就把子栏目也装进数组里
     * 8: 最后返回处理后的数组
     * @param $data         array
     * @param $filed_pid    cate_pid
     * @param $pid          pid==0的
     * @param $filed_name   cate_name
     * @param $filed_id     cate_id
     * @param $filed_title  cate_title
     * @return array
     */
    public function getTree($data, $filed_pid, $pid, $filed_name, $filed_id, $filed_title)
    {
        $arr = array();
        foreach ($data as $k => $v)
        {
            if ($v->$filed_pid==$pid)
            {
                $data[$k]['_'.$filed_name] = $data[$k][$filed_name]; //2：这步是为了能显示出来，因为子栏目要显示多--
                $data[$k]['_'.$filed_title] = $data[$k][$filed_title];
                $arr[]=$data[$k];
                foreach ($data as $m=>$n)
                {
                    if ($n->$filed_pid==$v->$filed_id)
                    {
                        $data[$m]['_'.$filed_name] = '----'.$data[$m][$filed_name]; //1：这里只是让父栏目与子栏目有区别
                        $data[$m]['_'.$filed_title] = '- - - -'.$data[$m][$filed_title];
                        $arr[]=$data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
