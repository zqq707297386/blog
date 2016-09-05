<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;          //引入UserModel,
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    /**
     * @return 视图模版
     */
    public function index()
   {
       /* $pdo = DB::connection()->getPdo();  //PDO连接数据库，确定是否能连上
          dd($pdo);                          //dd相当于dump()
          $users = DB::table('user')->get();
          dd($users);
          $user = User::where('user_id',1)->get();
          dd($user);
      $user = User::find(1);   //这里因为数据库主键是user_id，所以报错。要到Model设置主键
      $user->user_name='zhengqiqiang';
      $user->update();
      dd($user);
     */
       return view('admin.index');
   }
    /**
     * @return 右边视图模版
     */
    public function info()
    {
        return view('admin.info');
    }
    
    /**
     * 密码修改验证 （大体思路）
     * Input::all()接收信息
     * Validator::make()自己制作验证方法，跟提示信息
     * 通过了给user_pass重新赋加密后的值，并跳转
     * 没通过。本页显示错误信息
     * @return mixed
     */
    public function pass()
    {
        if ($input = Input::all())
        {
            $rules = [         //1:必填字段|2:在6，20位之间|3：匹配确认密码和新密码 (这三个不能变)    自定义验证规则
                     'password'=>'required|between:6,20|confirmed',
                     ];
            $errors=[                                          //验证不通过的提示信息
                'password.required'=>'新密码不能为空',
                'password.between'=>'密码必须在6-20位之间',
                'password.confirmed'=>'新密码和确认密码不一致',
            ];
           $val = Validator::make($input,$rules,$errors);     //Validator验证器::make制作方法
            if ($val->passes())                                 //passes通过
            {
                $user = User::first();                         //1：实例化UserModel
                $_password = Crypt::decrypt($user->user_pass); //2:把解密后的user_pass赋给变量
                if ($input['password_o']==$_password)           //3:如果POST过来的原始密码跟解密后的不同，直接提示错误信息
                {
                    $user->user_pass = Crypt::encrypt($input['password']);//4:如果相同就把加密后的新密码赋给数据库里的密码字段
                    $user->update();
                    return back()->with('errors','修改密码成功');
                } else {
                    return back()->with('errors','原密码错误');            //失败报错
                }
            } else {
                //dd($val->errors()->all());                     //测试抛出错误提示
                return back()->withErrors($val);                 //给错误信息值
            }
        } else {
            return view('admin.pass');
        }
    }
}
