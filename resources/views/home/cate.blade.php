@extends('layouts.home')
@section('info')
	<title>{{$cate->cate_name}}—{{Config::get('web.web_title')}}</title>
	<meta name="keywords" content="{{$cate->cate_keywords}}" />
	<meta name="description" content="{{$cate->cate_description}}" />
@endsection
@section('content')
<!-- 中间内容部分  ./images/gougou.jpg-->
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
			</div>
<div class="container">
		

 		<ul class="breadcrumb">
 			<li>您当前所在的位置：<a href="{{url('/')}}">首页</a><span class="divider"></span></li>
 			<li><a href="{{url('cate/'.$cate->cate_id)}}">{{$cate->cate_name}}</a></li>
 		</ul>
</div>
</div>
<!-- 内容部分 -->
<div id="con">
<div class="container">

	<div class="row">
		<div class="col-sm-9" id="col">
		@foreach($newcate as $e)
		<div class="jumbotron">
		  <div class="page-header">
		    <a href="{{url('art/'.$e->art_id)}}"><h2>{{$e->art_title}}</h2></a>
		  </div>
			<a href="{{url('art/'.$e->art_id)}}"><p>{{$e->art_description}}.....</p></a>
			<span class="glyphicon glyphicon-time"></span>
			<strong><span>发布时间：{{date('Y-m-d',$e->art_time)}},</span></strong>
			<strong><span>编辑者：{{$e->art_editor}}　</span></strong>
			<strong><span>分类：[<a href="{{url('cate/'.$e->cate_id)}}">{{$cate->cate_name}}</a>]</span></strong>
		</div>
		@endforeach
			<div class="page">
				{{$newcate->links()}}
			</div>
		</div>

		@section('fuji')
			<aside>
				@if($fuji->all())
					<div class="rnav">
						<ul>
							@foreach($fuji as $k=>$v)
								<li class="rnav{{$k+1}}"><a href="{{url('cate/'.$v->cate_id)}}" target="_blank">{{$v->cate_name}}</a></li>
							@endforeach
						</ul>
					</div>
				@endif
			</aside>
		@endsection

		@parent

		
	</div>
</div>
</div>
@endsection