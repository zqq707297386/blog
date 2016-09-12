@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <i class="fa fa-home"></i>
        <a href="{{url('admin/info')}}">首页</a> &raquo;
        <a href="#">添加导航</a>
    </div>
    <div class="result_wrap">
        <div class="result_title">
            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/nav')}}"><i class="fa fa-recycle"></i>自定义导航列表</a>
            </div>
        </div>
    </div>
    <div class="result_wrap">
        <form action="{{url('admin/nav')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>

                <tr>
                    <th>导航名称：</th>
                    <td>
                        <input type="text" name="nav_name" placeholder="请输入导航名称">
                        <span>导航别名：</span>
                        <input type="text" name="nav_alias" placeholder="请输入导航别名">
                    </td>
                </tr>

                <tr>
                    <th>导航URL：</th>
                    <td>
                        <input type="text" class="lg" name="nav_url" value="http://">
                    </td>
                </tr>
                <tr>
                    <th>排序：</th>
                    <td>
                        <input type="text" name="nav_order" placeholder="请输入文章排序号">
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