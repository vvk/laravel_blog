<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $timestamps = false;
    protected $table = 'article';
    protected $fillable = array('name', 'keywords', 'description', 'thumb', 'status', 'create_time',
        'modify_time', 'publish_time', 'delete_time', 'view_count', 'is_reprint', 'reprint_url', 'content','recommend', 'editor_type', 'markdown');

    public function category()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function tagId()
    {
        return $this->hasMany('App\Models\ArticleTag');
    }
}
