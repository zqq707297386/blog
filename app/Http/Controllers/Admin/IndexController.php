<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function index()
   {
       return view('admin.index');
   }

    public function info()
    {
        return view('admin.info');
    }
    
    public function pass()
    {
        if ($input = Input::all())
        {
            $rules = [
                     'password'=>'required|between:6,20|confirmed',
                     ];
            $errors=[
                'password.required'=>'新密码不能为空',
                'password.between'=>'密码必须在6-20位之间',
                'password.confirmed'=>'新密码和确认密码不一致',
            ];
           $val = Validator::make($input,$rules,$errors);
            if ($val->passes())
            {
                $user = User::first();
                $_password = Crypt::decrypt($user->user_pass);
                if ($input['password_o']==$_password)
                {
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors','修改密码成功');
                } else {
                    return back()->with('errors','原密码错误');
                }
            } else {
                return back()->withErrors($val);
            }
        } else {
            return view('admin.pass');
        }
    }
}
