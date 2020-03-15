<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Banner;
use Tag;

class IndexController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $query = Article::where('status', 2)->select('id','name','thumb','publish_time','description', 'content', 'view_count');

        $s = $request->input('s');
        if($s){
            $query->where(function($query){
                $s = strip_tags(trim($_GET['s']));
                if($s){
                    $query->where('name', 'like', "%{$s}%")
                        ->orWhere('content', 'like', "%{$s}%");
                }
            });
        }

        $pageSize = $this->options->get('page_size');
        $data = $query->orderBy('publish_time', 'desc')->paginate($pageSize);

        if($s){
            $page = $data->appends(array('s' => $s))->render();
        }else{
            $page = $data->render();
        }

        //轮播图
        $banner = Banner::getBanner();

        $title = $s;

        return Response::render('index.index', compact('data', 'title', 'page', 's', 'banner'));
    }
}
