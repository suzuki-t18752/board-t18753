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
Route::group(['middleware' => 'auth'], function() {
    // 投稿機能
    Route::get('/', 'ArticleController@index')->name('article.index');
    Route::get('/article/create', 'ArticleController@showCreateForm')->name('article.create');
    Route::post('/article/create', 'ArticleController@create');
    Route::get('/article/show/{article_id}', 'ArticleController@show')->name('article.show');
    Route::get('/article/edit/{article_id}', 'ArticleController@articleEditForm')->name('article.edit');
    Route::post('/article/edit/{article_id}', 'ArticleController@edit');
    Route::get('/article/delete/{article_id}', 'ArticleController@delete');
    // コメント機能
    Route::post('/article/show/{article_id}', 'ArticleController@commentCreate');
    Route::get('/article/comment_edit/{comment_id}', 'ArticleController@commentEditForm')->name('article.comment_edit');
    Route::post('/article/comment_edit/{comment_id}', 'ArticleController@commentEdit');
    Route::get('/article/show/{article_id}/{comment_id}', 'ArticleController@commentDelete');
    // コメントの返信機能
    Route::get('/article/return_comment/{comment_id}', 'ArticleController@returnComment')->name('article.return_comment');
    Route::post('/article/return_comment/{comment_id}', 'ArticleController@returnCreate');
    Route::get('/article/return_edit/{comment_id}', 'ArticleController@returnEditForm')->name('article.return_edit');
    Route::post('/article/return_edit/{comment_id}', 'ArticleController@returnEdit');
    Route::get('/article/return_comment/{comment_id}/delete/{return_id}', 'ArticleController@returnDelete');
    // ユーザー機能
    Route::get('/user/index/{user_id}', 'UserController@index')->name('user.index');
    Route::get('/user/edit/{user_id}', 'UserController@userEditForm')->name('user.edit');
    Route::post('/user/edit/{user_id}', 'UserController@edit');

    Route::get('/user/index/{user_id}/export', 'UserController@articleExport');
});