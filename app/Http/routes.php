<?php
Route::group(['middleware' => ['web']], function () {
    
    Route::get('/','Home\IndexController@index');
    Route::get('/cate/{cate_id}','Home\IndexController@cate');
    Route::get('/art/{art_id}','Home\IndexController@art');

    Route::any('admin/login','Admin\LoginController@login');
    Route::any('admin/code','Admin\LoginController@code');
//  Route::get('admin/crypt','Admin\LoginController@crypt');
    Route::get('admin/element','Admin\ElementController@element');
});

Route::group(['middleware' => ['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'], function () {
    
    Route::any('index','IndexController@index');
    Route::any('info','IndexController@info');
    Route::any('pass','IndexController@pass');
    Route::any('quit','LoginController@quit');

    Route::post('category/changeOrder','CategoryController@changeOrder');
    Route::resource('category', 'CategoryController');

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

