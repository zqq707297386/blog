<?php
Route::group(['middleware' => ['web']], function () {
    
    Route::get('/','Home\IndexController@index');
    Route::get('/cate/{cate_id}','Home\IndexController@cate');
    Route::get('/art/{art_id}','Home\IndexController@art');

    //路由访问控制器。控制器去访问view
    Route::any('admin/login','Admin\LoginController@login');//any就表示任何方式传过来都能接收到
    Route::any('admin/code','Admin\LoginController@code');
//  Route::get('admin/crypt','Admin\LoginController@crypt');
//  Route::get('admin/getcode','Admin\LoginController@getcode');
    Route::get('admin/element','Admin\ElementController@element');
});

//添加使用中间件'admin.login'，还要在Kernel.php里加东西.添加分组，命名空间
Route::group(['middleware' => ['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'], function () {
    
    Route::any('index','IndexController@index');
    Route::any('info','IndexController@info');
    Route::any('pass','IndexController@pass');
    Route::any('quit','LoginController@quit');

    Route::post('category/changeOrder','CategoryController@changeOrder');
    Route::resource('category', 'CategoryController');  //资源路由帮助创建方法，用php artisan route:list 可查看创建了什么方法

    Route::resource('article', 'ArticleController');

    Route::post('link/changeOrder','LinkController@changeOrder');
    Route::resource('link', 'LinkController');

    Route::post('nav/changeOrder','NavController@changeOrder');
    Route::resource('nav', 'NavController');

    Route::get('conf/createConfigFile','ConfController@createConfigFile');

    Route::post('conf/changeContent','ConfController@changeContent');
    Route::post('conf/changeOrder','ConfController@changeOrder');
    Route::resource('conf', 'ConfController');

    Route::any('uploadify','CommonController@uploadify');


});

