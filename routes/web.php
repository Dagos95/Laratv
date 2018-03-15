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

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/search', 'SearchController@user')->name('search.index');
    
    Route::get('/search-serie', 'SearchController@serie')->name('search.serie');
    
    
    Route::get('/follow/user/{id}', 'UserController@follow');
    
    Route::get('/unfollow/user/{id}', 'UserController@unfollow');
    
    
    Route::get('/follow/serie/{id}', 'UserController@followSerie'); 
    
    Route::get('/unfollow/serie/{id}', 'UserController@unfollowSerie');
    
    
    Route::get('/profilo', 'UserController@profilo');
    
    Route::get('/profilo/edit', 'UserController@edit');
    
    Route::put('/profilo/edit', 'UserController@editUpdate')->name('profile.update');
    
    
});
