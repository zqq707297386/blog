<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

//这个控制器继承Controllers下的Controller这样就不用每个Admin下的控制器写一大长串引入控制器了
class CommonController extends Controller
{
    /**文件上传
     * 1：获取数据
     * 2：isValid()检验一下上传的文件是否有效.
     * 3：getClientOriginalExtension()获得上传文件的后缀
     * 4：创建新的文件名
     * 5：把新文件移动到新的目录下 。  move(第一个参数是路径，第二个是文件名) base_path()是表示跟目录
     * @return string
     */
    public function uploadify()
    {
        //dd(Input::all());  打印出来的东西、只有Filedata里的才有用
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
