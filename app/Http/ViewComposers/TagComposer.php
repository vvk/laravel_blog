<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Tag as TagService;

class TagComposer
{
    public function compose(View $view)
    {
        //热门标签
        $hotTags = TagService::getHotTags();

        //使用的标签
        $usedTags = TagService::getUsedTag();

        $view->with('hotTags', $hotTags);
        $view->with('usedTags', $usedTags);
    }
}