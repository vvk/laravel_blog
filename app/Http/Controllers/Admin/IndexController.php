<?php

namespace App\Http\Controllers\Admin;
use App\Http\Models\Article;
use App\Http\Models\Category;
use App\Http\Models\Link;
use App\Http\Models\Tag;
use Auth;
use Illuminate\Support\Facades\Request;

class IndexController extends CommonController
{

    /**
     * 后台首页
     */
    public function index(){
        return view('admin.index.index');
    }

    public function home(){
        $breadcrumb = array('基本信息');
        $arcitleCount = Article::whereIn('status', array(0, 1, 2))->count();
        $tagCount = Tag::whereIn('status', array(0, 1))->count();
        $categoryCount = Category::whereIn('status', array(0, 1))->count();
        $linkCount = Link::whereIn('status', array(0, 1))->count();

        $draftArticle = Article::where('status', '0')->count();  //草稿文章
        $unpublishArtcile = Article::where('status', '1')->count();  //未发布文章
        $publishArtcile = Article::where('status', '2')->count();  //已发布文章

        return view('admin.index.home', compact('breadcrumb','arcitleCount','tagCount','categoryCount','linkCount','draftArticle','unpublishArtcile','publishArtcile'));
    }



}
