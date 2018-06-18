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
require_once('admin.php');


Route::get('/', 'UserIndexController@index')->name('user-index');

Route::get('/login', 'UserAccountController@login')->name('user-login');
Route::post('/login', 'UserAccountController@login');
Route::get('/logout', 'UserAccountController@logout')->name('user-logout');
Route::post('/logout', 'UserAccountController@logout');
Route::get('/register', 'UserAccountController@register')->name('user-register');
Route::post('/register', 'UserAccountController@register');

Route::group(['prefix'=>'category'],function(){
	Route::get('/{id}',				'UserProductController@index')->where('id','[0-9]+')			->name('category');
});

Route::group(['prefix'=>'detail'],function(){
	Route::get('/{id}',				'UserDetailController@index')->where('id','[0-9]+')			->name('detail');
	Route::post('/realtime/{id}',	'UserDetailController@getRealTime')->where('id','[0-9]+') ->name('detail-realtime');
	Route::post('/auction/{id}',	'UserDetailController@auctionProduct')->where('id','[0-9]+') ->name('auction-product');
});

Route::get('/test', 'UserDetailController@test');
