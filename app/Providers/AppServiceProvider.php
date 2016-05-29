<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

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
}
