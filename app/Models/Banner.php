<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps = false;
    protected $table = 'banner';
    protected $fillable = array('name', 'remark', 'url', 'target', 'image', 'rank', 'status');

}
