<?php

namespace App\Services;

use App\Models\Banner;

class BannerService
{
    public function getBanner($count = 5)
    {
        return Banner::where('status', 1)->orderBy('rank', 'desc')->limit($count)->get();
    }
}


