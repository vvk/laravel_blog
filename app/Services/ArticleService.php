<?php

namespace App\Services;

use App\Models\Article;
use App\Models\ArticleTag;
use Auth;

class ArticleService
{
    /**
     * 热门文章
     * @param integer $limit 文章数量
     * @return array
     */
    public function getHotArticle($limit = 5)
    {
        return Article::where('status', 2)->select('id','name','thumb','publish_time')
            ->orderBy('view_count', 'desc')->orderBy('publish_time', 'desc')->limit($limit)->get();
    }

    /**
     * 获取推荐文章
     * @param  integer  $limit 文章数量
     */
    public function getRecommendArticle($limit = 5)
    {
        $data = Article::where('status', 2)->where('recommend', 1)
            ->select('id','name','thumb','publish_time')
            ->orderBy('view_count', 'desc')->orderBy('publish_time', 'desc')->limit($limit)->get();
        return $data;
    }

    public function relevanceArticle($id)
    {
        $query = Article::where('id', $id);
        if (Auth::user()) {
            $query->whereIn('status', array(1, 2));
        } else {
            $query->where('status', 2);
        }
        $article = $query->first();
        if (!$article) {
            return array();
        }

        $tagid = ArticleTag::where('article_id', $id)->get();



    }


}