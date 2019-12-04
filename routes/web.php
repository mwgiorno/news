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

Auth::routes();

Route::resource('news', 'NewsController');
Route::get('my-news', 'NewsController@myNews')->name('my-news');
Route::post('upload', 'ImageController@upload')->name('upload');
