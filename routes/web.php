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
Route::resource('category', 'CategoryController', ['except' => ['update', 'edit']]);
// Route::get('categories', 'CategoryController@index');
// Route::get('categories/new', 'CategoryController@store');
Route::get('blogers', function(){
	return view('blogers');
});
Route::resource('post', 'PostController');
Route::get('tag/{id}', 'TagController@show');
Route::get('user/{id}', 'UserController@showUserProfile');

Auth::routes();

Route::get('logout', 'Auth\LogoutController@logout');
Route::get('profile', 'UserController@show');
Route::get('profile/edit', ['as' => 'profile.edit', 'uses' => 'UserController@edit']);
Route::put('profile', 'UserController@update');
// Route::post('/session', 'CategoryController@createSession');