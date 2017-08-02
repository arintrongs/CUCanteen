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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('Canteen')->group(function () {
	Route::get('/canteen/recomment', 'CanteenController@recomment');
    Route::resource('/canteen', 'CanteenController');
    Route::resource('/backdoor', 'BackdoorController');
});

//Route::get('/canteen', 'CanteenController@index');

Route::domain('{canteen}.ojudge.com')->group(function () {

});
