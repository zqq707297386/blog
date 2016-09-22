<?php
/**
 * User Model 的登录 控制器
 *
 * @version 0.1.0
 * @author zqq 707297386@qq.com
 * @date 16/9/12
 *
 */
namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/Code.class.php';

/**
 * Class LoginController
 * @package App\Http\Controllers\Admin
 */
class LoginController extends CommonController
{
    /**
     * 登录验证
     * strtoupper()      把所输入的验证码转为大写
     * @return mixed    错误信息或后台主页
     */
    public function login ()
    {
        if ($input = Input::all()) {
            $code = new \Code;
            $getcode = $code->get();
            if (strtoupper($input['code']) != $getcode) {
                return back()->with('msg', '验证码错误');
            }
            $user = User::first();
            if ($user->user_name != $input['user_name'] || Crypt::decrypt($user->user_pass) != $input['user_pass']) {
                return back()->with('msg', '用户名或密码错误');
            }
            session(['user' => $user]);
            return redirect('admin/index');
        } else {
            return view('admin.login');
        }
    }

    /**
     *第三方验证码类
     *
     * @package resources/org/code/Code.class.php
     * @return  验证码
     */
    public function code ()
    {
        $code = new \Code;
        $code->make();
    }

    /**
     * 清空session （入口文件开启了源生session）
     *
     * @return      session清空后返回登录页
     */
    public function quit ()
    {
        session(['user' => null]);
        return redirect('admin/login');
    }

//    public function crypt()
//  {
//        $jiami = '123456';
//        echo Crypt::encrypt($jiami);
//  }

}
