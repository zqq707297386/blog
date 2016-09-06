@extends('layouts.admin')
@section('content')
	<div class="crumb_warp">
		<i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;
	</div>

    <div class="result_wrap">
        <div class="result_title">
            <h3>系统基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>操作系统</label><span> <?PHP echo PHP_OS; ?></span>
                </li>
                <li>
                    <label>运行环境</label><span><?PHP echo $_SERVER ['SERVER_SOFTWARE'];?></span>
                </li>
                <li>
                    <label>版本</label><span>v-1.0</span>
                </li>
                <li>
                    <label>上传附件限制</label><span><?PHP echo get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件"; ?></span>
                </li>
                <li>
                    <label>北京时间</label><span><?php echo date("Y年-m月-d日 G时:i分:s秒");?></span>
                </li>
                <li>
                    <label>服务器域名</label><span><?PHP echo $_SERVER ['SERVER_NAME']; ?></span>
                </li>
                <li>
                    <label>Host/Ip</label><span><?PHP echo $_SERVER ['SERVER_ADDR']; ?></span>
                </li>
            </ul>
        </div>
    </div>


    <div class="result_wrap">
        <div class="result_title">
            <h3>使用帮助</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>官方交流网站：</label><span><a href="http://www.phpchina.com/">http://www.phpchina.com/</a></span>
                </li>
                <li>
                    <label>官方交流QQ群：</label><span><a href="#"><img border="0" src=""></a></span>
                </li>
            </ul>
        </div>
    </div>
@endsection