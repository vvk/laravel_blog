<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    protected $table = 'tag';
    protected $fillable = array('name', 'status');



    public function post() {
        return $this->belongsTo('App\Http\Models\Article');
    }


}
