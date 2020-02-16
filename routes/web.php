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
    Route::get('logout', 'LoginController@logout')->name('admin.logout');
});

Route::group(['middleware' => ['web', 'admin.auth'], 'prefix'=>'admin', 'namespace'=>'Admin'], function (){
    Route::get('/', 'IndexController@index');
    Route::get('/home', 'IndexController@home');

    Route::resource('article', 'ArticleController');
    Route::resource('category', 'CategoryController');
    Route::resource('tag', 'TagController');
    Route::resource('banner', 'BannerController');
    Route::resource('link', 'LinkController');

    //ueditor编辑器
    Route::group(['prefix'=>'ueditor'], function(){
        Route::get('anchor', 'UeditorController@anchor');
        Route::get('image', 'UeditorController@image');
        Route::get('link', 'UeditorController@link');
        Route::get('spechars', 'UeditorController@spechars');
        Route::get('searchreplace', 'UeditorController@searchreplace');
        Route::get('map', 'UeditorController@map');
        Route::get('gmap', 'UeditorController@gmap');
        Route::get('video', 'UeditorController@video');
        Route::get('help', 'UeditorController@help');
        Route::get('preview', 'UeditorController@preview');
        Route::get('emotion', 'UeditorController@emotion');
        Route::get('wordimage', 'UeditorController@wordimage');
        Route::get('attachment', 'UeditorController@attachment');
        Route::get('insertframe', 'UeditorController@insertframe');
        Route::get('edittip', 'UeditorController@edittip');
        Route::get('edittable', 'UeditorController@edittable');
        Route::get('edittd', 'UeditorController@edittd');
        Route::get('webapp', 'UeditorController@webapp');
        Route::get('snapscreen', 'UeditorController@snapscreen');
        Route::get('scrawl', 'UeditorController@scrawl');
        Route::get('music', 'UeditorController@music');
        Route::get('template', 'UeditorController@template');
        Route::get('background', 'UeditorController@background');
        Route::get('charts', 'UeditorController@charts');
    });
});

Route::group(['middleware' => ['web'], 'namespace'=>'Home'], function (){

    Route::get('/', 'IndexController@index');

//    Route::get('archives', 'ArticleController@index')->where('id', '\d+')->name('articleDetail');
    Route::get('category/{id}', 'CategoryController@index')->where('id', '\d+');
    Route::get('archives/{id}', 'ArticleController@index')->where('id','\d+');
    Route::get('tag/{tag}', 'TagController@index');

    //图床
    Route::get('/figure-bed', 'FigureBedController@index');
    Route::post('/figure-bed/upload', 'FigureBedController@upload');

});


Route::group(['middleware' => ['web'], 'namespace'=>'Common'], function (){
    //图片上传
    Route::post('/upload/linkImg', 'UploadController@linkImg');
    Route::post('/upload/thumb', 'UploadController@thumb');
    Route::post('/upload/banner', 'UploadController@banner');
    Route::post('/upload/image', 'UploadController@image');
    Route::post('/upload/markdown', 'UploadController@markdown');
});




Auth::routes();

