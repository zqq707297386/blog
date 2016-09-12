@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <i class="fa fa-home"></i>
        <a href="{{url('admin/info')}}">首页</a> &raquo;
        <a href="#">添加友情链接</a>
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
                <a href="{{url('admin/link')}}"><i class="fa fa-recycle"></i>友情链接列表</a>
            </div>
        </div>
    </div>
    <div class="result_wrap">
        <form action="{{url('admin/link')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>

                <tr>
                    <th>友情链接名称：</th>
                    <td>
                        <input type="text" name="link_name" placeholder="请输友情链接名称">
                    </td>
                </tr>
                <tr>
                    <th><i class="require"></i>友情链接标题：</th>
                    <td>
                        <input type="text" name="link_title" placeholder="请输友情链接标题">
                    </td>
                </tr>
                <tr>
                    <th>友情链接URL：</th>
                    <td>
                        <input type="text" class="lg" name="link_url" value="http://">
                    </td>
                </tr>
                <tr>
                    <th>排序：</th>
                    <td>
                        <input type="text" name="link_order" placeholder="请输入文章排序号">
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