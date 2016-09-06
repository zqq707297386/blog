<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class CategoryController extends CommonController
{
    public function index()
    {
        $data = (new Category)->tree();
        return view('admin.category.index')->with('data',$data);
    }

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
    
    public function create()
    {
        $data = Category::where('cate_pid',0)->get();
        return view('admin/category/add',compact('data'));
    }

    public function edit($cate_id)
    {
        $edit = Category::find($cate_id);
        $data = Category::where('cate_pid',0)->get();
        return view('admin/category/edit',compact('edit','data'));
    }

    public function update($cate_id)
    {
        $updateInfo = Input::except('_token','_method');
        if(Category::where('cate_id',$cate_id)->update($updateInfo)){
            return redirect('admin/category');
        }else{
            return back()->with('errors','未知错误，稍后再试');
        }
    }
    
    public function destroy($cate_id)
    {
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
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
    
    public function show()
    {

    }
}
