<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = array('article_id', 'content');
    protected $table = 'content';
    public $timestamps = false;

    public function article(){
        return $this->belongsTo('App\Http\Models\Article');
    }

}
