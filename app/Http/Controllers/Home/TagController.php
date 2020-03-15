<?php

namespace App\Http\Controllers\Home;

use App\Models\Tag;
use App\Models\ArticleTag;
use App\Models\Article;
use Illuminate\Support\Facades\Response;
use Article as ArticeService;
use Tag as TagService;

class TagController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($tag)
    {
        $tagInfo = Tag::where('name', $tag)->where('status', 1)->first();
        if (!$tagInfo) {
            abort(404);
        }

        $tagId = ArticleTag::where('tag_id', $tagInfo->id)->get()->toArray();

        $articleId = array_map(function($arr){
            return $arr['article_id'];
        }, $tagId);
        $articleId = array_unique($articleId);

        $pageSize = $this->options->get('page_size');
        $data = Article::where('status', 2)->whereIn('id', $articleId)
            ->select('id','name','thumb','publish_time', 'content', 'description', 'view_count')
            ->orderBy('publish_time', 'desc')->paginate($pageSize);

        $page = $data->render();
        $title = $tagInfo->name;

        return Response::render('index.index', compact('data', 'page', 'title', 'tagInfo'));
    }
}
