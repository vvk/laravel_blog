<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $timestamps = false;
    protected $table = 'article';

    public function category()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
