@extends('layouts.home')
@section('info')
	<title>{{$cate->cate_name}}—{{Config::get('web.web_title')}}</title>
	<meta name="keywords" content="{{$cate->cate_keywords}}" />
	<meta name="description" content="{{$cate->cate_description}}" />
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
 			<li><a href="{{url('cate/'.$cate->cate_id)}}">{{$cate->cate_name}}</a></li>
 		</ul>
</div>
</div>
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