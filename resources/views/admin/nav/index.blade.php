@extends('layouts.admin')
@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i>
    <a href="{{url('admin/info')}}">首页</a> &raquo;
    <a href="#">导航列表</a>
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->

<!--结果页快捷搜索框 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/nav/create')}}"><i class="fa fa-plus"></i>自定义导航添加</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc">排序</th>
                    <th class="tc">ID</th>
                    <th>导航名称</th>
                    <th>导航别名</th>
                    <th>URL</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $v)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this, '{{$v->nav_id}}')" value="{{$v->nav_order}}">
                    </td>
                    <td class="tc">{{$v->nav_id}}</td>
                    <td><a href="#">{{$v->nav_name}}</a></td>
                    <td>{{$v->nav_alias}}</td>
                    <td>{{$v->nav_url}}</td>
                    <td>
                        <a href="{{url('admin/nav/'.$v->nav_id.'/edit')}}">修改</a>
                        <a href="javascript:;" onclick="del({{$v->nav_id}});">删除</a>
                    </td>
                </tr>
                @endforeach

            </table>

        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
<script>
    /**页面排序号改变的时候调用此异步方法
     * 思路：传入当前排序号。是一个对象。跟id号
     *       页面传入的参数  _token:{csrf_token()}}必须得加上。laravel保护机制
     *       回调函数 如果等于1则表示修改成功
     * @param obj       $this   表示页面输入的排序号
     * @param nav_id
     */
    function changeOrder(obj,nav_id) {
        var nav_order = $(obj).val();
        $.post("{{url('admin/nav/changeOrder')}}",{'_token':'{{csrf_token()}}','nav_order':nav_order,'nav_id':nav_id},function(data) {
            if (data.re == 1) {
                location.href = location.href
                layer.msg(data.msg, {icon: 6})
            } else {
                layer.msg(data.msg, {icon: 5})
            }
        });
    }
    //询问框
    function del(nav_id) {
        layer.confirm('确定要删除吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/nav/')}}/"+nav_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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
