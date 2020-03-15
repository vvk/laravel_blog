<?php


namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Option as OptionService;

class OptionComposer
{
    public function compose(View $view)
    {
        $options = OptionService::getOptionList();
        $view->with('options', $options);
    }
}