<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Link;
use App\Http\Model\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        //导航栏
        $nav = Nav::orderBy('nav_id','asc')->get();
        View::share('nav',$nav);
        //友情链接2条
        $link = Link::orderBy('link_order','asc')->get();
        View::share('link',$link);
        //最早发布8篇
        $new = Article::orderBy('art_time','asc')->take(8)->get();
        View::share('new',$new);
        //点击排行的5篇
        $hotclick = Article::orderBy('art_view','desc')->take(6)->get();
        View::share('hotclick',$hotclick);
    }

}
