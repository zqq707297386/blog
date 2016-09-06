<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Link;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinkController extends CommonController
{
    public function index()
    {
        $data = Link::orderBy('link_order','asc')->get();
        return view('admin.link.index',compact('data'));
    }

    public function create()
    {
        return view('admin.link.add');
    }
    
    public function edit($link_id)
    {
        $edit = Link::find($link_id);
        return view('admin.link.edit',compact('edit'));
    }

    public function update($link_id)
    {
        $update = Input::except('_token','_method');
        if (Link::where('link_id',$link_id)->update($update)) {
            return redirect('admin/link');
        } else {
            return back()->with('errors','未知错误！稍后重试');
        }
    }

    public function destroy($link_id)
    {
        if (Link::where('link_id',$link_id)->delete()) {
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
        $link = Input::except('_token');
        $rules = [
            'link_name'=>'required',
            'link_title'=>'required',
            'link_url'=>'required'
        ];
        $errors = [
            'link_name.required'=>'友情链接名称不能为空！',
            'link_title.required'=>'友情链接标题不能为空！',
            'link_url.required'=>'友情链接URL不能为空！'
        ];
        $val = Validator::make($link,$rules,$errors);
        if ($val->passes()) {
            if (Link::create($link)){
                return redirect('admin/link');
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
        $order = Link::find($input['link_id']);
        $order->link_order = $input['link_order'];
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
    public function show($link_id)
    {
    }
    
}