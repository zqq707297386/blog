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
        $nav = Nav::orderBy('nav_id','asc')->get();
        View::share('nav',$nav);

        $link = Link::orderBy('link_order','asc')->get();
        View::share('link',$link);

        $new = Article::orderBy('art_time','asc')->take(8)->get();
        View::share('new',$new);
        
        $hotclick = Article::orderBy('art_view','desc')->take(6)->get();
        View::share('hotclick',$hotclick);
        /**
         * 图片推荐
         */
        $r_pic_id = Article::orderBy('art_time','desc')->where('r_pic_id',1)->take(4)->get();
        View::share('r_pic_id',$r_pic_id);
    }

}
