<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class CommonController extends Controller
{
    public function __construct() {
        Response::macro('render',function($path, $data=array()){
            $theme = Config('web.theme');
            $tpl = $theme.'.'.$path;
            return Response::view($tpl,$data);
        });

    }
}
