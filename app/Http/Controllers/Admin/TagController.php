<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TagRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Repositories\Tag\TagRepository;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Tag::where('status', 1)->orderBy('id', 'desc')->paginate(20);

        $breadcrumb = array('文章管理', '标签管理');
        return view('admin.tag.index', compact('data', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = 0;
        $data = array();
        $breadcrumb = array('文章管理', '标签管理', '添加标签');
        return view('admin.tag.edit', compact('data', 'id', 'breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request, TagRepository $tag)
    {
        return $tag->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Tag::where('id', $id)->first();
        if (!$data) {
            return adminError(trans('error.tag_not_exist'));
        }

        $breadcrumb = array('文章管理', '标签管理', '修改标签');
        return view('admin.tag.edit', compact('data', 'breadcrumb', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TagRepository $tag)
    {
        return $tag->destroy($request);
    }
}
