<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Article as ArticeService;

class ArticleComposer
{
    public function compose(View $view)
    {
        //热门文章
        $hotArticle = ArticeService::getHotArticle();

        //推荐文章
        $recommendArticle = ArticeService::getRecommendArticle();

        $view->with('hotArticle', $hotArticle);
        $view->with('recommendArticle', $recommendArticle);
    }

}