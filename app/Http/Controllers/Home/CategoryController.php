<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Article;
use App\Http\Models\Category;
use Illuminate\Support\Facades\Response;
use App\Http\Models\Tag;
use Cookie;


class CategoryController extends CommonController
{
    public function index(Tag $tag, $id){

        //判断分类是否存在
        $cuttentCategory = Category::where('id', $id)->where('status', 1)->select('name')->first();
        if(!$cuttentCategory){
            abort(404);
        }

        $data = Article::where('status', 2)->select('id','name','category_id','thumb','publish_time', 'content')
            ->where('category_id', $id)
            ->orderBy('publish_time', 'desc')->paginate(10);

        $hotArticle = $this->getHotArticle();

        //推荐文章
        $recommendArticle = $this->getRecommendArticle();

        //查询热门标签
        $hotTags = $tag->getHotTags();

        $allTags = $tag->getAllTags();

        $page = $data->render();

        return Response::render('index.index', compact('data', 'page','hotArticle', 'recommendArticle', 'hotTags', 'cuttentCategory', 'allTags'));
    }
}
