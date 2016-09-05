<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class CategoryController extends CommonController
{
    
    /**GET.admin/category                       全部分类   实体在Model/Category
     * 1:实例化Model得到数据库里的信息。是个数组 Model里已经排序
     * 2:分配视图。传递变量到admin.category.index视图
     * @return mixed
     */
    public function index()
    {
        $data = (new Category)->tree();
        return view('admin.category.index')->with('data',$data);
    }

    /**POST.category/changeOrder                修改排序
     * 1：接收admin/category/index.blade.php传入的数据
     * 2：根据传过来的id找数据
     * 3：把接收到的cate_order数据赋值给数据库里的cate_order字段
     * 4：判断是否修改成功
     * 5：返回data数组在 admin/index.blade.php被调用
     * @return array
     */
    public function changeOrder()
    {
        $input = Input::all();
        $order = Category::find($input['cate_id']);
        $order->cate_order = $input['cate_order'];
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
    
    /**GET.admin/category/create               添加分类
     * 1: 查找父ID等于0的数据
     * 2：给add.blade.php视图数据
     * @return mixed
     */
    public function create()
    {
        $data = Category::where('cate_pid',0)->get();
        return view('admin/category/add',compact('data'));
    }

    /**GET.admin/category/{category}/edit      编辑分类
     * 1:前台传入cate_id，根据传入的cate_id查所有信息，在edit.blade.php遍历
     * 2：查找父ID，跟cate_id信息里cate_pid做对比
     * 3：分配视图，传入数据
     * @param $cate_id
     * @return mixed
     */
    public function edit($cate_id)
    {
        $edit = Category::find($cate_id);
        $data = Category::where('cate_pid',0)->get();
        return view('admin/category/edit',compact('edit','data'));
    }

    /**PUT.admin/category/.$edit->cate_id          修改分类
     * 修改是put方法提交  包含get跟post
     * 1：edit.blade.php  action里要加上id。这样才知道修改到哪
     * 2：put提交则加上<input type="hidden" name="_method" value="put">隐藏域 等于{{ method_field('PUT') }}
     * 3：获取信息并去除不需要的信息
     * 4：修改与前台传入的对应id信息
     * @param $cate_id   前台传入的ID
     * @return mixed
     */
    public function update($cate_id)
    {
        $updateInfo = Input::except('_token','_method');
        if(Category::where('cate_id',$cate_id)->update($updateInfo)){
            return redirect('admin/category');
        }else{
            return back()->with('errors','未知错误，稍后再试');
        }
    }
    
    /**delete.admin/category/{category}        删除分类
     * @param $cate_id
     * @return array
     */
    public function destroy($cate_id)
    {
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);//如果是删除顶级分类则把子分类全变为顶级分类
        if (Category::where('cate_id',$cate_id)->delete()) {
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

    /**POST.admin/category
     * 1：except()则把不需要填充的数据去除了
     * 2：设定规则，设定错误信息
     * 3：把验证后的信息赋给$val
     * 4：如果信息通过则填充入数据库，如果不通过。则在add.blade.php 里<h3></h3>下面的代码则会输出错误提示
     * 5：如果数据填充成功。则会跳转。否则显示未知错误
     * @return string
     */
    public function store()
    {
        if($input = Input::except('_token')) {
            $rules = [
                'cate_name' => 'required'
            ];
            $errors = [
                'cate_name.required' => '分类名称不能为空'
            ];
            $val = Validator::make($input,$rules,$errors);
            if ($val->passes()) {
                if (Category::create($input)) {
                    return redirect('admin/category');
                } else {
                    return back()->with('errors','未知错误，稍后再试');
                }
            } else {
                return back()->withErrors($val);
            }
        }
    }
    
    //GET.admin/category/{category}           展示分类
    public function show()
    {

    }
}
