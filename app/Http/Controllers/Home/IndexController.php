<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\About;
use App\Http\Model\Article;
use App\Http\Model\Category;

class IndexController extends CommonController
{
    public function index()
    {
        $list = Article::orderBy('art_time','desc')->paginate(6);
        $ainfo = About::first();
        return view('home/index',compact('list','ainfo'));
    }

    public function cate($cate_id)
    {
        $cate = Category::find($cate_id);
        if (empty($cate)) {
            return 404;
        }
        $newcate = Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->paginate(4);
        $fuji = Category::where('cate_pid',$cate_id)->get();
        return view('home/cate',compact('cate','newcate','fuji'));
    }
    
    public function art($art_id)
    {
        $con = Article::Join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();
        if (empty($con)) {
            return 404;
        }
        Article::where('art_id',$art_id)->increment('art_view');
        $article['pre'] = Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $article['next'] = Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        return view('home/art',compact('con','article'));
    }

    public function about()
    {
        $about = $ainfo = About::first();
        return view('home/about',compact('about',$about));
    }
}
