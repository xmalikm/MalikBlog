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

Route::get('/', 'PostController@index');

Route::get('categories', function(){
	return view('categories');
});

Route::get('blogers', function(){
	return view('blogers');
});

Route::resource('post', 'PostController');
Auth::routes();



Route::get('/home', 'HomeController@index');
