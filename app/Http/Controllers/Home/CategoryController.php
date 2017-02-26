<?php

namespace App\Http\Controllers\Home;

use App\Models\ArticleCategory;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Article as ArticeService;
use Tag as TagService;

class CategoryController extends CommonController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($id)
    {
        $category = Category::where('id', $id)->where('status', 1)->select('name','keywords','description')->first();
        if (!$category) {
            abort(404);
        }

        $categoryId = ArticleCategory::where('category_id', $id)->get()->toArray();

        $articleId = array_map(function($arr){
            return $arr['article_id'];
        }, $categoryId);

        $articleId = array_unique($articleId);

        $data = Article::where('status', 2)->whereIn('id', $articleId)
            ->select('id','name','thumb','publish_time', 'content', 'description', 'view_count')
            ->orderBy('publish_time', 'desc')->paginate(10);

        $page = $data->render();

        $title = $category->name;
        $keywords = $category->keywords;
        $description = $category->description;

        return Response::render('index.index', compact('data', 'title', 'keywords', 'description', 'page', 'category'));
    }
}
