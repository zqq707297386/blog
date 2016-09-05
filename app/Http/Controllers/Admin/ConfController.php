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
    /**方法：GET  URL ：admin/conf   自定义导航首页
     *
     * @return mixed
     */
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

    /**方法：GET URL ：admin/conf/create  自定义导航显示
     * @return mixed
     */
    public function create()
    {
        return view('admin.conf.add');
    }
    
    /**方法：GET  URL ：admin/conf/conf_id/edit  自定义导航编辑
     * @param $conf_id
     * @return mixed
     */
    public function edit($conf_id)
    {
        $edit = Conf::find($conf_id);
        return view('admin.conf.edit',compact('edit'));
    }
    
    /**方法：PUT|PATCH  URL ：admin/conf/conf_id   自定义导航修改
     * @param $conf_id
     * @return mixed
     */
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
    
    /**方法：DELETE  URL ： admin/conf/conf_id  自定义导航删除
     * @param $conf_id
     * @return array
     */
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
    
    /**方法：POST  URL ：admin/conf      自定义导航链接
     * @param Request $request
     * @return mixed
     */
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

    /**
     * 修改内容值
     */
    public function changeContent()
    {
        $content = Input::all();
        foreach ($content['conf_id'] as $k=>$v) {
           Conf::where('conf_id',$v)->update(['conf_content'=> $content['conf_content'][$k]]);
        }
        $this->createConfigFile();
        return back()->with('errors','修改内容成功');
   }

    /**把跟新或修改的内容保存。以便前端读取
     * 1：pluck()会净化数组形成键值对 不过在5.3会被移除
     * 2：获得路径，方便创建的时候知道在哪
     * 3：var_export是把数组连接为字符串
     * 4：写入到文件里
     */
    public function createConfigFile()
    {
        //echo Config::get('web.hello'); 读取配置项 会输出hi
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
    // 方法：GET  URL ：admin/conf/{conf}
    public function show($conf_id)
    {
        //
    }
    
}
