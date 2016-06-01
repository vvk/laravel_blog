<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => ['web']], function(){
    Route::get('admin/user/login', 'Admin\UserController@login');  //后台登录页面
    Route::post('admin/user/authenticate', 'Admin\UserController@authenticate');
});

//前台路由
Route::group(['namespace'=>'Home'], function(){
    Route::get('/', 'IndexController@index');

    Route::get('category/{id}', 'CategoryController@index');


});

Route::group(['middleware' => ['web', 'auth'], 'prefix'=>'admin', 'namespace'=>'Admin'], function () {

    Route::get('/', 'IndexController@index');
    Route::get('/home', 'IndexController@home');

    //文章
    Route::get('article', 'ArticleController@index');
    Route::get('article/add', 'ArticleController@edit');
    Route::get('article/edit/{id}', 'ArticleController@edit');
    Route::post('article/store', 'ArticleController@store');
    Route::post('article/delete', 'ArticleController@delete');

    //分类
    Route::get('category', 'CategoryController@index');  //分类列表
    Route::get('category/add', 'CategoryController@edit');
    Route::get('category/edit/{id}', 'CategoryController@edit');
    Route::post('category/store', 'CategoryController@store');
    Route::post('category/delete', 'CategoryController@delete');

    //标签
    Route::get('tag', 'TagController@index');
    Route::get('tag/add', 'TagController@edit');
    Route::get('tag/edit/{id}', 'TagController@edit');
    Route::post('tag/store', 'TagController@store');
    Route::post('tag/delete', 'TagController@delete');

    //友情链接
    Route::get('link', 'LinkController@index');
    Route::get('link/add', 'LinkController@edit');
    Route::get('link/edit/{id}', 'LinkController@edit');
    Route::post('link/store', 'LinkController@store');
    Route::post('link/delete', 'LinkController@delete');

    //配置路由
    Route::get('option/index/{id}', 'OptionController@index');
    Route::get('option/index/{id}', 'OptionController@index');
    Route::get('option/edit/{id}', 'OptionController@edit');
    Route::post('option/store', 'OptionController@store');
    Route::post('option/delete', 'OptionController@delete');

    Route::get('option/option', 'OptionController@option');
    Route::get('option/addOption', 'OptionController@editOption');
    Route::get('option/editOption/{id}', 'OptionController@editOption');
    Route::post('option/storeOption', 'OptionController@storeOption');
    Route::post('option/deleteOption', 'OptionController@deleteOption');

    //退出
    Route::get('user/logout', 'UserController@logout');

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

//图片上传
Route::post('/upload/linkImg', 'Common\UploadController@linkImg');
Route::post('/upload/thumb', 'Common\UploadController@thumb');

