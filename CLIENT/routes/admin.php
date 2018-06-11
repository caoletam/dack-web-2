<?php 



Route::group(['prefix'=>'admin'],function(){
	Route::get('/login',			'AdminController@login')->name('login');
	Route::post('/login',			'AdminController@login')->name('login');
	Route::get('/logout',			'AdminController@logout')->name('logout');
	Route::post('/logout',			'AdminController@logout')->name('logout');

	Route::get('/',					'DashboardController@index')->name('dashboard');
	Route::get('/dashboard',					'DashboardController@index')->name('dashboard');

});







?>