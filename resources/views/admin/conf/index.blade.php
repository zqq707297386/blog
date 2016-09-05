@extends('layouts.admin')
@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i>
    <a href="{{url('admin/info')}}">首页</a> &raquo;
    <a href="#">网站配置</a>
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->

<!--结果页快捷搜索框 结束-->

<!--搜索结果页面 列表 开始-->

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
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/conf/create')}}"><i class="fa fa-plus"></i>网站配置项添加</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <form action="{{url('admin/conf/changeContent')}}" method="post">
                {{csrf_field()}}
            <table class="list_tab">
                <tr>
                    <th class="tc">排序</th>
                    <th class="tc">ID</th>
                    <th>配置项标题</th>
                    <th>配置项名称</th>
                    <th>配置项类型</th>
                    <th>内容</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $v)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this, '{{$v->conf_id}}')" value="{{$v->conf_order}}">
                    </td>
                    <td class="tc">{{$v->conf_id}}</td>
                    <td>{{$v->conf_title}}</td>
                    <td>{{$v->conf_name}}</td>
                    <td>{{$v->field_type}}</td>
                    <input type="hidden" name="conf_id[]" value="{{$v->conf_id}}">{{--这里加[]多个值的时候就不会被覆盖了--}}
                    <td>{!! $v->_html!!}</td>
                    <td>
                        <a href="{{url('admin/conf/'.$v->conf_id.'/edit')}}">修改</a>
                        <a href="javascript:;" onclick="del({{$v->conf_id}});">删除</a>
                    </td>
                </tr>
                @endforeach
            </table>
                <div class="btn_group">
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回" >
                </div>
            </form>
        </div>
    </div>

<!--搜索结果页面 列表 结束-->
<script>
    /**页面排序号改变的时候调用此异步方法
     * 思路：传入当前排序号。是一个对象。跟id号
     *       页面传入的参数  _token:{csrf_token()}}必须得加上。laravel保护机制
     *       回调函数 如果等于1则表示修改成功
     * @param obj       $this   表示页面输入的排序号
     * @param conf_id
     */
    function changeOrder(obj,conf_id) {
        var conf_order = $(obj).val();
        $.post("{{url('admin/conf/changeOrder')}}",{'_token':'{{csrf_token()}}','conf_order':conf_order,'conf_id':conf_id},function(data) {
            if (data.re == 1) {
                location.href = location.href
                layer.msg(data.msg, {icon: 6})
            } else {
                layer.msg(data.msg, {icon: 5})
            }
        });
    }
    //询问框
    function del(conf_id) {
        layer.confirm('确定要删除吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/conf/')}}/"+conf_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                if (data.re ==1){
                    location.href = location.href
                    layer.msg(data.msg, {icon: 6})
                } else {
                    layer.msg(data.msg, {icon: 5})
                }
            });
        });
    }
</script>
@endsection
