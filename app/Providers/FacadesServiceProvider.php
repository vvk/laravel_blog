<?php

namespace App\Providers;

use App\Services\ArticleService;
use App\Services\BannerService;
use App\Services\Tag;
use App\Services\TagService;
use Illuminate\Support\ServiceProvider;

class FacadesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('banner',function(){
            return new BannerService();
        });

        $this->app->singleton('article',function(){
            return new ArticleService();
        });

        $this->app->singleton('tag',function(){
            return new TagService();
        });

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
