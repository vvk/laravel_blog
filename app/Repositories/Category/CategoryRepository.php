<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Repository;

class CategoryRepository extends Repository
{

    /**
     * @param int $parentId
     * @param int $selectId
     * @return string
     */
    public function getCategoryTree($parentId = 0, $selectId = 0){
        $category = $this->getSubCategoryTree($parentId);

        $category = $this->setCategoryOptions($category, $selectId);
        return $category;
    }

    /**
     * 获取分类树
     * @param int $parentId
     * @return mixed
     * @return array
     */
    public function getSubCategoryTree($parendId = 0)
    {
        $category = Category::where('parent_id', $parendId)->where('status', 1)->get()->toArray();

        foreach($category as $k=>$item){
            $category[$k]['node'] = $this->getSubCategoryTree($item['id']);
        }

        return $category;
    }

    /**
     * @param $data
     * @param int $id 选中的id
     * @param string $option
     * @param int $level
     * @return string
     */
    public function setCategoryOptions($data, $id = 0, $option = '', $level = 0)
    {
        $level++;
        foreach ($data as $item) {
            $option .= '<option value="'.$item['id'].'"';
            if($item['id'] == $id){
                $option .= ' selected ';
            }
            $option .= '>┣'.str_repeat('┣', ($level-1)).$item['name'].'</option>';
            if($item['node'] && !empty($item['node'])){
                $option = $this->setCategoryOptions($item['node'], $id, $option, $level);
            }
        }
        return $option;
    }

    /**
     * 生成分类列表面html
     * @param $data  分类
     * @param string $html 返回的html数据
     * @param int $level 层级
     * @return string
     */
    public function setCategoryTree($data, $html = '', $level = 0){
        $level++ ;
        foreach($data as $k=>$v){
            $html .= '<tr>';
            $html .= '<td>'.str_repeat('┣━', ($level-1)*1).$v['name'].'</td>';
            $html .= '<td>'.date('Y-m-d H:i:s', $v['create_time']).'</td>';
            $html .= '<td>'.($v['modify_time'] ? date('Y-m-d H:i:s', $v['modify_time']) : '').'</td>';
            $html .= '<td>';
            $html .= '<a href="'.url('admin/category/'.$v['id'].'/edit/').'" class="fa fa-edit btn btn-primary btn-sm">&nbsp;修改</a>&nbsp;';
            $html .= '<button class="fa fa-trash btn btn-danger btn-sm delete-item" value="'.$v['id'].'">&nbsp;删除</button>';
            $html .= '</td>';

            $html .= '</tr>';

            if($v['node'] && !empty($v['node'])){
                $html = $this->setCategoryTree($v['node'], $html, $level);
            }
        }
        return $html;
    }

    public function store($request)
    {
        $data['name'] = $request->input('name');
        $data['keywords'] = $request->input('keywords');
        $data['description'] = $request->input('description');
        $data['parent_id'] = $request->input('parent_id');
        $data['thumb'] = $request->input('thumb');
        $id = $request->input('id');

        if (!$data['name']) {
            return ajaxResponse(1, trans('error.name_not_empty'));
        }

        //检测分类是否存在
        $existWhere = array('name'=>$data['name'], 'status'=>1);
        if ($id != 0) {
            $existWhere[] = array('id', '!=', $id);
        }
        $existCategory = Category::where($existWhere)->first();
        if ($existCategory) {
            return ajaxResponse(1, trans('error.exist_category'));
        }

        if ($id == 0) {
            $data['create_time'] = time();
            $result = Category::create($data);
        } else {
            if ($data['parent_id'] != 0) {
                if ($this->checkParentCategory($data['parent_id'], $id)) {
                    return ajaxResponse(1, trans('error.parent_cat_not_sub_cat'));
                }
            }

            $data['modify_time'] = time();
            $result =  Category::where('id', $id)->update($data);
        }

        if ($result) {
            return ajaxResponse(0, 'success');
        } else {
            return ajaxResponse(1, trans('error.save_fail'));
        }
    }

    /**
     * 判断 $pid 是否为 $id 分类的上级分类
     * @param $id
     * @param $pid
     * @return bool
     */
    protected function checkParentCategory($id, $pid)
    {
        do {
            $category = Category::where(array('id'=>$id, 'status'=>1))->first();
            if ($category && $category->parent_id == $pid) {
                return true;
            }

            $id = $category->parent_id;
        } while($id != 0);

        return false;
    }

    public function destroy($request)
    {
        $id = $request->input('id');
        if (!$request->isMethod('delete')) {
            return ajaxResponse('500', trans('error.system_error'));
        }

        $subCategory = Category::where('parent_id', $id)->where('status', 1)->first();
        if ($subCategory) {
            return ajaxResponse(1, trans('error.exist_sub_cat_cat_not_delete'));
        }

        $result = Category::where('id', $id)->update(array('status'=>2));
        if ($result) {
            return ajaxResponse(0, 'success');
        } else {
            return ajaxResponse(1, trans('error.delete_fail'));
        }
    }
}