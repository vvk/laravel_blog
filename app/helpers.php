<?php


if (! function_exists('includeRouteFiles')) {

    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        $directory =  $folder;
        $handle = opendir($directory);
        $directory_list = [$directory];

        while (false !== ($filename = readdir($handle))) {
            if($filename != "." && $filename != ".." && is_dir($directory.$filename))
                array_push($directory_list, $directory.$filename."/");
        }

        foreach ($directory_list as $directory) {
            foreach (glob($directory."*.php") as $filename) {
                require($filename);
            }
        }
    }
}

if (!function_exists('app_name')) {
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('ajaxResponse')) {
    function ajaxResponse($status = 0, $msg = 'success', $data = array())
    {
        return response()->json(['status'=>$status, 'msg'=>$msg, 'data'=>$data]);
    }
}

if (!function_exists('adminError')) {
    function adminError ($msg = '')
    {
        if (!$msg) {
            $msg = trans('error.system_error');
        }
        return view('admin.public.error', compact('msg'));
    }
}

if (!function_exists('isUrl')) {
    function isUrl($url)
    {
        $regex = '/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(:\d+)?(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/';
        if (preg_match($regex, $url)) {
            return true;
        } else {
            return false;
        }
    }
}
