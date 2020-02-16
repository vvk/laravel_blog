<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Home\FigureBedRequest;
use App\Repositories\FigureBed\FigureBedRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;

class FigureBedController extends CommonController
{
    protected $maxFileSize = 5; // M
    protected $maxUploadCountUser = 15;
    protected $maxUploadCountDay = 150;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return Response::render('figure-bed.index');
    }

    public function upload(FigureBedRequest $request, FigureBedRepository $figureBed)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return ajaxResponse(1, trans('error.figure_bed_valid'));
        }

        $file = $request->file('file');
        $mime = $file->getMimeType();
        if (strpos($mime, 'image/') !== 0) {
            return ajaxResponse(1, trans('error.upload_file_invalid_image_mime'));
        }

        $size = $file->getClientSize();
        $size = round($size / 1024 / 1024, 4);
        if ($size > $this->maxFileSize) {
            return ajaxResponse(1, trans('error.upload_file_too_big').'，文件不能超过 '.$this->maxFileSize.' M');
        }

        if (Auth::guest()) {
            $count = $figureBed->getImageCount(date('Y-m-d'), $request->ip());
            if ($count >= $this->maxUploadCountUser) {
                $msg = '您今天已上传'.$count.'张，由于资源有限，今天不能再上传图片，如果需要上传更多图片，请联系管理员';
                if (config('web.mail')) {
                    $mail = config('web.mail');
                    $msg .= ' <a href="mailto:'.$mail.'">'.$mail.'</a>';
                }
                return ajaxResponse(403, $msg);
            }

            $totalCount = $figureBed->getImageCount(date('Y-m-d'));
            if ($totalCount >= $this->maxUploadCountDay) {
                $msg = '今天已上传'.$this->maxUploadCountDay.'张，由于资源有限，今天不能再上传图片，如果需要上传更多图片，请联系管理员';
                if (config('web.mail')) {
                    $mail = config('web.mail');
                    $msg .= ' <a href="mailto:'.$mail.'">'.$mail.'</a>';
                }
                return ajaxResponse(403, $msg);
            }
        }

        $directory = 'image/'.date('Y/m/d');
        Storage::disk('upyun')->makeDirectory($directory);

        $res = Storage::disk('upyun')->putFile($directory, new File($file));
        if ($res === false || empty($res)) {
            return ajaxResponse(1, trans('error.figure_bed_upload_fail'));
        }

        $url = getUpyunCdnUrl($res);
        $figureBed->store($res, $request->ip());
        return ajaxResponse(0, 'success', ['url' => $url]);
    }
}
