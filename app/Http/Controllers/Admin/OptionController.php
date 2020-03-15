<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OptionRequest;
use App\Http\Requests\Request;
use App\Models\Option;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Option\OptionRepository;
use Egulias\EmailValidator\Parser\Parser;

class OptionController extends Controller
{
    /**
     * @param OptionRepository $repository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(OptionRepository $repository)
    {
        $option = $repository->getOptionList();
        $breadcrumb = ['系统设置', '配置'];
        $data = ['breadcrumb' => $breadcrumb, 'option' => $option];
        return view('admin.option.index', $data);
    }

    public function create()
    {
        $formTypeList = Option::FORM_TYPE_LIST;
        $breadcrumb = ['系统设置', '配置', '添加配置项'];
        $data = ['breadcrumb' => $breadcrumb, 'formTypeList' => $formTypeList, 'id' => 0];
        return view('admin.option.edit', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo __FUNCTION__;
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param OptionRepository $repository
     * @param                  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(OptionRepository $repository, $id)
    {
        $option = $repository->getOptionById($id);
        if (empty($option)) {
            return adminError(trans('error.option_modify_not_exist'));
        }

        $formTypeList = Option::FORM_TYPE_LIST;
        $breadcrumb = ['系统设置', '配置', '修改配置项'];
        $data = ['breadcrumb' => $breadcrumb, 'formTypeList' => $formTypeList, 'option' => $option, 'id' => $id];
        return view('admin.option.edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OptionRequest    $request
     * @param OptionRepository $repository
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OptionRequest $request, OptionRepository $repository)
    {
        return $repository->store($request);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy()
    {

    }

    /**
     * @param Request          $request
     * @param OptionRepository $repository
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeOption(Request $request, OptionRepository $repository)
    {
        return $repository->storeOption($request);
    }

}
