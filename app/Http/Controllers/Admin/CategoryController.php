<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends CommonController
{
    /**
     * 分类列表
     */
    public function index(Category $category){
        $breadcrumb = array('分类管理', '分类列表');

        $categoryTree = $category->getCategoryTree();

        $categoryTree = $category->setCategoryTree($categoryTree);

        return view('admin.category.index', compact('breadcrumb','categoryTree'));
    }

    /**
     * 修改或添加分类
     * @param int $id
     */
    public function edit(Category $category, $id=0){
        $data = array();
        if($id){
            $data = Category::whereIn('status', array(0,1))->find($id)->toArray();
            if(!$data){
                //@todo 错误提示
                die('分类不存在');
            }
        }else{
            $data['parent_id'] = 0;
        }

        $categoryTree = $category->getCategoryTree();
        $categoryOptions = $category->setCategoryOptions($categoryTree, $data['parent_id']);

        $breadcrumb = array('分类管理');
        if($id==0){
            $breadcrumb[] = '添加分类';
        }else{
            $breadcrumb[] = '修改分类';
        }

        return view('admin.category.edit_category', compact('breadcrumb', 'data', 'id', 'categoryOptions'));
    }

    /**
     * 保存分类
     */
    public function store(Request $request, Category $category){
        $input = $request->all();
        $data['parent_id'] = isset($input['parent_id']) ? intval($input['parent_id']) : 0;
        $data['name'] = isset($input['name']) ? trim($input['name']) : '';
        $data['keywords'] = isset($input['keywords']) ? trim($input['keywords']) : '';
        $data['description'] = isset($input['description']) ? trim($input['description']) : '';
        $data['status'] = isset($input['status']) ? intval($input['status']) : 1;
        $id = isset($input['id']) ? intval($input['id']) : 1;

        if(!$data['name']){
            return $this->_return('1', '分类名称不能为空');
        }

        if($id!=0){
            //检查分类是否存在
            if(!$category->find($id)){
                return $this->_return('1', '要修改的分类不存在');
            }

            //查检修改的分类选择的上级分类是否为当前分类的子分类
            if($data['parent_id']!=0){
                $res = $category->checkSubCategory($id, $data['parent_id']);
                if($res){
                    return $this->_return('1', '上级分类不能为当前分类的子分类');
                }
            }
        }

        if(!in_array($data['status'], array(0,1))){
            $data['status'] = 1;
        }

        if($id==0){
            $data['create_time'] = time();
            $res = $category::create($data);
        }else{
            $data['modify_time'] = time();
            $res = $category::where('id', $id)->update($data);
        }


        if($res){
            return $this->_return('0', 'success');
        }else{
            return $this->_return('1', '保存失败');
        }
    }

    /**
     * 删除分类
     */
    public function delete(Request $request){
        $id = $request->input('id', 0);

        $category = Category::whereIn('status', array(0,1))
                    ->where('id', $id)->first();

        if(!$category){
            return $this->_return('1', '要删除的分类不存在');
        }

        //检查该文类下面是否有子分类
        if(Category::where('parent_id', $id)->first()){
            return $this->_return('1', '该分类下面有子分类，请先删除子分类!');
        }

        //判断当前分类下面是否有子分类
        if($category->article){
            return $this->_return('1', '该分类下面有文章，请先删除文章!');
        }

        $data['status'] = 2;
        $data['delete_time'] = time();

        $res = Category::where('id', $id)->update($data);
        if($res){
            return $this->_return('0', 'success');
        }else{
            return $this->_return('1', '删除失败，请稍后重试');
        }
    }
}
