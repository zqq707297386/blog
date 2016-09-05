@extends('layouts.home')
@section('info')
    <title>{{Config::get('web.web_title')}}--{{Config::get('web.web_Auxiliary_title')}}</title>
    <meta name="keywords" content="{{Config::get('web.web_keywords')}}"/>
    <meta name="description" content="{{Config::get('web.wen_description')}}"/>
@endsection
@section('content')
    <!-- 中间内容部分 -->
    <div id="banner">
        <div class="inner">
            <p class="sub-heading">hello</p>
            <hr class="hr">
            <h1>Welcome to My BLOG</h1>
            <hr>

            <button id="sidebar_trigger" type="button" class="btn btn-default btn-lg active">了解我</button>
            <div class="links">
                <button id="sidebar_right" type="button" class="btn btn-success">友情链接</button>
            </div>
            <!-- 页面滚动图标开始 -->
            <div class="more">
                <button type="button" class="btn btn-default">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                </button>
            </div>
            <!-- 页面滚动图标结束 -->
        </div>
    </div>
    <!-- 内容部分开始 -->
    <div id="con">
        <div class="container">
            <h2 id="h2">
                <p class="text-center"><span> information </span></p>
            </h2>
            <div class="row">
                <div class="col-sm-9" id="col">
                    <strong class="list-group-item list-group-item-info"><span>最新文章</span></strong>
                    @foreach($list as $l=>$t)
                        <div class="jumbotron">
                            <div class="page-header">
                                <a href="{{url('art/'.$t->art_id)}}" target="_blank"><h2>{{$t->art_title}}</h2></a>
                            </div>
                            <a href="{{url('art/'.$t->art_id)}}" target="_blank"><p>{{$t->art_description}}.....</p></a>
                            <span class="glyphicon glyphicon-time"></span>
                            <strong><span>发布时间：{{date('Y-m-d',$t->art_time)}},</span></strong>
                            <strong><span>编辑者：{{$t->art_editor}}</span></strong>
                        </div>
                    @endforeach
                    <div class="page">
                        {{$list->links()}}
                    </div>
                </div>
                @parent
            </div>
        </div>
    </div>
    <!-- 内容部分结束 -->
    <!-- 左侧边栏 -->
    <div class="mask"></div>
    <div id="sidebar">
        <ul class="text-center">
            <img src="{{asset('resources/views/home/images/my.jpg')}}" alt="" class="img-circle center-block">
            <li><a href="#">姓名：郑启强</a></li>
            <li><a href="#">地区：广东省</a></li>
            <li><a href="#">简介：ＩＴ界小菜鸟、有理想，有目标，有斗志的三无青年</a></li>
            <li><a href="#">个性签名：什么都不想、什么都不干、什么都不是。</a></li>
            <li><a href="#">QQ：707297386</a></li>
        </ul>
    </div>
    <!-- 左侧边栏结束 -->
    <!-- 右侧边栏 -->
    <div class="maskright"></div>
    <div id="sidebarright">
        <ul class="text-center">
            <h3 style="color: #707070">友情链接</h3>
            @foreach($link as $l => $k)
                <li><a href="{{$k->link_url}}" target="_blank"><p>{{$k->link_name}}</p></a></li>
            @endforeach
        </ul>
    </div>
    <!-- 右侧边栏结束 -->
@endsection