@extends('layouts.admin')
@section('content')
<div class="crumb_warp">
    <i class="fa fa-home"></i>
    <a href="{{url('admin/info')}}">首页</a> &raquo;
    <a href="#">友情链接列表</a>
</div>
<form action="#" method="post">
    <div class="result_wrap">
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/link/create')}}"><i class="fa fa-plus"></i>新增友情链接</a>
            </div>
        </div>
    </div>
    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc">排序</th>
                    <th class="tc">ID</th>
                    <th>友情链接名称</th>
                    <th>友情链接标题</th>
                    <th>友情链接URL</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $v)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this, '{{$v->link_id}}')" value="{{$v->link_order}}">
                    </td>
                    <td class="tc">{{$v->link_id}}</td>
                    <td>
                        <a href="#">{{$v->link_name}}</a>
                    </td>
                    <td>{{$v->link_title}}</td>
                    <td>{{$v->link_url}}</td>
                    <td>
                        <a href="{{url('admin/link/'.$v->link_id.'/edit')}}">修改</a>
                        <a href="javascript:;" onclick="del({{$v->link_id}});">删除</a>
                    </td>
                </tr>
                @endforeach

            </table>

        </div>
    </div>
</form>
<script>
    function changeOrder(obj,link_id) {
        var link_order = $(obj).val();
        $.post("{{url('admin/link/changeOrder')}}",{'_token':'{{csrf_token()}}','link_order':link_order,'link_id':link_id},function(data) {
            if (data.re == 1) {
                location.href = location.href
                layer.msg(data.msg, {icon: 6})
            } else {
                layer.msg(data.msg, {icon: 5})
            }
        });
    }
    function del(link_id) {
        layer.confirm('确定要删除吗？', {
            btn: ['确定','取消']
        }, function(){
            $.post("{{url('admin/link/')}}/"+link_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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
