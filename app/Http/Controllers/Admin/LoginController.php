<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/code.class.php'; //引入第三方类库
class LoginController extends CommonController
{
    /**后台登录页
     * 1:判断表单里是否有值传过来了，跟TP里的，IS_POST一样
     * 2:实例化第三方扩展类 空间不在本页，加\到底层空间找
     * 3:实例化的类调get()返回验证码
     * 4:如果传过来的验证码不等于生成后的验证则打印错误信息。终止下面代码，通过则走第5步
     * 5:获取表里一行一列的信息
     * 6:如果表里的user_name不等于用户输入的user_name 或者 解密后的user_pass不等于用户传过来的user_pass都不能通过
     * 7：把登录者信息存到session里 这里需要在入口文件index.php开启源生session  
     * @return mixed
     */
    public function login()
    {
        if ($input = Input::all()) {// dd($input);这样报错是因为laravel本身有csrf机制，要在模版form里加{{csrf_field()}}
            $code = new \Code;
            $getcode = $code->get();
            if (strtoupper($input['code'])!=$getcode) { //strtoupper — 将字符串转化为大写 strtolower — 将字符串转化为小写
                return back()->with('msg','验证码错误');
            }
            $user = User::first();//dd($user);
            if ($user->user_name != $input['user_name'] || Crypt::decrypt($user->user_pass) != $input['user_pass']) {
                return back()->with('msg','用户名或密码错误');
            }
            session(['user'=> $user]);//dd(session('user'));
            return redirect('admin/index');
        } else {
            return view('admin.login');
        }
    }

    /**第三方写的验证码类
     * 1：首先得本页引入第三方类。
     * 2：实例化的使用因为是引入的空间不在本页，加\（反斜杠）在底层空间找文件
     * 3：调用第三方类里的方法
     */
    public function code()
    {
        $code = new \Code;
        $code->make();
    }

    /**退出的时候清空session。这样没登录的就没session值。要跳到登录页
     * @return mixed
     */
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }

    /**
     * 密码加密与解密
     */
//    public function crypt()
//    {
//        $jiami = '123456';
//        echo Crypt::encrypt($jiami);                         //加密密码
//        echo "<br/>";
//        $jiemi = 'eyJpdiI6IkJJeEpWaUV4OXpFc3pcLzJEREl3dUJBPT0iLCJ2YWx1ZSI6ImFTMnVcL3VUSlVuN1AwcVAxbzFDU2xBPT0iLCJtYWMiOiI2MzYwMjE4OGQ3MTYzYjkwYmE2MTRjNmUxZDgzMzNiMjhiYTljOWM0ZjI5MzYyYzNjMGMwMGFlMWRhYWI2ZjU5In0=';
//        echo Crypt::decrypt($jiemi);                         //解密密码
//    }

    /**测试
     * 获取验证码session,因为laravel自身有session机制，使用第三方的类的时候要在入口文件开启session
     */
//    public function getcode()
//    {
//        $code = new \Code;
//        echo $code->get();
//    }
}
