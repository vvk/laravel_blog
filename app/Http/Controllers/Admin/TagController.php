<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Tag;
use Illuminate\Http\Request;

class TagController extends CommonController {

    /**
     * 标签列表
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Tag $tag) {
        $data = $tag::whereIn('status', array(0, 1))->paginate(20);

        $breadcrumb = array('标签管理', '标签列表');

        return view('admin.tag.index', compact('data', 'breadcrumb'));
    }

    public function edit($id = 0) {
        $breadcrumb = array('分类管理');
        $data = array();
        if ($id) {
            $data = Tag::whereIn('status', array(0, 1))->find($id);
            if (!$data) {
                //@todo 不存在
                die('标签不存在');
            }
            $breadcrumb[] = '修改分类';
        } else {
            $breadcrumb[] = '添加分类';
        }

        return view('admin.tag.edit_tag', compact('id', 'data', 'breadcrumb'));
    }

    public function store(Request $request) {
        $id = $request->input('id', 0);
        $name = $request->input('name', '');
        $status = $request->input('status', '');

        if (!$name) {
            return $this->_return('1', '标签名称不能为空');
        }

        if (!in_array($status, array(0, 1))) {
            $status = 1;
        }

        $data['name'] = $name;
        $data['status'] = $status;

        if ($id == 0) {
            $res = Tag::create($data);
        } else {
            $res = Tag::where('id', $id)->update($data);
        }

        if ($res) {
            return $this->_return('0', 'success');
        } else {
            return $this->_return('1', '保存失败');
        }
    }

    /**
     * 删除标签
     */
    public function delete(Request $request) {
        $id = $request->input('id', 0);

        $tag = Tag::whereIn('status', array(0, 1))
            ->where('id', $id)->first();

        if (!$tag) {
            return $this->_return('1', '要删除的标签不存在');
        }

        $data['status'] = 2;

        $res = Tag::where('id', $id)->update($data);
        if ($res) {
            return $this->_return('0', 'success');
        } else {
            return $this->_return('1', '删除失败，请稍后重试');


        }
    }
}