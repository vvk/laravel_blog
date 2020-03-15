<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $theme = config('web.theme');
        $view = array($theme.'.index.index', $theme.'.article.article');
        $view[] = $theme.'.figure-bed.index';

        view()->composer($view, 'App\Http\ViewComposers\FlinkComposer');
        view()->composer($view, 'App\Http\ViewComposers\ArticleComposer');
        view()->composer($view, 'App\Http\ViewComposers\TagComposer');
        //view()->composer($view, 'App\Http\ViewComposers\OptionComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
