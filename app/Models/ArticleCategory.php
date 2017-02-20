<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    public $timestamps = false;
    protected $table = 'article_category';
    protected $fillable = array('article_id', 'category_id');

}
