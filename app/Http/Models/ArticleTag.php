<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    protected $table = 'article_tag';
    public $timestamps = false;
    protected $fillable = array('article_id', 'tag_id');

    public function category() {
        return $this->belongsTo('App\Http\Models\Article');
    }


}
