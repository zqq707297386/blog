@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <i class="fa fa-home"></i>
        <a href="{{url('admin/info')}}">首页</a> &raquo;
        <a href="#">修改文章</a>
    </div>
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
                <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>文章列表</a>
            </div>
        </div>
    </div>
    <div class="result_wrap">
        <form action="{{url('admin/article/'.$art_info->art_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require"></i>所属分类：</th>
                    <td>
                        <select name="cate_id">
                            @foreach($data as $d)
                                <option value="{{$d->cate_id}}"
                                        @if($art_info->cate_id == $d->cate_id) selected @endif
                                >{{$d->_cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>文章编辑者：</th>
                    <td>
                        <input type="text" name="art_editor" required="required" value="{{$art_info->art_editor}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require"></i>文章标题：</th>
                    <td>
                        <input type="text" class="lg" name="art_title" value="{{$art_info->art_title}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require"></i>是否推荐：</th>
                    <td>
                        <input type="radio" name="r_pic_id" value="0" @if($art_info->r_pic_id == 0) checked @endif>不推荐　
                        <input type="radio" name="r_pic_id" value="1" @if($art_info->r_pic_id == 1) checked @endif>推荐
                    </td>
                </tr>
                <tr>
                    <th>缩略图：</th>
                    <td>
                        {{--文件上传的代码--}}
                        <input type="text" size="50" name="art_thumb" value="{{$art_info->art_thumb}}">
                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                        <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}"
                                type="text/javascript"></script>
                        <link rel="stylesheet" type="text/css"
                              href="{{asset('resources/org/uploadify/uploadify.css')}}">
                        <script type="text/javascript">
                            <?php $timestamp = time();?>
                            $(function () {
                                $('#file_upload').uploadify({
                                    'buttonText': '图片上传',
                                    'formData': {
                                        'timestamp': '<?php echo $timestamp;?>',
                                        '_token': '{{csrf_token()}}'
                                    },
                                    'swf': "{{asset('resources/org/uploadify/uploadify.swf')}}",
                                    'uploader': "{{asset('admin/uploadify')}}",
                                    'onUploadSuccess': function (file, data, response) {
                                        $('input[name=art_thumb]').val(data)
                                        $('#art_thumb_img').attr('src', '/' + data)
                                    }
                                });
                            });
                        </script>
                        {{--文件上传的样式矫正代码--}}
                        <style>
                            .uploadify {
                                display: inline-block;
                            }

                            .uploadify-button {
                                border: none;
                                border-radius: 5px;
                                margin-top: 8px;
                            }

                            table.add_tab tr td span.uploadify-button-text {
                                color: #FFF;
                                margin: 0;
                            }
                        </style>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    {{--缩略图的显示位置。加最大宽高，以免图片过大，页面变形--}}
                    <td>
                        <img src="/{{$art_info->art_thumb}}" alt="" id="art_thumb_img"
                             style="max-width: 350px; max-height: 100px">
                    </td>
                </tr>
                <tr>
                    <th>关键词：</th>
                    <td>
                        <input type="text" class="lg" name="art_tag" value="{{$art_info->art_tag}}">
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <textarea class="lg" name="art_description">{{$art_info->art_description}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>文章内容：</th>
                    <td>
                        {{--富文本所需的所有文件--}}
                        <script type="text/javascript" charset="utf-8"
                                src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
                        <script type="text/javascript" charset="utf-8"
                                src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"></script>
                        <script type="text/javascript" charset="utf-8"
                                src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                        <script id="editor" name="art_content" type="text/plain"
                                style="width:800px;height:500px;">{!!$art_info->art_content!!}</script>
                        <script type="text/javascript">
                            var ue = UE.getEditor('editor');
                        </script>
                        {{--富文本编辑样式的矫正--}}
                        <style>
                            .edui-default {
                                line-height: 28px;
                            }

                            div.edui-combox-body, div.edui-button-body, div.edui-splitbutton-body {
                                overflow: hidden;
                                height: 20px;
                            }

                            div.edui-box {
                                overflow: hidden;
                                height: 22px;
                            }
                        </style>
                    </td>
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
@endsection