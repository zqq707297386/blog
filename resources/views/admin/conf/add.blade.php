@extends('layouts.admin')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i>
        <a href="{{url('admin/info')}}">首页</a> &raquo;
        <a href="#">添加配置项</a>
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/conf')}}"><i class="fa fa-recycle"></i>配置项列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/conf')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>配置项标题：</th>
                        <td><input type="text" name="conf_title" placeholder="请填写配置项标题"></td>
                    </tr>
                    <tr>
                        <th>配置项名称：</th>
                        <td><input type="text" name="conf_name" placeholder="请填写配置项名称"></td>
                    </tr>
                    <tr>
                        <th>配置项类型：</th>
                        <td>
                            <input type="radio" name="field_type" value="input" onclick="showTr()" checked>input　
                            <input type="radio" name="field_type" value="textarea" onclick="showTr()">textarea　
                            <input type="radio" name="field_type" value="radio" onclick="showTr()">radio　
                        </td>
                    </tr>
                    <tr class="field_value">
                        <th>配置项类型值：</th>
                        <td><input type="text" class="lg" name="field_value">
                            <p><i class="fa fa-exclamation-circle yellow">　配置项类型只有是radio的时候才需要配置 1|开启,0|关闭</i></p>
                        </td>
                    </tr>
                    <tr>
                        <th>配置项说明：</th>
                        <td>
                            <textarea name="conf_tips"cols="30" rows="10"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>配置项排序：</th>
                        <td><input type="text" name="conf_order" placeholder="请输入文章排序号"></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
<script>
    /**配置项类型值隐藏与显示
     * 1：首先获取input下的name，checked是默认选中的 .val()是得到选中的值
     * 2：判断选中的值是不是radio
     */
    showTr()  /*初始化showTr() 让配置项类型值这一行一开始就隐藏*/
   function showTr() {
       var type = $('input[name=field_type]:checked').val()
       /*alert(type)*/
       if (type == 'radio'){
           $('.field_value').show()  /*让配置项类型值这行显示*/
       }else {
           $('.field_value').hide()  /*让配置项类型值这行不显示*/
       }
   }
</script>
@endsection