@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <i class="fa fa-home"></i>
        <a href="{{url('admin/info')}}">首页</a> &raquo;
        <a href="#">文章列表</a>
    </div>
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                </div>
            </div>
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">文章ID</th>
                        <th>文章标题</th>
                        <th>文章编辑者</th>
                        <th>发布时间</th>
                        <th>查看次数</th>
                        <th>操作</th>
                    </tr>

                    @foreach($data as $v)
                        <tr>
                            <td class="tc">{{$v->art_id}}</td>
                            <td><a href="#">{{$v->art_title}}</a></td>
                            <td>{{$v->art_editor}}</td>
                            <td>{{date('Y年m月d日',$v->art_time)}}</td>
                            <td>{{$v->art_view}}</td>
                            <td>
                                <a href="{{url('admin/article/'.$v->art_id.'/edit')}}">修改</a>
                                <a href="javascript:;" onclick="del({{$v->art_id}});">删除</a>
                            </td>
                        </tr>
                    @endforeach

                </table>


                <div class="page_list">
                    <div>
                        {{$data->links()}}
                    </div>
                </div>
                <style>
                    .result_content ul li span {
                        font-size: 15px;
                        padding: 6px 12px;
                    }
                </style>


            </div>
        </div>
    </form>
    <script>
        function del(art_id) {
            layer.confirm('确定要删除吗？', {
                btn: ['确定', '取消']
            }, function () {
                $.post("{{url('admin/article/')}}/" + art_id, {
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
