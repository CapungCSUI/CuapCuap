<?php

use SSO\SSO;
use \GuzzleHttp\Mimetypes;

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
    Route::get('/profile', 'UserController@show');
    Route::get('/profile/{id}', 'UserController@show');
    Route::get('/profiles', 'UserController@index');
    Route::get('/thread/{id}', 'ThreadController@show');

});
