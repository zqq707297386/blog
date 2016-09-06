<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table     =  'category';
    protected $primaryKey= 'cate_id';
    public $timestamps   = false;
    protected $guarded   = [];

    public function tree()
    {
        $categorys = $this->orderBy('cate_order','asc')->get();
        return $this->getTree($categorys,'cate_pid',0,'cate_name','cate_id','cate_title');
    }

    public function getTree($data, $filed_pid, $pid, $filed_name, $filed_id, $filed_title)
    {
        $arr = array();
        foreach ($data as $k => $v)
        {
            if ($v->$filed_pid==$pid)
            {
                $data[$k]['_'.$filed_name] = $data[$k][$filed_name];
                $data[$k]['_'.$filed_title] = $data[$k][$filed_title];
                $arr[]=$data[$k];
                foreach ($data as $m=>$n)
                {
                    if ($n->$filed_pid==$v->$filed_id)
                    {
                        $data[$m]['_'.$filed_name] = '----'.$data[$m][$filed_name]; 
                        $data[$m]['_'.$filed_title] = '- - - -'.$data[$m][$filed_title];
                        $arr[]=$data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
