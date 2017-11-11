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

Route::group(['domain' => 'ratemycanteen.ojudge.in.th'], function() {

	Route::group(['namespace'=>'Canteen'], function () {

		Route::get('/', 'CanteenController@index');
		Route::get('verify/{id}/{token}', 'UserController@verify');
		Route::get('/reCaptcha', 'ReCaptchaController@index');

		Route::get('/signout', 'UserController@logOut');
		Route::post('/user', 'UserController@index');
	    Route::post('/canteen/scopeDist', 'CanteenController@scopeDist');

	    Route::resource('/canteen', 'CanteenController');
	    Route::resource('/backdoor', 'BackdoorController');

		Route::post('upload', ['as' => 'upload-post', 'uses' =>'ImageController@postUpload']);
		Route::post('upload/delete', ['as' => 'upload-remove', 'uses' =>'ImageController@deleteUpload']);
	});
});
