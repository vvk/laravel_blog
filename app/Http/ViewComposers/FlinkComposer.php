<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\Link;

class FlinkComposer
{
    public function compose(View $view)
    {
        $friendLink = Link::where('status', 1)->orderBy('rank', 'desc')->limit(20)->get();
        $view->with('friendLink', $friendLink);
    }
}