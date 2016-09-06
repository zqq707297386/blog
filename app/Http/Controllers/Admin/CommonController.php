<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{

    public function uploadify()
    {
        $file = Input::file('Filedata');
        if ($file->isValid()) {
            $postfix = $file->getClientOriginalExtension();
            $fileNewName = date('YmdHis').mt_rand(100,999).'.'.$postfix;
            $path =  $file->move(base_path().'/uploads',$fileNewName);
            $NewPath = 'uploads/'.$fileNewName;
            return $NewPath;
        } else {
            return back()->with('msg','上传时发生未知错误');
        };
    }
}
