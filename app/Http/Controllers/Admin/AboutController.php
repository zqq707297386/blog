<?php
/**
 * About Model 的 about me Controller
 *
 * @version 0.1.0
 * @author zqq 707297386@qq.com
 * @date 16/9/12
 *
 */
namespace App\Http\Controllers\Admin;

use App\Http\Model\About;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

/**
 * Class AboutController
 * @package App\Http\Controllers\Admin
 */
class AboutController extends CommonController
{
    /**
     * 显示about me页面
     *
     * @return object   返回about me的信息
     */
    public function index ()
    {
        $ainfo = About::first();
        return view('admin.about.index', compact('ainfo'));
    }

    /**
     * 显示创建about me页面
     *
     * @return view     返回视图
     */
    public function create ()
    {
        return view('admin.about.add');
    }

    /**
     * 存储新添加的about me信息
     *
     * @param  Request $request    POST请求
     * @return array               返回一条新添加的信息
     */
    public function store (Request $request)
    {
        $about = Input::except('_token');
        if (About::create($about)) {
            return redirect('admin/about');
        } else {
            return back()->with('errors', '未知错误！稍后重试');
        }
    }

    /**
     * 显示修改about me的指定页面
     *
     * @param  int $about_id
     * @return \Illuminate\Http\Response    返回修改后信息
     */
    public function edit ($about_id)
    {
        $ainfo = About::first();
        return view('admin.about.edit', compact('ainfo'));
    }

    /**
     * 跟新存储中指定的about me资源
     *
     * @param  \Illuminate\Http\Request $request    PUT请求
     * @param  int $about_id about me的ID
     * @return \Illuminate\Http\Response            跟新后的信息
     */
    public function update (Request $request, $about_id)
    {
        $upinfo = Input::except('_token', '_method');
        if (About::where('about_id', $about_id)->update($upinfo)) {
            return redirect('admin/about');
        } else {
            return back()->with('errors', '未知错误！稍后重试');
        }
    }

    /**
     * @param $about_id
     */
    public function destroy ($about_id)
    {

    }

    /**
     * 显示资源
     *
     * @param  int $about_id
     * @return \Illuminate\Http\Response
     */
    public function show ($about_id)
    {
        //
    }
}
