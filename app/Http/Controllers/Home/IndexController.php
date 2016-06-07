<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Article;
use App\Http\Models\Tag;
use Illuminate\Support\Facades\Response;

class IndexController extends CommonController {
    public function __construct() {
        parent::__construct();
    }

    public function index(Tag $tag) {

        $data = Article::where('status', 2)->select('id','name','category_id','thumb','publish_time', 'content')
            ->orderBy('publish_time', 'desc')->paginate(10);

        $hotArticle = $this->getHotArticle();

        //推荐文章
        $recommendArticle = $this->getRecommendArticle();

        //查询热门标签
        $hotTags = $tag->getHotTags();

        $allTags = $tag->getAllTags();

        return Response::render('index.index', compact('data', 'hotArticle', 'recommendArticle', 'hotTags', 'allTags'));
    }
}