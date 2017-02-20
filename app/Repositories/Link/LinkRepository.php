<?php

namespace App\Repositories\Link;

use App\Models\Link;
use App\Repositories\Repository;

class LinkRepository extends Repository
{

    public function store($request)
    {
        $data = $request->all();
        $id = $data['id'];
        unset($data['id'], $data['_token']);

        //检测链接是否存在
        $where[] = array('url', $data['url']);
        if ($id != 0) {
            $where[] = array('id', '!=', $id);
        }
        $link = Link::where($where)->whereIn('status', array(1, 2))->first();
        if ($link) {
            return ajaxResponse(1, trans('error.link_url_exist'));
        }

        if ($data['status'] != 1) {
            $data['status'] = 2;
        }

        if ($id == 0) {
            $data['create_time'] = time();
            $result = Link::create($data);
        } else {
            $data['modify_time'] = time();
            $result = Link::where('id', $id)->update($data);
        }

        if ($result) {
            return ajaxResponse();
        } else {
            return ajaxResponse(1, trans('error.save_fail'));
        }
    }

    public function destroy($request)
    {
        $id = $request->input('id');
        $link = Link::where('id', $id)->whereIn('status', array(1, 2))->first();
        if (!$link) {
            return ajaxResponse(1, trans('error.delete_link_not_exist'));
        }

        $save = array('status'=>3, 'delete_time'=>time());
        $result = Link::where('id', $id)->update($save);
        if ($result) {
            return ajaxResponse();
        } else {
            return ajaxResponse(1, trans('error.delete_fail'));
        }
    }
}