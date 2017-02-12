<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index.index');
    }

    public function home()
    {
        return view('admin.index.home');
    }
}
