<?php
/**
 * Article Model 的 文章控制器
 *
 * @version 0.1.0
 * @author zqq 707297386@qq.com
 * @date 16/9/12
 *
 */
namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

/**
 * Class ArticleController
 * @package App\Http\Controllers\Admin
 */
class ArticleController extends CommonController
{
    /**
     * 列表显示8篇文章
     *
     * @return array    降序取出8篇文章
     */
    public function index ()
    {
        $data = Article::orderBy('art_id', 'desc')->paginate(8);
        return view('admin.article.index', compact('data'));
    }

    /**
     * 显示创建文章页面
     *
     * @return array    返回顶级分类与子分类
     */
    public function create ()
    {
        $data = (new Category)->tree();
        return view('admin.article.add', compact('data'));
    }

    /**
     * 存储新添加的文章信息
     *
     * @param Request $request
     * @return array    返回新存储的一篇文章
     */
    public function store (Request $request)
    {
        $article = Input::except('_token');
        $article['art_time'] = time();
        $rules = [
            'art_title' => 'required',
            'art_editor' => 'required'
        ];
        $errors = [
            'art_title.required' => '文章标题不能为空！',
            'art_editor.required' => '文章编辑者不能为空！'
        ];
        $val = Validator::make($article, $rules, $errors);
        if ($val->passes()) {
            if (Article::create($article)) {
                return redirect('admin/article');
            } else {
                return back()->with('errors', '未知错误！稍后重试');
            }
        } else {
            return back()->withErrors($val);
        }
    }

    /**
     * 显示文章修改的指定页面
     *
     * @param $art_id   根据文章ID
     * @return array    返回一篇文章信息
     */
    public function edit ($art_id)
    {
        $data = (new Category)->tree();
        $art_info = Article::find($art_id);
        return view('admin.article.edit', compact('data', 'art_info'));
    }

    /**
     * 跟新存储中指定的文章资源
     *
     * @param $art_id   获取的文章ID
     * @return array    返回一篇跟新后的文章
     */
    public function update ($art_id)
    {
        $update = Input::except('_token', '_method');
        if (Article::where('art_id', $art_id)->update($update)) {
            return redirect('admin/article');
        } else {
            return back()->with('errors', '未知错误！稍后重试');
        }
    }

    /**
     * 删除指定的文章资源
     *
     * @param $art_id   文章ID
     * @return array    返回删除是否成功的信息
     */
    public function destroy ($art_id)
    {
        if (Article::where('art_id', $art_id)->delete()) {
            $data = [
                're' => 1,
                'msg' => '删除成功'
            ];
        } else {
            $data = [
                're' => 0,
                'msg' => '删除失败！'
            ];
        }
        return $data;
    }

    /**
     * 显示资源
     *
     * @param $art_id
     */
    public function show ($art_id)
    {
    }

}
