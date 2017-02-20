<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->input('status', 0);

        $where = array();
        if ($status) {
            $where['status'] = $status;
        }
        $data = Article::where($where)->whereIn('status', array(1, 2))->orderBy('id', 'desc')->paginate();

        $breadcrumb = array('文章管理');

        return view('admin.article.index', compact('data', 'status', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryRepository $category)
    {

        $data = array();
        $id = 0;

        $categoryTree['default'] = $categoryTree['list'][] = $category->getCategoryTree();

        $tag = Tag::where('status', 1)->get();

        $breadcrumb = array('文章管理', '写文章');
        return view('admin.article.edit', compact('breadcrumb', 'categoryTree', 'data', 'id', 'tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request, ArticleRepository $article)
    {
        return $article->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryRepository $category, $id)
    {
        $data = Article::where('id', $id)->whereIn('status', array(1, 2))->first();
        if (!$data) {
            return adminError(trans('error.modify_article_not_exist'));
        }

        $ArticleTagId = $categoryTree = array();
        foreach ($data->tagId as $item) {
            $ArticleTagId[] = $item->tag_id;
        }

        $categoryTree['default'] = $category->getCategoryTree();
        foreach ($data->category->toArray() as $item) {
            $categoryTree['list'][] = $category->getCategoryTree(0, $item['id']);
        }
        $categoryTree['list'] = array_unique($categoryTree['list']);

        $tag = Tag::where('status', 1)->get();
        $breadcrumb = array('文章管理', '修改文章');
        return view('admin.article.edit', compact('breadcrumb', 'categoryTree', 'data', 'id', 'tag', 'ArticleTagId', 'articleCategoryId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ArticleRepository $article)
    {
        return $article->destroy($request);
    }
}
