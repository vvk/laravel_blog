<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{

    public function _return($status=0, $msg='', $data=array()){
        $response['status'] = $status;
        $response['msg'] = $msg;
        $response['data'] = $data;
        return response()->json($response);
    }
}
