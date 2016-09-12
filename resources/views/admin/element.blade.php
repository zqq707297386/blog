@extends('layouts.admin')
@section('content')
    <body>
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a>
    </div>
    <div class="result_wrap">
        <table class="add_tab">
            <tr>
                <th width="120">EsayDialog</br>(H-ui 前端框架)</th>
                <td>
                    <a href="http://www.h-ui.net/easydialog-v2.0/index.html" target="_blank">
                        http://www.h-ui.net/easydialog-v2.0/index.html
                    </a>
                </td>
            </tr>
            <tr>
                <th width="120">ArtDialog</br>(对话框组件)</th>
                <td>
                    <a href="http://demo.jb51.net/js/2011/artDialog/_doc/labs.html" target="_blank">
                        http://demo.jb51.net/js/2011/artDialog/_doc/labs.html
                    </a>
                </td>
            </tr>
            <tr>
                <th width="120">layer</br>(对话框组件)</th>
                <td>
                    <a href="http://layer.layui.com/" target="_blank">
                        http://layer.layui.com/
                    </a>
                </td>
            </tr>
            <tr>
                <th width="120">PSR</br>(PHP 标准规范)</th>
                <td>
                    <a href="https://psr.phphub.org/" target="_blank">
                        https://psr.phphub.org/
                    </a>
                </td>
            </tr>
            <tr>
                <th width="120">PHP7文档</br>(PHP7新特性)</th>
                <td>
                    <a href="http://www.php7.site/" target="_blank">
                        http://www.php7.site/
                    </a>
                </td>
            </tr>
            <tr>
                <th width="120">前端网</br>(大前端)</th>
                <td>
                    <a href="http://www.w3cfuns.com/" target="_blank">
                        http://www.w3cfuns.com/
                    </a>
                </td>
            </tr>
        </table>
    </div>
@endsection