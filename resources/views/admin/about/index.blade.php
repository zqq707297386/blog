@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <i class="fa fa-home"></i>
        <a href="{{url('admin/info')}}">首页</a> &raquo;
        <a href="#">关于我</a>
    </div>
    <div class="result_wrap">
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/about/create')}}"><i class="fa fa-recycle"></i>添加关于我信息</a>
            </div>
        </div>
    </div>
    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc">姓名</th>
                    <th class="tc">省份</th>
                    <th class="tc">简介</th>
                    <th class="tc">个性签名</th>
                    <th class="tc">关于我标题</th>
                    <th class="tc">头像</th>
                    <th>操作</th>
                </tr>

                <tr>
                    <td class="tc">{{$ainfo['about_title']}}</td>
                    <td class="tc">{{$ainfo['about_region']}}</td>
                    <td class="tc">{{$ainfo['about_description']}}</td>
                    <td class="tc">{{$ainfo['about_autograph']}}</td>
                    <td class="tc">{{$ainfo['about_title']}}</td>
                    <td class="tc">
                        <img src="{{url($ainfo['about_thumb'])}}" width="100%" height="100%"
                             style="width: 200px; height: 200px;">
                    </td>
                    <td>
                        <a href="{{url('admin/about/'.$ainfo['about_id'].'/edit')}}">修改</a>
                        <a href="javascript:;" onclick="alert('不允许删除')">删除</a>
                    </td>
                </tr>

            </table>

            <style>
                .result_content ul li span {
                    font-size: 15px;
                    padding: 6px 12px;
                }
            </style>
        </div>
    </div>
@endsection