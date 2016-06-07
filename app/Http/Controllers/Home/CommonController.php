<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Http\Models\Article;
class CommonController extends Controller
{
    public function __construct() {
        Response::macro('render',function($path, $data=array()){
            $theme = Config('web.theme');
            $tpl = $theme.'.'.$path;
            return Response::view($tpl,$data);
        });

    }

    /**
     * 热门文章
     * @param integer $limit 文章数量
     * @return array
     */
    public function getHotArticle($limit=5) {
        $data = Article::where('status', 2)->select('id','name','category_id','thumb','publish_time')
            ->orderBy('view_count', 'desc')->orderBy('publish_time', 'desc')->limit($limit)->get();
        return $data;
    }

    /**
     * 获取推荐文章
     * @param  integer  $limit 文章数量
     */
    public function getRecommendArticle($limit=5){
        $data = Article::where('status', 2)->where('recommend', 1)
            ->select('id','name','category_id','thumb','publish_time')
            ->orderBy('view_count', 'desc')->orderBy('publish_time', 'desc')->limit($limit)->get();
        return $data;
    }
}
