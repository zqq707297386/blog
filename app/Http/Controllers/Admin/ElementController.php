<?php
/**
 * 网站大全（因为不常修改，所以此页面为静态）
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

/**
 * Class ElementController
 * @package App\Http\Controllers\Admin
 */
class ElementController extends Controller
{
    public function element ()
    {
        return view('admin/element');
    }
}
