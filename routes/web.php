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
Route::group(['prefix'=>'admin','namespace'=>'User'],function(){
    Route::get('/login','UserController@login')->name('admin_login');
    Route::post('/login','UserController@login');
});
Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
    Route::get('/home','Dashboard\DashboardController@index');
    Route::get('/home/welcome','Dashboard\DashboardController@welcome');
    Route::get('/logout','User\UserController@logout');
    Route::get('/info','User\UserController@adminInfo');
    Route::get('/article/list','Article\ArticleController@index');
    Route::get('/article/list_data','Article\ArticleController@list');
    Route::post('/article/del','Article\ArticleController@delete');
    Route::get('/article/add','Article\ArticleController@add');
    Route::post('/article/add','Article\ArticleController@add');
    Route::get('/article/edit/{article}','Article\ArticleController@edit')->where('article', '[0-9]+');
    Route::post('/article/edit/{article}','Article\ArticleController@edit')->where('article', '[0-9]+');
    Route::get('/picture/tree','Picture\PictureController@tree');
    Route::post('/picture/upload','Picture\PictureController@upload');
    Route::get('/picture/delete','Picture\PictureController@delete');
    Route::get('/picture/board','Picture\PictureController@board');
    Route::post('/edit','User\UserController@edit');
});
Route::get('/','Home\HomepageController@index');
Route::get('/blog','Article\ArticleController@blog');
Route::get('/archive','Article\ArticleController@archive');
Route::get('/about','User\UserController@about');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
