<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index/index', 'Index\UserController@getUserInfo'); // 显示登录
Route::post('/index/login', 'Index\UserController@login'); // 登录ajax
Route::post('/index/logout', 'Index\UserController@logout'); // 退出登录
// 医院端路由分组
Route::group(['middleware'=>['web','hospital'],'prefix' => 'index','namespace' => 'Index'], function(){
	Route::post('/edit', 'UserController@hospitalEdit');
    Route::get('/detail', 'UserController@userDetail'); // 医院详情
    // Route::get('/login', 'LoginController@login');
    // Route::get('/loginOut', 'LoginController@loginOut');
    // Route::get('/reg', 'LoginController@reg');
    // Route::get('/index', 'IndexController@index');
    // Route::get('/add', 'IndexController@add');
    // Route::get('/upd', 'IndexController@upd');

});
// Route::group(['middleware'=>['api'],'prefix' => 'index','namespace' => 'Index'], function(){
//     Route::post('/logout', 'UserController@logout'); // 退出登录
// });
