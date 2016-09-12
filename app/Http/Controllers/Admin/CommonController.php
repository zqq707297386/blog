<?php
/**
 * 此Controller 继承了 Controller
 *
 * @version 0.1.0
 * @author zqq 707297386@qq.com
 * @date 16/9/12
 *
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

/**
 * Class CommonController
 * @package App\Http\Controllers\Admin
 */
class CommonController extends Controller
{
    /**
     * 图片上传
     *
     * @return string   返回的是图片的路径
     */
    public function uploadify ()
    {
        $file = Input::file('Filedata');
        if ($file->isValid()) {
            $postfix = $file->getClientOriginalExtension();
            $fileNewName = date('YmdHis') . mt_rand(100, 999) . '.' . $postfix;
            $path = $file->move(base_path() . '/uploads', $fileNewName);
            $NewPath = 'uploads/' . $fileNewName;
            return $NewPath;
        } else {
            return back()->with('msg', '上传时发生未知错误');
        };
    }
}
