<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('info')
    <link href="{{asset('resources/views/home/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/main.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('resources/views/home/css/share.min.css')}}" rel="stylesheet">
    <script src="{{asset('resources/views/home/js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('resources/views/home/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('resources/views/home/js/main.js')}}"></script>
    <script src="https://apps.bdimg.com/libs/jquery/1.8.2/jquery.js"></script>
    <script src="{{asset('resources/views/home/js/jquery.share.min.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="{{asset('resources/views/home/js/html5shiv.js')}}"></script>
    <script src="{{asset('resources/views/home/js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="bookmark" href="/favicon.ico"/>

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
                    <a class="navbar-brand" href="/">
                        <img src="{{asset('resources/views/home/images/logo.jpg')}}"></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        @foreach($nav as $n=>$v)
                            <li><a href="{{url($v->nav_url)}}">{{$v->nav_name}}</a></li>
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
                    <a href="{{url('art/'.$w->art_id)}}" class="list-group-item list-group-item-success">{{$w->art_title}}</a>
                @endforeach
            </div>

            <div class="list-group">
                <strong class="list-group-item list-group-item-info">点击<span>排行</span></strong>
                @foreach($hotclick as $h => $k)
                    <a href="{{url('art/'.$k->art_id)}}" class="list-group-item list-group-item-success">{{$k->art_title}}</a>
                @endforeach
            </div>
            <div class="list-group">
               <div class="social-share" data-mode="prepend">
                 <a href="javascript:" class="icon icon-heart"></a>
               </div>
            </div>

        </div>
    @show
    <button type="button" id="back-to-top" class="btn btn-info">返回顶部</button>
</div>
</body>
<footer>
    <div class="main_nav_bottom">
       <ul class="copy" align="center">
           <li><p>{!! Config::get('web.CopyRight') !!}</p></li>
      </ul>
    </div>
</footer>
</html>