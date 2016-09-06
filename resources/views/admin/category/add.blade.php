@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <i class="fa fa-home"></i>
        <a href="{{url('admin/info')}}">首页</a> &raquo;
        <a href="#">添加分类</a>
    </div>
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
                <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>分类列表</a>
            </div>
        </div>
    </div>
    <div class="result_wrap">
        <form action="{{url('admin/category')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require"></i>所属分类：</th>
                        <td>
                            <select name="cate_pid">
                                <option value="0">==顶级分类==</option>
                                @foreach($data as $d)
                                <option value="{{$d->cate_id}}">{{$d->cate_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>子分类名称：</th>
                        <td>
                            <input type="text" name="cate_name" placeholder="请输入子分类名称">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require"></i>分类标题：</th>
                        <td>
                            <input type="text" class="lg" name="cate_title" placeholder="请输入分类标题">
                        </td>
                    </tr>

                    <tr>
                        <th>关键词：</th>
                        <td>
                            <textarea name="cate_keywords" placeholder="请输入关键词"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea class="lg" name="cate_description" placeholder="请输入相关描述"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>排序：</th>
                        <td>
                            <input type="text" name="cate_order" placeholder="请输入文章排序号">
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