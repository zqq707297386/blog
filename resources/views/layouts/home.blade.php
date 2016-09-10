<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('info')
    <link href="{{asset('resources/views/home/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/main.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('resources/views/home/js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('resources/views/home/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('resources/views/home/js/main.js')}}"></script>
    <script src="{{asset('resources/views/home/js/list.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="{{asset('resources/views/home/js/html5shiv.js')}}"></script>
    <script src="{{asset('resources/views/home/js/respond.min.js')}}"></script>
    <![endif]-->


</head>
<body>
<div class="gougouimg">
    <header>
        <nav class="navbar  navbar-fixed-top navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="{{asset('resources/views/home/images/logo.jpg')}}"></a>
                </div>


                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        @foreach($nav as $n=>$v)
                        <li><a href="{{url($v->nav_url)}}" target="_blank">{{$v->nav_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @section('content')
        <div class="col-sm-3" id="sm">
            <div class="list-group">
                @yield('fuji')
                <strong class="list-group-item list-group-item-info">文章<span>列表</span></strong>
                @foreach($new as $n =>$w)
                    <a href="{{url('art/'.$w->art_id)}}" target="_blank" class="list-group-item list-group-item-success">{{$w->art_title}}</a>
                @endforeach
            </div>

            <div class="list-group">
                <strong class="list-group-item list-group-item-info">点击<span>排行</span></strong>
                @foreach($hotclick as $h => $k)
                    <a href="{{url('art/'.$k->art_id)}}" target="_blank" class="list-group-item list-group-item-success">{{$k->art_title}}</a>
                @endforeach
            </div>
            <div class="list-group">
                <!-- 多说最新评论 start -->
                <div class="ds-recent-comments" data-num-items="5" data-show-avatars="1" data-show-time="1" data-show-title="1" data-show-admin="1" data-excerpt-length="70"></div>
                <!-- 多说最新评论 end -->
                <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
                <script type="text/javascript">
                    var duoshuoQuery = {short_name:"zqqblog"};
                    (function() {
                        var ds = document.createElement('script');
                        ds.type = 'text/javascript';ds.async = true;
                        ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                        ds.charset = 'UTF-8';
                        (document.getElementsByTagName('head')[0]
                        || document.getElementsByTagName('body')[0]).appendChild(ds);
                    })();
                </script>
                <!-- 多说公共JS代码 end -->
            </div>

            <div class="jiathis_style_32x32">
                <a class="jiathis_button_qzone"></a>
                <a class="jiathis_button_tsina"></a>
                <a class="jiathis_button_weixin"></a>
                <a href="" class=""
                   target="_blank"></a>
            </div>
            <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>

        </div>
        @show
       <button type="button" id="back-to-top" class="btn btn-info">返回顶部</button>

</div>
<footer>
    <div class="main_nav_bottom">
        <nav class="navbar navbar-default navbar-inverse ">
            <div class="container" align="center">
                <ul class="nav nav-tabs nav-tabs-justified">
                    <div class="row" align="center">
                        <div align="center">
                            <li><a href="#">百度：{!! Config::get('web.CopyRight') !!}</a>　<a href="/">网站统计</a></li>
                        </div>
                    </div>
                </ul>
            </div>
        </nav>
    </div>
</footer>
</body>
</html>