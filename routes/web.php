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
// 'domain' => '{canteen}.ojudge.in.th', 
Route::domain('{ratemycanteen}.ojudge.in.th')->group(function() {
	Route::namespace('Canteen')->group(function () {
		// Route::get('/adduser', 'UserController@addAdmin');
		Route::post('/user', 'UserController@authenticate');
	    Route::post('/scopeDist', 'CanteenController@scopeDist');
	    Route::resource('/', 'CanteenController');
	  
	    Route::resource('/backdoor', 'BackdoorController');
	});
});
