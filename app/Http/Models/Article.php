<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $timestamps = false;
    protected $table = 'article';
    protected $fillable = array('name', 'keywords', 'description', 'category_id', 'thumb', 'status', 'create_time',
        'modify_time', 'publish_time', 'delete_time', 'view_count', 'is_reprint', 'reprint_url', 'content','recommend');

    public function tags(){
        return $this->hasMany('App\Http\Models\ArticleTag');
    }

    public function category() {
        return $this->belongsTo('App\Http\Models\category', 'category_id', 'id');
    }




}
