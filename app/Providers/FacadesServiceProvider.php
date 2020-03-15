<?php

namespace App\Providers;

use App\Repositories\Option\OptionRepository;
use App\Services\ArticleService;
use App\Services\BannerService;
use App\Services\OptionService;
use App\Services\Tag;
use App\Services\TagService;
use Illuminate\Support\ServiceProvider;

class FacadesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param OptionRepository $repository
     * @return void
     */
    public function boot(OptionRepository $repository)
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

        $this->app->singleton('option',function() use ($repository){
            return new OptionService($repository);
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
