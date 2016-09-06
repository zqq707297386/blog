<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    public function index()
    {
        $data = Article::orderBy('art_id','desc')->paginate(8);
        return view('admin.article.index',compact('data'));
    }

    public function create()
    {
        $data = (new Category)->tree();
        return view('admin.article.add',compact('data'));
    }
    
    public function edit($art_id)
    {
        $data = (new Category)->tree();
        $art_info = Article::find($art_id);
        return view('admin.article.edit',compact('data','art_info'));
    }
    
    public function update($art_id)
    {
        $update = Input::except('_token','_method');
        if (Article::where('art_id',$art_id)->update($update)) {
            return redirect('admin/article');
        } else {
            return back()->with('errors','未知错误！稍后重试');
        }
    }
    
    public function destroy($art_id)
    {
        if (Article::where('art_id',$art_id)->delete()) {
            $data = [
                're'=>1,
                'msg'=>'删除成功'
            ];
        } else {
            $data = [
                're'=>0,
                'msg'=>'删除失败！'
            ];
        }
        return $data;
    }
    
    public function store(Request $request)
    {
        $article = Input::except('_token');
        $article['art_time'] = time();
        $rules = [
            'art_title'=>'required',
            'art_editor'=>'required'
        ];
        $errors = [
            'art_title.required'=>'文章标题不能为空！',
            'art_editor.required'=>'文章编辑者不能为空！'
        ];
        $val = Validator::make($article,$rules,$errors);
        if ($val->passes()) {
            if (Article::create($article)){
                return redirect('admin/article');
            } else {
                return back()->with('errors','未知错误！稍后重试');
            }
        } else {
            return back()->withErrors($val);
        }
    }

    public function show($art_id)
    {
    }
    
}
