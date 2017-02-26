<?php

namespace App\Services;

use App\Models\ArticleTag;
use App\Models\Tag;
use DB;

class TagService
{
    /**
     * 获取热门标签
     * @param  int $limit
     * @return array
     */
    public function getHotTags($limit = 5){
        
        return ArticleTag::select(DB::raw('tag_id,count(tag_id) as count'))
            ->groupBy('tag_id')->orderBy('count', 'desc')->limit($limit)->get();
    }

    public function getUsedTag()
    {
        return ArticleTag::select(DB::raw('tag_id, count(tag_id) as count'))->groupBy('tag_id')->get();
    }
}