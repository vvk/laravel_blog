<?php

namespace App\Providers;

use App\Http\Models\Link;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use DB;
use Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        DB::listen(function($sql, $bindings, $time) {
//            echo '执行的sql语句为：'.$sql.'<br>';
            // echo $sql.'<br>';
            // error_log($sql."\n", 3, 'sql.log');
            // print_r($bindings);
//            echo '执行时间：'.$time.'ms<br>';
//        });


        view()->share('web_title', config('web.web_title'));
        view()->share('web_keywords', config('web.web_keywords'));
        view()->share('web_description', config('web.web_description'));
        $this->setFriendLink();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function setFriendLink($limit=50){

        $friendLink = Cache::get('friend_link');
        if(!$friendLink){
            $friendLink = Link::where('status', 1)->select('name', 'description', 'url')
                ->orderBy('link_order', 'desc')->orderBy('id', 'desc')
                ->limit($limit)->get()->toArray();
            if($friendLink){
                Cache::put('friend_link', json_encode($friendLink), config('web.friend_link_expire'));
            }
        }else{
            $friendLink = json_decode($friendLink, true);
        }

        view()->share(compact('friendLink'));
    }
}
