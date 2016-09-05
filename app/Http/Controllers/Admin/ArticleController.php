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
    /**方法：GET  URL ：admin/article   文章首页
     * paginate()是分页 
     * @return mixed
     */
    public function index()
    {
        $data = Article::orderBy('art_id','desc')->paginate(8);
        return view('admin.article.index',compact('data'));
    }

    /**方法：GET URL ：admin/article/create  文章分类显示
     * @return mixed
     */
    public function create()
    {
        $data = (new Category)->tree();
        return view('admin.article.add',compact('data'));
    }
    
    /**方法：GET  URL ：admin/article/art_id/edit  文章编辑
     * @param $art_id
     * @return mixed
     */
    public function edit($art_id)
    {
        $data = (new Category)->tree();
        $art_info = Article::find($art_id);
        return view('admin.article.edit',compact('data','art_info'));
    }
    
    /**方法：PUT|PATCH  URL ：admin/article/art_id   文章修改
     * @param $art_id
     * @return mixed
     */
    public function update($art_id)
    {
        $update = Input::except('_token','_method');
        if (Article::where('art_id',$art_id)->update($update)) {
            return redirect('admin/article');
        } else {
            return back()->with('errors','未知错误！稍后重试');
        }
    }
    
    /**方法：DELETE  URL ： admin/article/art_id  文章删除
     * @param $art_id
     * @return array
     */
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
    
    /**方法：POST  URL ：admin/article      添加文章
     * @param Request $request
     * @return mixed
     */
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

    // 方法：GET  URL ：admin/article/{article}
    public function show($art_id)
    {
        //
    }
    
}
