<?php

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

Route::group(['middleware' => 'admin'], function () {
    Route::get('/category/new', 'CategoryController@create');
    Route::post('/category/new', 'CategoryController@store');
    Route::get('/category/{id}/edit', 'CategoryController@edit');
    Route::post('/category/{id}/edit', 'CategoryController@update');
    Route::get('/category/{id}/delete', 'CategoryController@destroy');

    Route::get('/announcement/new', 'AnnouncementController@create');
    Route::post('/announcement/new', 'AnnouncementController@store');
    Route::get('/announcement/{id}/edit', 'AnnouncementController@edit');
    Route::post('/announcement/{id}/edit', 'AnnouncementController@update');
    Route::get('/announcement/{id}/delete', 'AnnouncementController@destroy');
    Route::get('/announcements', 'AnnouncementController@index');
});

Route::group(['middleware' => 'user'], function () {
    Route::get('/aboutus', function() {
        return view('aboutus');
    });
    Route::get('/contact', function() {
        return view('contact');
    });
    Route::post('/contact', function() {
        return abort(503);
    });
    Route::get('/rules', function() {
        return view('rules');
    });
    Route::get('/guide/how-to-make-a-post', function() {
        return view('guide.how-to-make-a-post');
    });

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
    
    Route::get('/notifications', 'NotificationController@index');
    Route::get('/notification/{id}', 'NotificationController@show');
    Route::get('/notification/{id}/delete', 'NotificationController@destroy');

    Route::get('/messages/{receiver_id}', 'MessageController@show');
    Route::post('/messages/{receiver_id}', 'MessageController@store');

    Route::get('/categories', 'CategoryController@index');
    Route::get('/category/{id}', 'CategoryController@show');

    Route::get('/announcement/{id}', 'AnnouncementController@show');
});
