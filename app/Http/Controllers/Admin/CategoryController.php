<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryRepository $category)
    {
        $categoryTree = $category->getSubCategoryTree();
        $categoryTree = $category->setCategoryTree($categoryTree);

        $breadcrumb = array('文章管理', '分类管理');

        return view('admin.category.index', compact('categoryTree', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryRepository $category)
    {
        $category = $category->getCategoryTree();
        $id = 0;
        $data = array();

        $breadcrumb = array('文章管理', '分类管理', '添加分类');

        return view('admin.category.edit', compact('category', 'id', 'data', 'breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CategoryRepository $category)
    {
        return $category->store($request);
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
    public function edit(CategoryRepository $category, $id)
    {
        $where = array('id'=>$id, 'status'=>1);
        $data = Category::where($where)->first();
        if (!$data) {
            return adminError(trans('error.category_not_exist'));
        }

        $category = $category->getCategoryTree(0, $data->parent_id);

        $breadcrumb = array('文章管理', '分类管理', '修改分类');
        return view('admin.category.edit', compact('data', 'category', 'id', 'breadcrumb'));
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
    public function destroy(Request $request, CategoryRepository $category)
    {
        return $category->destroy($request);
    }
}
