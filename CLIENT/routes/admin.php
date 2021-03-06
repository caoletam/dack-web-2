<?php 



// TEST API

// Route::get('/test',	'AuctionController@test')->name('getAuctioStatus');

//  CLOSE TEST API


// MAIN


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
		Route::get('/update/{id}',	'ProductController@updateStatus')->where('id','[0-9]+')->name('product_update');
		Route::post('/update/{id}',	'ProductController@updateStatus')->where('id','[0-9]+');
		
	});

	Route::group(['prefix'=>'parameter'],function(){
		Route::get('/',				'ParameterController@index')			->name('parameter');
		Route::get('/add',			'ParameterController@create')			->name('parameter_add');
		Route::post('/add',			'ParameterController@create');
		Route::get('/edit/{id}',	'ParameterController@update')->where('id','[0-9]+')->name('parameter_edit');
		Route::post('/edit/{id}',	'ParameterController@update')->where('id','[0-9]+');
		Route::get('/delete/{id}',	'ParameterController@delete')->where('id','[0-9]+')->name('parameter_delete');
		Route::post('/delete/{id}',	'ParameterController@delete')->where('id','[0-9]+');
		
	});

	Route::group(['prefix'=>'image'],function(){
		Route::get('/',				'ImageController@index')			->name('image');
		Route::get('/add',			'ImageController@create')			->name('image_add');
		Route::post('/add',			'ImageController@create');
		Route::get('/edit/{id}',	'ImageController@update')->where('id','[0-9]+')->name('image_edit');
		Route::post('/edit/{id}',	'ImageController@update')->where('id','[0-9]+');
		Route::get('/delete/{id}',	'ImageController@delete')->where('id','[0-9]+')->name('image_delete');
		Route::post('/delete/{id}',	'ImageController@delete')->where('id','[0-9]+');
		
	});

	Route::group(['prefix'=>'auction'],function(){
		Route::get('/',				'AuctionController@index')			->name('auction');
		Route::get('/add',			'AuctionController@create')			->name('auction_add');
		Route::post('/add',			'AuctionController@create');
		Route::get('/edit/{id}',	'AuctionController@update')->where('id','[0-9]+')->name('auction_edit');
		Route::post('/edit/{id}',	'AuctionController@update')->where('id','[0-9]+');
		Route::get('/delete/{id}',	'AuctionController@delete')->where('id','[0-9]+')->name('auction_delete');
		Route::post('/delete/{id}',	'AuctionController@delete')->where('id','[0-9]+');
		Route::get('/update/{id}',	'AuctionController@updateStatus')->where('id','[0-9]+')->name('auction_update');
		Route::post('/update/{id}',	'AuctionController@updateStatus')->where('id','[0-9]+');
		
	});

});







?>