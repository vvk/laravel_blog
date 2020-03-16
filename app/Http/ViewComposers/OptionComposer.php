<?php


namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Option as OptionService;

class OptionComposer
{
    public function compose(View $view)
    {
        $options = OptionService::getOptionData();
        $view->with('options', $options);
    }
}