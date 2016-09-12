<?php
/**
 * 继承Controller 的前台父类控制器
 *
 * @version 0.1.0
 * @author zqq 707297386@qq.com
 * @date 16/9/12
 *
 */
namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Link;
use App\Http\Model\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

/**
 * Class CommonController
 * @package App\Http\Controllers\Home
 */
class CommonController extends Controller
{
    /**
     * 构造函数（页面加载自动执行）
     *
     * CommonController constructor.
     */
    public function __construct ()
    {
        /** 导航栏信息*/
        $nav = Nav::orderBy('nav_id', 'asc')->get();
        View::share('nav', $nav);

        /** 友情链接*/
        $link = Link::orderBy('link_order', 'asc')->get();
        View::share('link', $link);

        /** 最新的8篇*/
        $new = Article::orderBy('art_time', 'asc')->take(8)->get();
        View::share('new', $new);

        /** 点击率最高的6篇*/
        $hotclick = Article::orderBy('art_view', 'desc')->take(6)->get();
        View::share('hotclick', $hotclick);

        /** 图片推荐*/
        $r_pic_id = Article::orderBy('art_time', 'desc')->where('r_pic_id', 1)->take(4)->get();
        View::share('r_pic_id', $r_pic_id);
    }

}
