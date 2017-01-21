<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*Route::group(['middleware' => ['web', 'auth'], 'prefix'=>'admin', 'namespace'=>'Admin'], function (){
    Route::get('/', 'IndexController@index');
});
Auth::routes();

Route::get('/home', 'HomeController@index');*/

Route::group(['middleware' => ['web'], 'prefix'=>'admin', 'namespace'=>'Admin'], function (){
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
});

Route::group(['middleware' => ['web', 'admin.auth'], 'prefix'=>'admin', 'namespace'=>'Admin'], function (){
    Route::get('/', 'IndexController@index');

});


Auth::routes();

Route::get('/home', 'HomeController@index');
