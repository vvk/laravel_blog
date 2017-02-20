<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Repositories\Banner\BannerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Banner $banner)
    {

        $status = $request->input('status', 0);
        $where = array();
        if ($status) {
            $where['status'] = $status;
        }
        $data = Banner::where($where)->whereIn('status', array(1, 2))->orderBy('rank', 'desc')->orderBy('id', 'desc')->paginate();

        $breadcrumb = array('系统管理', '轮播图');
        return view('admin.banner.index', compact('data', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $id = 0;
        $breadcrumb = array('系统设置', '轮播图', '添加轮播图');

        return view('admin.banner.edit', compact('data', 'id', 'breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request, BannerRepository $banner)
    {
        return $banner->store($request);
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
        $data = Banner::where('id', $id)->whereIn('status', array(1, 2))->first();
        if (!$data) {
            return adminError(trans('error.modify_banner_not_exist'));
        }

        $breadcrumb = array('系统设置', '轮播图', '修改轮播图');

        return view('admin.banner.edit', compact('data', 'id', 'breadcrumb'));
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
    public function destroy(Request $request, BannerRepository $banner)
    {
        return $banner->destroy($request);
    }
}
