<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\ArticleTag;
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
        $data = Article::where('id', $id)->where('status', '2')->first();
        if(!$data){
            abort(404);
        }

        $url = url()->current();
        $type = $request->input('type', '');

        if($type!='view'){
            //浏览量累加
            $data->view_count++;
            $data->save();
        }

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

        //相关文章  具有相同标签的文章  上一篇 下一篇
        $relevanceArticle = $tags = $siblingArticle = array();
        if($tagId){
            $relevanceArticleId = ArticleTag::where('article_id', '!=', $data->id)
                                    ->whereIn('tag_id', $tagId)->select('article_id')->get();

            $arr = array();
            if($relevanceArticleId){
                foreach($relevanceArticleId as $item){
                    $arr[] = $item->article_id;
                }
            }

            $relevanceArticle = Article::where('status', 2)
                ->whereIn('id', $arr)->select('id','name')->orderBy('view_count', 'desc')
                ->limit(10)->get()->toArray();

            $tags = Tag::whereIn('id', $tagId)->where('status', 1)->get()->toArray();
        }

        $allTags = $this->tag->getAllTags();
        $title = $data->name;
        $keywords = $data->keywords;
        $description = $data->description;

        $keywords .= ($keywords ? ' - ' : '').config('web.web_keywords');
        if(!$description){
            $description = str_limit(strip_tags($data->content),360);
        }

        $siblingArticle['preview'] = Article::where('id', '<', $id)->where('status', 2)->select('id', 'name')->orderBy('id', 'desc')->first();
        $siblingArticle['next'] = Article::where('id', '>', $id)->where('status', 2)->select('id', 'name')->first();

        return Response::render('article.article', compact('hotArticle', 'title', 'keywords', 'description', 'data', 'url', 'relevanceArticle', 'tags', 'recommendArticle', 'allTags', 'siblingArticle'));
    }

}
