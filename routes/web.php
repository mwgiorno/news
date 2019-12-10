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

Route::get('news', 'NewsController@index')->name('news.index');
Route::get('news/search', 'NewsController@search')->name('news.search');
Route::get('news/tag/{tag?}', 'NewsController@index')->name('news.tag');
Route::resource('news', 'NewsController')->except(['index']);
Route::get('my-news', 'NewsController@myNews')->name('my-news');

Route::post('news/{news}/leave-comment', 'CommentController@leaveComment')->name('leave-comment');
Route::post('news/{comment}/reply', 'CommentController@reply')->name('reply');;
Route::post('comments/update', 'CommentController@update')->name('update');;

Route::post('upload', 'ImageController@upload')->name('upload');
