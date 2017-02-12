<?php

namespace App\Repositories\Tag;

use App\Models\Tag;
use App\Repositories\Repository;

class TagRepository extends Repository
{

    public function store($request)
    {
        $id = $request->input('id');
        $name = $request->input('name');

        if ($id) {
            $existTag = Tag::where(array('id'=>$id, 'status'=>1))->first();
            if (!$existTag) {
                return ajaxResponse(1, trans('error.tag_not_exist'));
            }
            $where[] = array('id', '!=', $id);
        }

        $where['name'] = $name;
        $where['status'] = 1;
        $existTag = Tag::where($where)->first();
        if ($existTag) {
            return ajaxResponse(1, trans('error.tag_exist'));
        }

        if ($id) {
            $result = Tag::where('id', $id)->update(array('name'=>$name));
        } else {
            $result = Tag::create(array('name'=>$name));
        }

        if ($result) {
            return ajaxResponse(0, 'success');
        } else {
            return ajaxResponse(1, trans('error.save_fail'));
        }
    }

    public function destroy($request)
    {
        $id = $request->input('id');
        if (!$id) {
            return ajaxResponse(1, trans('error.system_error'));
        }

        $where = array('id'=>$id, 'status'=>1);

        if (!Tag::where($where)->first()) {
            return ajaxResponse(1, trans('error.delete_tag_not_exist'));
        }

        if (Tag::where('id', $id)->update(array('status'=>2))) {
            return ajaxResponse(0, 'success');
        } else {
            return ajaxResponse(1, trans('error.delete_fail'));
        }
    }

}