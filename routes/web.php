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
// resource operacie pre category model
Route::resource('category', 'CategoryController', ['only' => ['store', 'show', 'destroy']]);
// resource operacie pre user model
Route::resource('post', 'PostController', ['except' => ['show']]);
Route::get('post/{id}/{slug}', ['as' => 'post.show', 'uses' => 'PostController@show']);

// zoradenie clankov:
// podla najnovsieho
Route::get('newest-posts', 'PostController@getNewest');
// podla najviac zobrazeneho
Route::get('most-viewed', 'PostController@getMostViewed');

// vylistovanie vsetkych clankov s danym tagom
Route::get('tag/{id}', 'TagController@show');

Auth::routes();
Route::get('logout', 'Auth\LogoutController@logout');

// zoradenie blogerov podla daneho kriteria
Route::post('sort-blogers', 'UserController@sortBlogers');
// vylistovanie vsetkych blogerov
Route::get('blogers', 'UserController@index');
// ukaz profil uzivatela s id-com 'id'
Route::get('user/{id}', 'UserController@showUserProfile');
// ukaz profil prihlaseneho uzivatela
Route::get('profile', 'UserController@show');
// vsetky posty prihlaseneho uzivatela
Route::get('profile/my-posts', 'UserController@myPosts');
// formular pre upravu profilu
Route::get('profile/edit', ['as' => 'profile.edit', 'uses' => 'UserController@edit']);
// uprava profilu prihlaseneho uzivatela
Route::put('profile', 'UserController@update');
// vymazanie profilu prihlaseneho uzivatela
Route::delete('profile', 'UserController@destroy');

// routes pre lajky
Route::post('post/like/{id}', 'LikeController@likePost');
