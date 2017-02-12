<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function thumb(Request $request)
    {
        return $this->upload('article', $request);
    }

    /**
     * @param $type  图片类型
     * @param $request
     * @return string
     */
    public function upload($type, $request)
    {
        if (!$request->hasFile('file')) {
            return ajaxResponse(1, trans('upload_file.un_get_upload_file'));
        }

        if(!$request->file('file')->isValid()){
            return ajaxResponse(1, trans('upload_file.uploading_file_error'));
        }

        switch ($type){
            case 'link':
                $path = config('web.link_image_path');
                break;
            case 'article':
                $path = config('web.thumb_image_path');
                break;
        }

        $file = $request->file('file');

        $extension = $request->file('file')->getClientOriginalExtension();

        $filename = md5(date('YmdHis').$type.rand(10000,99999)).'.'.$extension;
        $destinationPath = $path.date('Ymd').'/';

        if(!is_dir($destinationPath)){
            mkdir($destinationPath);
        }

        $res = $file->move($destinationPath, $filename);
        if($res){
            $url = url('/').'/'.$destinationPath.$filename;
            return json_encode(array('status'=>0, 'msg'=>'success', 'data'=>array('url'=>$url)));
        }else{
            return json_encode(array('status'=>1, 'msg'=>trans('upload_file.upload_file_fail')));
        }
    }
}
