@extends('layouts.home')
@section('info')
    <title>{{$con->art_title}}--{{Config::get('web.web_title')}}</title>
    <meta name="keywords" content="{{$con->cate_keywords}}"/>
    <meta name="description" content="{{$con->cate_description}}"/>
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <h2 id="h2">
                <p class="text-center"><span>Picture and text information </span></p>
            </h2>
            <div class="row">
                @foreach($r_pic_id as $r => $d)
                    <div class="col-xs-6 col-md-3" id="picture">
                        <a href="{{url('art/'.$d->art_id)}}" class="thumbnail">
                            <img src="{{url($d->art_thumb)}}" alt="图片路径出错" width="100%" height="100%">
                        </a>
                    </div>
                @endforeach
            </div>
            <ul class="breadcrumb">
                <li>您当前所在的位置：<a href="{{url('/')}}">首页</a><span class="divider"></span></li>
                <li><a href="{{url('cate/'.$con->cate_id)}}">{{$con->cate_name}}</a></li>
                <li><a href="{{url('art/'.$con->art_id)}}">{{$con->art_title}}</a></li>
            </ul>
        </div>
    </div>
    <div id="con">
        <div class="container">

            <div class="row">
                <div class="col-sm-9" id="col">

                    <div class="jumbotron">
                        <div class="page-header">
                            <h2>{{$con->art_title}}</h2>
                            <strong>
                                <span>发布时间：{{date('Y-m-d',$con->art_time)}} </span>　
                                <span>编辑者：{{$con->art_editor}} </span>　
                                <span>查看次数：{{$con->art_view}}</span>
                            </strong>
                        </div>
                        <p class="lead">{!! $con->art_content !!}</p>
                        <strong>关键字词：{{$con->art_tag}}　</strong>
                        <strong><span>分类：[<a
                                        href="{{url('cate/'.$con->cate_id)}}">{{$con->cate_name}}</a>]</span></strong>

                    </div>
                    <div class="jumbotron">
                        <div id="jum">
                            <strong>上一篇：
                                @if($article['pre'])
                                    <a href="{{url('art/'.$article['pre']->art_id)}}">{{$article['pre']->art_title}}
                                        　</a></strong>
                            @else
                                <span>没有上一篇了　</span>
                            @endif
                            <strong>下一篇：
                                @if($article['next'])
                                    <a href="{{url('art/'.$article['next']->art_id)}}">{{$article['next']->art_title}}</a></strong>
                            @else
                                <span>　没有下一篇了</span>
                            @endif
                        </div>
                    </div>
                    <div class="jumbotron">
                        <!-- 多说评论框 start -->
                        <div class="ds-thread" data-thread-key="{{$con->cate_id}}" data-title="{{$con->art_title}}"
                             data-url="{{url('art/'.$con->art_id)}}"></div>
                        <!-- 多说评论框 end -->
                        <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
                        <script type="text/javascript">
                            var duoshuoQuery = {short_name: "zqqblog"};
                            (function () {
                                var ds = document.createElement('script');
                                ds.type = 'text/javascript';
                                ds.async = true;
                                ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                                ds.charset = 'UTF-8';
                                (document.getElementsByTagName('head')[0]
                                || document.getElementsByTagName('body')[0]).appendChild(ds);
                            })();
                        </script>
                        <!-- 多说公共JS代码 end -->
                    </div>
                </div>
                @parent
            </div>
        </div>
    </div>
@endsection