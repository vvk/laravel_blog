<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\ArticleTag;
use App\Http\Models\Tag;
use App\Http\Requests;
use App\Http\Models\Article;
use Illuminate\Support\Facades\Response;

class TagController extends CommonController
{
    protected $tag;

    public function __construct(Tag $tag) {
        parent::__construct();
        $this->tag = $tag;
    }

    public function index(){

    }

    public function tag($tag){
        $tagInfo = Tag::where('status', 1)->where('name', $tag)->first();
        if(!$tagInfo){
            abort(404);
        }

        $tagId = ArticleTag::where('tag_id', $tagInfo->id)->get()->toArray();

        $articleId = array_map(function($arr){
            return $arr['article_id'];
        }, $tagId);

        $data = Article::where('status', 2)->whereIn('id', $articleId)
            ->select('id','name','category_id','thumb','publish_time', 'content')
            ->orderBy('publish_time', 'desc')->paginate(10);

        $hotArticle = $this->getHotArticle();

        //推荐文章
        $recommendArticle = $this->getRecommendArticle();

        //查询热门标签
        $hotTags = $this->tag->getHotTags();

        $allTags = $this->tag->getAllTags();

        $page = $data->render();

        return Response::render('index.index', compact('data', 'page', 'hotArticle', 'recommendArticle', 'hotTags', 'allTags', 'tagInfo'));
    }
}
