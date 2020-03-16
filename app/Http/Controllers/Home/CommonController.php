<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Option as OptionService;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    protected $options;

    public function __construct() {
        Response::macro('render',function($path, $data=array()){
            $theme = Config('web.theme');
            $tpl = $theme.'.'.$path;
            return Response::view($tpl,$data);
        });

        $this->options = OptionService::getOptionData();
        View::share('options', $this->options);
    }

}
