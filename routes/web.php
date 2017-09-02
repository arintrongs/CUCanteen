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

Route::group(['domain' => '{ratemycanteen}.ojudge.in.th'], function() {
	Route::group(['namespace'=>'Canteen'], function () {
		Route::get('/', 'CanteenController@index');

		// Route::get('/adduser', 'UserController@addAdmin');
		Route::post('/user', 'UserController@authenticate');
	    Route::post('/canteen/scopeDist', 'CanteenController@scopeDist');
	    Route::resource('/canteen', 'CanteenController');
	  
	    Route::resource('/backdoor', 'BackdoorController');
	});
});
