<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Article;
use Illuminate\Support\Facades\Response;

class IndexController extends CommonController {
    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $data = Article::where('status', 2)->select('id','name','category_id','thumb','publish_time')
            ->orderBy('publish_time', 'desc')->paginate(10);


        return Response::render('index.index', compact('data'));
    }
}