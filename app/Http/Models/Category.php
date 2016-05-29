<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

    protected $fillable = array('name', 'parent_id', 'keywords', 'description', 'status', 'create_time', 'thumb');

    public $timestamps = false;
    protected $table = 'category';

    public function article(){
        return $this->hasMany('App\Http\Models\Article', 'category_id', 'id');
    }

    /**
     * 获取分类树
     * @param int $parentId
     * @return mixed
     */
    public function getCategoryTree($parentId = 0){
        $category = $this->where('parent_id', $parentId)->whereIn('status', array(0,1))->get()->toArray();

        foreach($category as $k=>$item){
            $category[$k]['node'] = $this->getCategoryTree($item['id']);
        }

        return $category;
    }

    /**
     * 生成分类列表面html
     * @param $data  分类
     * @param string $html 返回的html数据
     * @param int $level 层级
     * @return string
     */
    public function setCategoryTree($data, $html='', $level=0){
        $level++ ;
        foreach($data as $k=>$v){
            $html .= '<tr>';
            $html .= '<td>├'.str_repeat('--', ($level-1)*2).$v['name'].'</td>';
            if($v['status']==1){
                $html .= '<td>启用</td>';
            }else{
                $html .= '<td><span style="color:#f00">暂停</span></td>';
            }

            $html .= '<td>'.date('Y-m-d H:i:s', $v['create_time']).'</td>';
            $html .= '<td>'.($v['modify_time'] ? date('Y-m-d H:i:s', $v['modify_time']) : '').'</td>';

            $html .= '<td>';
            $html .= '<a href="'.url('admin/category/edit/'.$v['id']).'" class="fa fa-edit btn btn-primary btn-sm">&nbsp;修改</a>&nbsp;';
            $html .= '<button class="fa fa-trash btn btn-danger btn-sm delete-item" value="'.$v['id'].'">&nbsp;删除</button>';
            $html .= '</td>';

            $html .= '</tr>';

            if($v['node'] && !empty($v['node'])){
                $html = $this->setCategoryTree($v['node'], $html, $level);
            }
        }
        return $html;
    }

    /**
     * @param $data
     * @param int $id 选中的id
     * @param string $option
     * @param int $level
     * @return string
     */
    public function setCategoryOptions($data, $id=0, $option='', $level=0){
        $level++;
        foreach ($data as $item) {
            $option .= '<option value="'.$item['id'].'"';
            if($item['id']==$id){
                $option .= ' selected ';
            }
            $option .= '>├'.str_repeat('--', ($level-1)).$item['name'].'</option>';
            if($item['node'] && !empty($item['node'])){
                $option = $this->setCategoryOptions($item['node'], $id, $option, $level);
            }
        }
        return $option;
    }

    /**
     * 判断节点 $id 是否有 已结点 $subId
     * @param $id
     * @param $subId
     * @return bool
     */
    public function checkSubCategory($id, $subId) {
        $subCategory = $this->getCategoryTree($id);

        $data = array();
        $this->conversionArr($subCategory, $data);

        foreach ($data as $item) {
            if($item['id'] == $subId){
                return true;
            }
        }
        return false;
    }

    /**
     * 将多维数组转成二维数组
     * @param $data
     * @param $result
     */
    public function conversionArr($data, &$result){
        foreach($data as $k=>$v){
            $node = $v['node'];
            unset($v['node']);
            $result[] = $v;
            if($node && !empty($node)){
                $this->conversionArr($node, $result);
            }
        }
    }



}
