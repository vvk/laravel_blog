<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public $timestamps = false;
    protected $fillable = array('name', 'descriptioin', 'url', 'status', 'target', 'create_time', 'link_order', 'image');
}
