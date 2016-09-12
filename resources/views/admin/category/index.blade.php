@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <i class="fa fa-home"></i>
        <a href="{{url('admin/info')}}">首页</a> &raquo;
        <a href="#">分类列表</a>
    </div>
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>新增分类</a>
                </div>
            </div>
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>栏目名称</th>
                        <th>栏目标题</th>
                        <th>查看次数</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                        <tr>
                            <td class="tc">
                                <input type="text" onchange="changeOrder(this, '{{$v->cate_id}}')"
                                       value="{{$v->cate_order}}">
                            </td>
                            <td class="tc">{{$v->cate_id}}</td>
                            <td>
                                <a href="#">{{$v->_cate_name}}</a>
                            </td>
                            <td>{{$v->_cate_title}}</td>
                            <td>{{$v->cate_view}}</td>
                            <td>
                                <a href="{{url('admin/category/'.$v->cate_id.'/edit')}}">修改</a>
                                <a href="javascript:;" onclick="del({{$v->cate_id}});">删除</a>
                            </td>
                        </tr>
                    @endforeach

                </table>

            </div>
        </div>
    </form>
    <script>
        function changeOrder(obj, cate_id) {
            var cate_order = $(obj).val();
            $.post("{{url('admin/category/changeOrder')}}", {
                '_token': '{{csrf_token()}}',
                'cate_order': cate_order,
                'cate_id': cate_id
            }, function (data) {
                if (data.re == 1) {
                    location.href = location.href
                    layer.msg(data.msg, {icon: 6})
                } else {
                    layer.msg(data.msg, {icon: 5})
                }
            });
        }
        function del(cate_id) {
            layer.confirm('确定要删除吗？', {
                btn: ['确定', '取消']
            }, function () {
                $.post("{{url('admin/category/')}}/" + cate_id, {
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
