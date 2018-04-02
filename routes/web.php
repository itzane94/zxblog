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
Route::group(['prefix'=>'admin','namespace'=>'User'],function(){
    Route::get('/login','UserController@login')->name('admin_login');
    Route::post('/login','UserController@login');
});
Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
    Route::get('/home','Dashboard\DashboardController@index');
    Route::get('/home/welcome','Dashboard\DashboardController@welcome');
    Route::get('/logout','User\UserController@logout');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
