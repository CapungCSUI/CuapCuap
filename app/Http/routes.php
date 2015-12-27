<?php

use SSO\SSO;

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

Route::get('/logout', 'UserController@logout');
Route::get('/login', 'UserController@login');
Route::get('/', 'HomeController@index');

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

Route::group(['middleware' => 'web'], function () {

	Route::get('/home', 'HomeController@index');
	
	Route::get('/users/{id}/{filename}', 'UserController@getResource');
    
    Route::get('/profile/edit', 'UserController@edit');
    Route::post('/profile/edit', 'UserController@update');
    Route::get('/profile/{id?}', 'UserController@show');
    Route::get('/profiles', 'UserController@index');
    
    Route::get('/threads/{category?}', 'ThreadController@index');
    Route::get('/thread/new', 'ThreadController@create');
    Route::post('/thread/new', 'ThreadController@store');
    Route::get('/thread/{id}/edit', 'ThreadController@edit');
    Route::post('/thread/{id}/edit', 'ThreadController@update');
    Route::get('/thread/{id}/delete', 'ThreadController@destroy');
    Route::get('/thread/{id}', 'ThreadController@show');

    Route::get('/thread/{thread_id}/{parent_id}/reply', 'ReplyController@create');
    Route::post('/thread/{thread_id}/{parent_id}/reply', 'ReplyController@store');
    Route::get('/thread/{thread_id}/reply', 'ReplyController@create');
    Route::post('/thread/{thread_id}/reply', 'ReplyController@store');
    Route::get('/thread/{thread_id}/{id}', 'ReplyController@show');
    Route::get('/thread/{thread_id}/{id}/edit', 'ReplyController@edit');
    Route::post('/thread/{thread_id}/{id}/edit', 'ReplyController@update');
    Route::get('/thread/{thread_id}/{id}/delete', 'ReplyController@destroy');
    
});
