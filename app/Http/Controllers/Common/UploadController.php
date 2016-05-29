<?php

/**
 * 文件上传
 */

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    /**
     * 上传友情链接图片
     */
    public function linkImg(Request $request){
        return $this->upload('link', $request);
    }

    public function articleImg(Request $request){
        return $this->upload('article', $request);
    }
    /**
     * 上传文件
     * @param $type 上传类型 link 友情链接图片
     */
    private function upload($type, $request){

        if (!$request->hasFile('file')) {
            return json_encode(array('status'=>1, 'msg'=>'未获取到上传文件'));
        }

        if(!$request->file('file')->isValid()){
            return json_encode(array('status'=>1, 'msg'=>'上传过程出出现错误，请稍后重试'));
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
            $url = $destinationPath.$filename;
            return json_encode(array('status'=>0, 'msg'=>'success', 'data'=>array('url'=>$url)));
        }else{
            return json_encode(array('status'=>1, 'msg'=>'上传失败，请稍后重试'));
        }
    }

}
