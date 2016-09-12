@extends('layouts.home')

@section('content')
    <div class="content">
        <div class="container">
            <div style="float: right;">
                <canvas id="canvas" width=250 height=250>
                </canvas>
                <audio id="audio">
                </audio>
            </div>
            <div>
                <section class="box">
                    <ul class="texts">
                        <p>敢于浪费哪怕一个钟头时间的人，说明他还不懂得珍惜生命的全部价值。合理安排时间，就等于节约时间。即使一动不动，时间也在替我们移动。而日子的消逝，就是带走我们希望保留的幻想。</p>
                        <p>不要老叹息过去，它是不再回来的；要明智地改善现在。要以不忧不惧的坚决意志投入扑朔迷离的未来。不要为已消尽之年华叹息，必须正视匆匆溜走的时光。
                            当许多人在一条路上徘徊不前时，他们不得不让开一条大路，让那珍惜时间的人赶到他们的前面去。</p>
                        <p>更多经典语句请关注：珍惜时间的语句 <i>鲁迅珍惜时间的名言</i></p>
                    </ul>
                </section>
            </div>
            <ul class="breadcrumb">
                <li>您当前所在的位置：<a href="{{url('/')}}">首页</a><span class="divider"></span></li>
                <li><a href="#">about me</a></li>
            </ul>
        </div>
    </div>
    <div id="con">
        <div class="container">
            <div class="row">
                <div class="col-sm-9" id="col">
                    <div class="jumbotron text-center">
                        <div class="page-header">
                            <h2 style="color: #7FB8D2 ">{{$about['about_title']}}</h2>
                        </div>
                        <p>{!! $about['about_content'] !!}</p>
                    </div>
                    <div class="jumbotron">
                        <!-- 多说评论框 start -->
                        <div class="ds-thread" data-thread-key="123" data-title="关于我" data-url="url"></div>
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
    <script src="{{asset('resources/views/home/js/list.js')}}"></script>
@endsection