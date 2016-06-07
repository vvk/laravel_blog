<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Http\Models\Article;

class ArticleController extends CommonController
{

    protected $tag;
    public function __construct(Tag $tag) {
        parent::__construct();
        $this->tag = $tag;
    }

    public function index(Request $request,$id=0){
        $url = $request->fullUrl();

        $data = Article::where('id', $id)->where('status', '2')->first();

        //浏览量累加
        $data->view_count++;
        $data->save();

        //热门文章
        $hotArticle = $this->getHotArticle();

        //推荐文章
        $recommendArticle = $this->getRecommendArticle();

        //当前文章的标签
        $tagId = array();
        if($data->tags){
            foreach($data->tags as $t){
                $tagId[] = $t->tag_id;
            }
        }

        //相关文章  具有相同标签的文章
        $relevanceArticle = $tags = array();
        if($tagId){
            $relevanceArticle = Article::where('status', 2)
                ->whereIn('id', $tagId)->select('id','name')->orderBy('view_count', 'desc')
                ->limit(10)->get()->toArray();
            $tags = Tag::whereIn('id', $tagId)->where('status', 1)->get()->toArray();
        }

        $allTags = $this->tag->getAllTags();

        return Response::render('article.article', compact('hotArticle', 'data', 'url', 'relevanceArticle', 'tags', 'recommendArticle', 'allTags'));
    }

}
