<?php
/**
 * Category Model 的 栏目控制器
 *
 * @version 0.1.0
 * @author zqq 707297386@qq.com
 * @date 16/9/12
 *
 */
namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends CommonController
{
    /**
     * 显示栏目页面
     *
     * @return array    返回栏目信息
     */
    public function index ()
    {
        $data = (new Category)->tree();
        return view('admin.category.index')->with('data', $data);
    }

    /**
     * 显示创建栏目页面
     *
     * @return array    根据父级等于0的栏目
     */
    public function create ()
    {
        $data = Category::where('cate_pid', 0)->get();
        return view('admin/category/add', compact('data'));
    }

    /**
     * 存储新添加的栏目信息
     *
     * @return mixed    可能返回错误信息或者返回添加成功的栏目信息
     */
    public function store ()
    {
        if ($input = Input::except('_token')) {
            $rules = [
                'cate_name' => 'required'
            ];
            $errors = [
                'cate_name.required' => '分类名称不能为空'
            ];
            $val = Validator::make($input, $rules, $errors);
            if ($val->passes()) {
                if (Category::create($input)) {
                    return redirect('admin/category');
                } else {
                    return back()->with('errors', '未知错误，稍后再试');
                }
            } else {
                return back()->withErrors($val);
            }
        }
    }

    /**
     * 显示修改栏目的指定页面
     *
     * @param $cate_id      指定栏目的ID
     * @return array        显示pid等于0的信息
     */
    public function edit ($cate_id)
    {
        $edit = Category::find($cate_id);
        $data = Category::where('cate_pid', 0)->get();
        return view('admin/category/edit', compact('edit', 'data'));
    }

    /**
     * 跟新存储中指定的栏目资源
     *
     * @param $cate_id
     * @return mixed
     */
    public function update ($cate_id)
    {
        $updateInfo = Input::except('_token', '_method');
        if (Category::where('cate_id', $cate_id)->update($updateInfo)) {
            return redirect('admin/category');
        } else {
            return back()->with('errors', '未知错误，稍后再试');
        }
    }

    /**
     * 删除指定的栏目资源
     *
     * @param $cate_id
     * @return array        删除成功或失败的信息
     */
    public function destroy ($cate_id)
    {
        /** 判断要删除的是否是父栏目，如果是则把此栏目的所有子栏目变为父栏目 */
        Category::where('cate_pid', $cate_id)->update(['cate_pid' => 0]);
        if (Category::where('cate_id', $cate_id)->delete()) {
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
     * 修改栏目排序
     *
     * @return array    返回修改后的排序
     */
    public function changeOrder ()
    {
        $input = Input::all();
        $order = Category::find($input['cate_id']);
        $order->cate_order = $input['cate_order'];
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
     *显示资源
     */
    public function show ()
    {

    }
}
