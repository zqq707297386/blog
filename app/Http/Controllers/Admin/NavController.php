<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Nav;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavController extends CommonController
{
    public function index()
    {
        $data = Nav::orderBy('nav_order','asc')->get();
        return view('admin.nav.index',compact('data'));
    }

    public function create()
    {
        return view('admin.nav.add');
    }

    public function edit($nav_id)
    {
        $edit = Nav::find($nav_id);
        return view('admin.nav.edit',compact('edit'));
    }
    
    public function update($nav_id)
    {
        $update = Input::except('_token','_method');
        if (Nav::where('nav_id',$nav_id)->update($update)) {
            return redirect('admin/nav');
        } else {
            return back()->with('errors','未知错误！稍后重试');
        }
    }

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
    public function show($nav_id)
    {
    }
    
}
