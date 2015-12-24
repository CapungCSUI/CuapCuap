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
	
	Route::get('/', function () {
	    return view('welcome');
	});

	Route::get('/users/{id}/{filename}', function ($id, $filename)
	{
		if (DB::table('users')->where('id',$id)->first() == null) {
			return response('Unauthorized', 401);
		}
	    $file = 'users/' . $id . '/' . $filename;

	    if (!Storage::has($file)) {
	    	return response('Unauthorized', 401);
	    }

		$mimeType = Storage::mimeType($file);
	    $file = Storage::get($file);

	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $mimeType);

	    return $response;
	});

    Route::get('/home', 'HomeController@index');

    Route::get('/profile/edit', 'UserController@edit');
    Route::post('/profile/edit', 'UserController@update');
    Route::get('/profile', 'UserController@show');
    Route::get('/profile/{id}', 'UserController@show');

});
