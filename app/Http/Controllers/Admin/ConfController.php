<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Conf;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfController extends CommonController
{
    public function index()
    {
        $data = Conf::orderBy('conf_order','asc')->get();
        foreach ($data as $k=>$v) {
            switch($v->field_type) {
                case 'input':
                    $data[$k]->_html = '<input type="text" class="lg" name="conf_content[]" value="'.$v->conf_content.'">';
                    break;
                case 'textarea':
                    $data[$k]->_html = '<textarea type="textarea" class="lg" name="conf_content[]">'."$v->conf_content".'</textarea>';
                    break;
                case 'radio':
                   $arr = explode(',',$v->field_value);
                   $str = '';
                   foreach ($arr as $m=>$n){
                       $r = explode('|',$n);
                       $c = $v->conf_content==$r[0]?'checked':'';
                       $str .= '<input type="radio" name="conf_content[]" value="'.$r[0].'"'.$c.'>'.$r[1].'　';
                   }
                    $data[$k]->_html = $str;
                    break;
            }
        }
        return view('admin.conf.index',compact('data'));
    }

    public function create()
    {
        return view('admin.conf.add');
    }

    public function edit($conf_id)
    {
        $edit = Conf::find($conf_id);
        return view('admin.conf.edit',compact('edit'));
    }
    
    public function update($conf_id)
    {
        $update = Input::except('_token','_method');
        if (Conf::where('conf_id',$conf_id)->update($update)) {
            $this->createConfigFile();
            return redirect('admin/conf');
        } else {
            return back()->with('errors','未知错误！稍后重试');
        }
    }
    
    public function destroy($conf_id)
    {
        if (Conf::where('conf_id',$conf_id)->delete()) {
            $this->createConfigFile();
            $data = [
                're'=>1,
                'msg'=>'删除成功'
            ];
        } else {
            $data = [
                're'=>0,
                'msg'=>'删除失败！'
            ];
        }
        return $data;
    }
    
    public function store(Request $request)
    {
        $conf = Input::except('_token');
        $rules = [
            'conf_title'=>'required',
            'conf_name'=>'required',
        ];
        $errors = [
            'conf_title.required'=>'配置项标题不能为空！',
            'conf_name.required'=>'配置项名称不能为空！',
        ];
        $val = Validator::make($conf,$rules,$errors);
        if ($val->passes()) {
            if (Conf::create($conf)){
                return redirect('admin/conf');
            } else {
                return back()->with('errors','未知错误！稍后重试');
            }
        } else {
            return back()->withErrors($val);
        }
    }

    public function changeContent()
    {
        $content = Input::all();
        foreach ($content['conf_id'] as $k=>$v) {
           Conf::where('conf_id',$v)->update(['conf_content'=> $content['conf_content'][$k]]);
        }
        $this->createConfigFile();
        return back()->with('errors','修改内容成功');
   }

    public function createConfigFile()
    {
        $conf =Conf::pluck('conf_content','conf_name')->all();
        $path = base_path().'\config\web.php';
        $arr = '<?php return '.var_export($conf,true).';';
        file_put_contents($path,$arr);
    }
    
    public function changeOrder()
    {
        $input = Input::all();
        $order = Conf::find($input['conf_id']);
        $order->conf_order = $input['conf_order'];
        if ($order->update()) {
            $data = [
                're'=>1,
                'msg'=>'排序修改成功'
            ];
        } else {
            $data = [
                're'=>0,
                'msg'=>'排序修改失败！请稍后再试'
            ];
        }
        return $data;
    }
    public function show($conf_id)
    {
    }
    
}
