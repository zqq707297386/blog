@extends('layouts.admin')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i>
        <a href="{{url('admin/info')}}">首页</a> &raquo;
        <a href="#">修改友情链接</a>
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))      {{--如果错误不是对象，是字符串。则运行else--}}
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                    @else
                        <p>{{$errors}}</p> {{--这是原密码错误提示--}}
                    @endif
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/link')}}"><i class="fa fa-recycle"></i>友情链接列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/link/'.$edit->link_id)}}" method="post">
            {{ method_field('PUT') }}
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>友情链接名称：</th>
                        <td>
                            <input type="text" name="link_name" value="{{$edit->link_name}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require"></i>友情链接标题：</th>
                        <td>
                            <input type="text" name="link_title" value="{{$edit->link_title}}">
                        </td>
                    </tr>
                    <tr>
                        <th>友情链接URL：</th>
                        <td>
                            <input type="text" class="lg" name="link_url" value="{{$edit->link_url}}">
                        </td>
                    </tr>
                    <tr>
                        <th>排序：</th>
                        <td>
                            <input type="text" name="link_order" value="{{$edit->link_order}}">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection