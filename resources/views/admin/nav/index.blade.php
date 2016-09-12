@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <i class="fa fa-home"></i>
        <a href="{{url('admin/info')}}">首页</a> &raquo;
        <a href="#">导航列表</a>
    </div>
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/nav/create')}}"><i class="fa fa-plus"></i>自定义导航添加</a>
                </div>
            </div>
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
                                <input type="text" onchange="changeOrder(this, '{{$v->nav_id}}')"
                                       value="{{$v->nav_order}}">
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
    <script>
        function changeOrder(obj, nav_id) {
            var nav_order = $(obj).val();
            $.post("{{url('admin/nav/changeOrder')}}", {
                '_token': '{{csrf_token()}}',
                'nav_order': nav_order,
                'nav_id': nav_id
            }, function (data) {
                if (data.re == 1) {
                    location.href = location.href
                    layer.msg(data.msg, {icon: 6})
                } else {
                    layer.msg(data.msg, {icon: 5})
                }
            });
        }
        function del(nav_id) {
            layer.confirm('确定要删除吗？', {
                btn: ['确定', '取消']
            }, function () {
                $.post("{{url('admin/nav/')}}/" + nav_id, {
                    '_method': 'delete',
                    '_token': "{{csrf_token()}}"
                }, function (data) {
                    if (data.re == 1) {
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
