<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;
    protected $table = 'options';
    protected $fillable = array('name', 'title', 'value', 'type', 'status', 'form_type');




}
