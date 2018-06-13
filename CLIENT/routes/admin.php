<?php 



Route::group(['prefix'=>'admin'],function(){
	Route::get('/login',			'AdminController@login')->name('login');
	Route::post('/login',			'AdminController@login')->name('login');
	Route::get('/logout',			'AdminController@logout')->name('logout');
	Route::post('/logout',			'AdminController@logout')->name('logout');

	Route::get('/',					'DashboardController@index')->name('dashboard');
	Route::get('/dashboard',		'DashboardController@index')->name('dashboard');

	Route::group(['prefix'=>'user'],function(){
		Route::get('/',				'UserController@index')			->name('user');
		Route::get('/add',			'UserController@create')		->name('user-add');
		Route::post('/add',			'UserController@create');
		
	});

	Route::group(['prefix'=>'product'],function(){
		Route::get('/',				'ProductController@index')			->name('product');
		Route::get('/add',			'ProductController@create')			->name('product-add');
		Route::post('/add',			'ProductController@create');
		Route::get('/edit/{id}',	'ProductController@update')->where('id','[0-9]+')->name('product_edit');
		Route::post('/edit/{id}',	'ProductController@update')->where('id','[0-9]+');
		Route::get('/delete/{id}',	'ProductController@delete')->where('id','[0-9]+')->name('product_delete');
		Route::post('/delete/{id}',	'ProductController@delete')->where('id','[0-9]+');
		
	});

});







?>