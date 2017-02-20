<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Tag;
use App\Models\Category;

class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index.index');
    }

    public function home()
    {
/*        $breadcrumb = array('基本信息');
        $arcitleCount = Article::whereIn('status', array(0, 1, 2))->count();
        $tagCount = Tag::whereIn('status', array(0, 1))->count();
        $categoryCount = Category::whereIn('status', array(0, 1))->count();
        $linkCount = Link::whereIn('status', array(0, 1))->count();

        $draftArticle = Article::where('status', '0')->count();  //草稿文章
        $unpublishArtcile = Article::where('status', '1')->count();  //未发布文章
        $publishArtcile = Article::where('status', '2')->count();  //已发布文章*/

//        return view('admin.index.home', compact('breadcrumb','arcitleCount','tagCount','categoryCount','linkCount','draftArticle','unpublishArtcile','publishArtcile'));
        return view('admin.index.home');
    }
}
