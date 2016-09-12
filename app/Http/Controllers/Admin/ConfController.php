<?php
/**
 * Conf Model 的 配置项控制器
 *
 * @version 0.1.0
 * @author zqq 707297386@qq.com
 * @date 16/9/12
 *
 */
namespace App\Http\Controllers\Admin;

use App\Http\Model\Conf;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

/**
 * Class ConfController
 * @package App\Http\Controllers\Admin
 */
class ConfController extends CommonController
{
    /**
     * 显示网站配置项页面
     * 根据field_type循环判断，如果field_type==radio则页面会显示input框
     *
     * @return array  返回选中的值
     */
    public function index ()
    {
        $data = Conf::orderBy('conf_order', 'asc')->get();
        foreach ($data as $k => $v) {
            switch ($v->field_type) {
                case 'input':
                    $data[$k]->_html = '<input type="text" class="lg" name="conf_content[]" value="' . $v->conf_content . '">';
                    break;
                case 'textarea':
                    $data[$k]->_html = '<textarea type="textarea" class="lg" name="conf_content[]">' . "$v->conf_content" . '</textarea>';
                    break;
                case 'radio':
                    $arr = explode(',', $v->field_value);
                    $str = '';
                    foreach ($arr as $m => $n) {
                        $r = explode('|', $n);
                        $c = $v->conf_content == $r[0] ? 'checked' : '';
                        $str .= '<input type="radio" name="conf_content[]" value="' . $r[0] . '"' . $c . '>' . $r[1] . '　';
                    }
                    $data[$k]->_html = $str;
                    break;
            }
        }
        return view('admin.conf.index', compact('data'));
    }

    /**
     * 指定显示网站配置项添加页面
     *
     * @return view     视图
     */
    public function create ()
    {
        return view('admin.conf.add');
    }

    /**
     *存储新添加的配置项信息
     *
     * @param Request $request
     * @return mixed            返回错误信息或者配置项列表
     */
    public function store (Request $request)
    {
        $conf = Input::except('_token');
        $rules = [
            'conf_title' => 'required',
            'conf_name' => 'required',
        ];
        $errors = [
            'conf_title.required' => '配置项标题不能为空！',
            'conf_name.required' => '配置项名称不能为空！',
        ];
        $val = Validator::make($conf, $rules, $errors);
        if ($val->passes()) {
            if (Conf::create($conf)) {
                return redirect('admin/conf');
            } else {
                return back()->with('errors', '未知错误！稍后重试');
            }
        } else {
            return back()->withErrors($val);
        }
    }

    /**
     * 指定显示网站配置项编辑页面
     *
     * @param $conf_id  配置项ID
     * @return view     视图
     */
    public function edit ($conf_id)
    {
        $edit = Conf::find($conf_id);
        return view('admin.conf.edit', compact('edit'));
    }

    /**
     * 跟新存储中指定的配置项信息
     *
     * @param $conf_id
     * @return mixed    返回错误信息或者跟新成功的页面
     */
    public function update ($conf_id)
    {
        $update = Input::except('_token', '_method');
        if (Conf::where('conf_id', $conf_id)->update($update)) {
            $this->createConfigFile();
            return redirect('admin/conf');
        } else {
            return back()->with('errors', '未知错误！稍后重试');
        }
    }

    /**
     * 根据配置项ID删除指定的配置项信息
     *
     * @param $conf_id
     * @return array    成功或失败的信息提示
     */
    public function destroy ($conf_id)
    {
        if (Conf::where('conf_id', $conf_id)->delete()) {
            $this->createConfigFile();
            $data = [
                're' => 1,
                'msg' => '删除成功'
            ];
        } else {
            $data = [
                're' => 0,
                'msg' => '删除失败！'
            ];
        }
        return $data;
    }

    /**
     * 修改配置项列表页input框内填入的信息
     *
     * @return mixed    返回修改成功后的信息（提示信息全用errors而已）
     */
    public function changeContent ()
    {
        $content = Input::all();
        foreach ($content['conf_id'] as $k => $v) {
            Conf::where('conf_id', $v)->update(['conf_content' => $content['conf_content'][$k]]);
        }
        $this->createConfigFile();
        return back()->with('errors', '修改内容成功');
    }

    /**
     *  changeContent()执行后调用。将配置项信息写入config/web.php (在linux上注意权限问题)
     */
    public function createConfigFile ()
    {
        $conf = Conf::pluck('conf_content', 'conf_name')->all();
        $path = base_path() . '\config\web.php';
        $arr = '<?php return ' . var_export($conf, true) . ';';
        file_put_contents($path, $arr);
    }

    /**
     * 修改配置项的排序
     * 
     * @return array
     */
    public function changeOrder ()
    {
        $input = Input::all();
        $order = Conf::find($input['conf_id']);
        $order->conf_order = $input['conf_order'];
        if ($order->update()) {
            $data = [
                're' => 1,
                'msg' => '排序修改成功'
            ];
        } else {
            $data = [
                're' => 0,
                'msg' => '排序修改失败！请稍后再试'
            ];
        }
        return $data;
    }

    /**
     * @param $conf_id
     */
    public function show ($conf_id)
    {
    }

}
