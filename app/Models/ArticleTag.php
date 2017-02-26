<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    public $timestamps = false;
    protected $table = 'article_tag';
    protected $fillable = array('article_id', 'tag_id');

    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }

}
