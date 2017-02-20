<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public $timestamps = false;
    public $table = 'links';
    protected $fillable  = ['name', 'url', 'description', 'rank', 'image', 'status', 'create_time', 'modify_time', 'delete_time'];

}
