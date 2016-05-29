<?php

namespace App\Http\Controllers\Admin;


use App\Http\Models\Link;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class LinkController extends CommonController
{

    public function index(Link $link){
        $data = $link::whereIn('status', array(0, 1))->orderBY('link_order','desc')
            ->orderBY('modify_time','desc')->orderBY('create_time','desc')->paginate(20);

        $breadcrumb = array('友情链接管理', '友情链接列表');

        return view('admin.link.index', compact('data', 'breadcrumb'));
    }

    public function edit(Link $link, $id=0){
        $breadcrumb = array('友情链接管理');
        $data = array();
        if ($id) {
            $data = $link::whereIn('status', array(0, 1))->find($id);
            if (!$data) {
                //@todo 不存在
                die('标签不存在');
            }
            $breadcrumb[] = '修改友情链接';
        } else {
            $breadcrumb[] = '添加友情链接';
        }

        return view('admin.link.edit_link', compact('id', 'data', 'breadcrumb'));
    }

    public function store(Request $request){
        $rules = array(
            'name'=>'required',
            'url'=>'required|url',
            'link_order'=>'numeric|between:0,255'
        );
        $msg = array(
            'name.required'=>'链接名称不能为空',
            'url.required'=>'链接不能为空',
            'url.url'=>'链接格式不合法',
            'link_order.numeric'=>'排序必须为整数',
            'link_order.between'=>'排序为0-255之间的整数',
        );

        $validator = Validator::make($request->all(), $rules, $msg);

        if ($validator->fails()) {
            return $this->_return('1','error', $validator->errors());
        }

        $data['name'] = $request->input('name');
        $data['url'] = $request->input('url');
        $data['status'] = $request->input('status');
        $data['target'] = $request->input('target');
        $data['image'] = $request->input('image');
        $data['link_order'] = $request->input('link_order');
        $data['description'] = $request->input('description');
        $id = $request->input('id');

        if($id==0){
            $data['create_time'] = time();
            $res = Link::create($data);
        }else{
            $data['modify_time'] = time();
            $res = Link::where('id', $id)->update($data);
        }

        if($res){
            return $this->_return('0', 'success');
        }else{
            return $this->_return('1', '保存失败，请稍后重试！');
        }
    }

    /**
     * 删除链接
     */
    public function delete(Request $request) {
        $id = $request->input('id', 0);

        $link = Link::whereIn('status', array(0, 1))
            ->where('id', $id)->first();

        if (!$link) {
            return $this->_return('1', '要删除的链接不存在');
        }

        $data['status'] = 2;

        $res = Link::where('id', $id)->update($data);
        if ($res) {
            return $this->_return('0', 'success');
        } else {
            return $this->_return('1', '删除失败，请稍后重试');


        }
    }
}
