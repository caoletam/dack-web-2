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


Route::get('/', 'UserIndexController@index')->name('index');

Route::group(['prefix'=>'category'],function(){
	Route::get('/{id}',				'UserProductController@index')->where('id','[0-9]+')			->name('category');
});

Route::group(['prefix'=>'detail'],function(){
	Route::get('/{id}',				'UserDetailController@index')->where('id','[0-9]+')			->name('detail');
});
