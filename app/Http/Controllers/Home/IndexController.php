<?php
/**
 * 前台控制器
 *
 * @version 0.1.0
 * @author zqq 707297386@qq.com
 * @date 16/9/12
 *
 */
namespace App\Http\Controllers\Home;

use App\Http\Model\About;
use App\Http\Model\Article;
use App\Http\Model\Category;

/**
 * Class IndexController
 * @package App\Http\Controllers\Home
 */
class IndexController extends CommonController
{
    /**
     * 首页
     *
     * @return mixed
     */
    public function index ()
    {
        $list = Article::orderBy('art_time', 'desc')->paginate(6);
        $ainfo = About::first();
        return view('home/index', compact('list', 'ainfo'));
    }

    /**
     * 文章栏目页
     *
     * @param $cate_id
     * @return int
     */
    public function cate ($cate_id)
    {
        $cate = Category::find($cate_id);
        if (empty($cate)) {
            return 404;
        }
        $newcate = Article::where('cate_id', $cate_id)->orderBy('art_time', 'desc')->paginate(4);
        $fuji = Category::where('cate_pid', $cate_id)->get();
        return view('home/cate', compact('cate', 'newcate', 'fuji'));
    }

    /**
     * 文章内容页
     *
     * @param $art_id
     * @return int
     */
    public function art ($art_id)
    {
        $con = Article::Join('category', 'article.cate_id', '=', 'category.cate_id')->where('art_id', $art_id)->first();
        if (empty($con)) {
            return 404;
        }
        Article::where('art_id', $art_id)->increment('art_view');
        /** 上一篇     下一篇 */
        $article['pre'] = Article::where('art_id', '<', $art_id)->orderBy('art_id', 'desc')->first();
        $article['next'] = Article::where('art_id', '>', $art_id)->orderBy('art_id', 'asc')->first();
        return view('home/art', compact('con', 'article'));
    }

    /**
     * 关于我
     *
     * @return mixed
     */
    public function about ()
    {
        $about = About::first();
        return view('home/about', compact('about', $about));
    }
}
