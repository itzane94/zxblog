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
    Route::get('/type','Article\ArticleController@typeTree');
    Route::get('/type/add','Article\ArticleController@type_add');
    Route::get('/type/edit/{type}','Article\ArticleController@type_edit')->where('type','[0-9]+');
    Route::get('/type/delete/{type}','Article\ArticleController@type_delete')->where('type','[0-9]+');
    Route::get('/tag','Article\ArticleController@tag');
    Route::get('/tag/json','Article\ArticleController@tag_json');
    Route::get('/tag/add','Article\ArticleController@tag_add');
    Route::get('/tag/edit/{tag}','Article\ArticleController@tag_edit')->where('tag','[0-9]+');
    Route::get('/tag/delete/{tag}','Article\ArticleController@tag_delete')->where('tag','[0-9]+');
    Route::get('/comment/list','Article\ArticleController@comment');
    Route::get('/comment/comment_list','Article\ArticleController@comment_list');
    Route::post('/comment/delete','Article\ArticleController@comment_delete');
    Route::get('/setting/tips','Setting\TipsController@index');
    Route::get('/setting/tips/json','Setting\TipsController@tip_json');
    Route::post('/setting/tips/add','Setting\TipsController@tip_add');
    Route::post('/setting/tips/save/{tips}','Setting\TipsController@tip_save');
    Route::get('/setting/tips/delete/{tips}','Setting\TipsController@tip_delete');

});
Route::get('/','Home\HomepageController@index');
Route::get('/blog','Article\ArticleController@blog');
Route::get('/archive','Article\ArticleController@archive');
Route::get('/archive/json','Article\ArticleController@archive_json');
Route::get('/about','User\UserController@about');
Route::get('/echo','User\UserController@echo_square');
Auth::routes();
Route::get('/blog/{article}','Article\ArticleController@detail')->where('article','[0-9]+');
Route::get('/blog/list','Article\ArticleController@search_list');
Route::post('/comment/add','Article\ArticleController@comment_add');
Route::get('/comment/json/{article}','Article\ArticleController@comment_json')->where('article','[0-9]+');
Route::get('/home', 'HomeController@index')->name('home');
