<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\nav;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavController extends CommonController
{
    /**方法：GET  URL ：admin/nav   自定义导航首页
     * paginate()是分页 
     * @return mixed
     */
    public function index()
    {
        $data = Nav::orderBy('nav_order','asc')->get();
        return view('admin.nav.index',compact('data'));
    }

    /**方法：GET URL ：admin/nav/create  自定义导航显示
     * @return mixed
     */
    public function create()
    {
        return view('admin.nav.add');
    }
    
    /**方法：GET  URL ：admin/nav/nav_id/edit  自定义导航编辑
     * @param $nav_id
     * @return mixed
     */
    public function edit($nav_id)
    {
        $edit = Nav::find($nav_id);
        return view('admin.nav.edit',compact('edit'));
    }
    
    /**方法：PUT|PATCH  URL ：admin/nav/nav_id   自定义导航修改
     * @param $nav_id
     * @return mixed
     */
    public function update($nav_id)
    {
        $update = Input::except('_token','_method');
        if (Nav::where('nav_id',$nav_id)->update($update)) {
            return redirect('admin/nav');
        } else {
            return back()->with('errors','未知错误！稍后重试');
        }
    }
    
    /**方法：DELETE  URL ： admin/nav/nav_id  自定义导航删除
     * @param $nav_id
     * @return array
     */
    public function destroy($nav_id)
    {
        if (Nav::where('nav_id',$nav_id)->delete()) {
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
    
    /**方法：POST  URL ：admin/nav      自定义导航链接
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $nav = Input::except('_token');
        $rules = [
            'nav_name'=>'required',
        ];
        $errors = [
            'nav_name.required'=>'导航名称不能为空！',
        ];
        $val = Validator::make($nav,$rules,$errors);
        if ($val->passes()) {
            if (Nav::create($nav)){
                return redirect('admin/nav');
            } else {
                return back()->with('errors','未知错误！稍后重试');
            }
        } else {
            return back()->withErrors($val);
        }
    }
   
    public function changeOrder()
    {
        $input = Input::all();
        $order = Nav::find($input['nav_id']);
        $order->nav_order = $input['nav_order'];
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
    // 方法：GET  URL ：admin/nav/{nav}
    public function show($nav_id)
    {
        //
    }
    
}
