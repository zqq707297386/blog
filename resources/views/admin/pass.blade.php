@extends('layouts.admin')
@section('content')

    <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 修改密码
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>修改密码</h3>
        @if(count($errors)>0)
               <div class="mark">
          @if(is_object($errors))      {{--如果错误不是对象，是字符串。则运行else--}}
               @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
               @endforeach
                   @else
                    <p>{{$errors}}</p> {{--这是原密码错误提示--}}
          @endif
                </div>
        @endif
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form method="post" action="">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>原密码：</th>
                <td>
                    <input type="password" name="password_o" placeholder="请输入原密码" required="required"> </i></span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>新密码：</th>
                <td>
                    <input type="password" name="password" placeholder="新密码6-20位" required="required"> </i></span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>确认密码：</th>
                <td>
                    <input type="password" name="password_confirmation" placeholder="再次输入密码" required="required"> </i></span>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <a href="{{url('admin/info')}}"><input type="button" class="back" value="返回"></a>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

@endsection