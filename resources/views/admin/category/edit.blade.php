@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <i class="fa fa-home"></i>
        <a href="{{url('admin/info')}}">首页</a> &raquo;
        <a href="#">修改文章</a>
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
                <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>文章列表</a>
            </div>
        </div>
    </div>
    <div class="result_wrap">
        <form action="{{url('admin/category/'.$edit->cate_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require"></i>所属分类：</th>
                        <td>
                            <select name="cate_pid">
                                <option value="0">==顶级分类==</option>
                                @foreach($data as $d)
                                <option value="{{$d->cate_id}}" {{--selectrd 表示默认选中--}}
                                        @if($d->cate_id == $edit->cate_pid) selected @endif
                                >{{$d->cate_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>子分类名称：</th>
                        <td>
                            <input type="text" name="cate_name" value="{{$edit->cate_name}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require"></i>分类标题：</th>
                        <td>
                            <input type="text" class="lg" name="cate_title" value="{{$edit->cate_title}}">
                        </td>
                    </tr>

                    <tr>
                        <th>关键词：</th>
                        <td>{{--textarea 不要设置默认值--}}
                            <textarea name="cate_keywords">{{$edit->cate_keywords}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea class="lg" name="cate_description">{{$edit->cate_description}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>排序：</th>
                        <td>
                            <input type="text" name="cate_order" value="{{$edit->cate_order}}">
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