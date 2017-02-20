<?php

namespace App\Http\Controllers\Admin;

use App\Models\Link;
use App\Repositories\Link\LinkRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LinkRequest;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Link::whereIn('status', array(1, 2))->orderBy('rank','desc')->orderBy('id', 'desc')->paginate();

        $breadcrumb = array('系统设置', '友情链接');
        return view('admin.link.index', compact('data', 'breadcrumb'));
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

        $breadcrumb = array('系统设置', '友情链接', '添加友情链接');
        return view('admin.link.edit', compact('breadcrumb', 'id', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request, LinkRepository $link)
    {
        return $link->store($request);
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
        $data = Link::where('id', $id)->whereIn('status', array(1, 2))->first();
        if (!$data) {
            return adminError(trans('error.modify_link_not_exist'));
        }

        $breadcrumb = array('系统设置', '友情链接', '修改友情链接');
        return view('admin.link.edit', compact('breadcrumb', 'id', 'data'));
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
    public function destroy(Request $request, LinkRepository $link)
    {
        return $link->destroy($request);
    }
}
