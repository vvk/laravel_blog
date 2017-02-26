<?php

namespace App\Repositories\Banner;

use App\Models\Banner;
use App\Repositories\Repository;

class BannerRepository extends Repository
{
    public function store($request)
    {
        $data = $request->all();

        if ($data['status'] != 1) {
            $data['status'] = 2;
        }
        $id = $data['id'];
        unset($data['id'], $data['_token']);

        if ($id == 0) {
            $result = Banner::create($data);
        } else {
            $banner = Banner::where('id', $id)->whereIn('status', array(1, 2))->first();
            if (!$banner) {
                return ajaxResponse(1, trans('error.modify_banner_not_exist'));
            }
            $result = Banner::where('id', $id)->update($data);
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
        $banner = Banner::where('id', $id)->whereIn('status', array(1, 2))->first();
        if (!$banner) {
            return ajaxResponse(1, trans('error.banner_delete_not_exist'));
        }

        $result = Banner::where('id', $id)->update(array('status'=>3));
        if ($result) {
            return ajaxResponse(0, 'success');
        } else {
            return ajaxResponse(1, trans('error.delete_fail'));
        }
    }
}