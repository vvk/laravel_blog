<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    public $table = 'category';
    protected $fillable  = ['name', 'keywords', 'description', 'parent_id', 'thumb', 'create_time', 'update_time', 'delete_time'];

    public function article()
    {
        return $this->belongsToMany('App\Models\Article');
    }

}
