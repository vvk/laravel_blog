<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\ArticleTag;
use Article as ArticleService;
use Illuminate\Support\Facades\Response;
use Tag;
use Illuminate\Http\Request;
use Auth;

class ArticleController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $id)
    {
        $query = Article::where('id', $id);
        if (Auth::user()) {
            $query->whereIn('status', array(1, 2));
        } else {
            $query->where('status', 2);
        }

        $data = $query->select('id','name','thumb','publish_time','description', 'content', 'view_count', 'is_reprint', 'modify_time')->first();
        if (!$data) {
            abort(404);
        }

        //预览状态或登录时浏览数量不增加
        $type = $request->input('type');
        if ($type != 'preview' && !Auth::user()) {
            $data->view_count++;
            $data->save();
        }

        $tagId = array();
        foreach ($data->tag as $tag) {
            $tagId[] = $tag->id;
        }

        //相关文章  具有相同标签的文章  上一篇 下一篇
        $relevanceArticle = $siblingArticle = array();
        if($tagId){
            $relevanceArticleId = ArticleTag::where('article_id', '!=', $data->id)
                ->whereIn('tag_id', $tagId)->select('article_id')->get();

            $arr = array();
            if($relevanceArticleId){
                foreach($relevanceArticleId as $item){
                    $arr[] = $item->article_id;
                }
            }

            $arr = array_unique($arr);

            $relevanceArticle = Article::where('status', 2)
                ->whereIn('id', $arr)->select('id','name')->orderBy('view_count', 'desc')
                ->limit(10)->get();
        }

        $siblingArticle['preview'] = Article::where('id', '<', $id)->where('status', 2)->select('id', 'name')->orderBy('id', 'desc')->first();
        $siblingArticle['next'] = Article::where('id', '>', $id)->where('status', 2)->select('id', 'name')->first();

        $url = url()->current();

        $title = $data->name;
        $keywords = $data->keywords;
        $description = $data->description;

        $keywords .= ($keywords ? ' - ' : '').config('web.web_keywords');
        if(!$description){
            $description = str_replace(array('&nbsp;', "\r\n", "\r", "\n"), '', strip_tags($data->content));
            $description = str_limit(strip_tags($description),360);
        }

        //使用的标签
        $usedTags = Tag::getUsedTag();

        return Response::render('article.article', compact('hotArticle', 'title', 'keywords', 'description', 'data', 'url', 'relevanceArticle', 'recommendArticle', 'usedTags', 'siblingArticle'));
    }
}
