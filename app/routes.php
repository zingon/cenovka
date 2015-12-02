<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(['before' => 'auth'], function () {

	Route::get('/', function () {
		return Redirect::route('document.index');
	});
	Route::resource('item', 'ItemController', ['except' => ['store', 'update', 'destory', 'show']]);
	Route::resource('contact', 'ContactController', ['except' => ['store', 'update', 'destory']]);
	Route::resource('document', 'OfferController', ['except' => ['store', 'update', 'destory']]);
	Route::resource('select', 'DocumentItemController', ['only' => ['create', 'edit']]);
	Route::group(['before' => 'admin'], function () {
		Route::resource('user', 'UserController', ['only' => ['index', 'destroy']]);
	});
	Route::get('/document/{id}/reload', array(
		'uses' => 'OfferController@reload',
		'as' => 'reload'
	));
	Route::get('/items/serad', function () {
		$i = 1;
		$categories = Category::all();
		foreach ($categories as $category) {
			$i = 1;
			foreach ($category->items()->orderBy('poradi')->get() as $item) {
				$item->poradi = $i;
				if ($item->save()) {
					$i++;
				}
				else {
					break;
				}
			}
		}
		$i = 1;
		$items = Item::where('category_id', '=', 0)->orderBy('poradi')->get();
		foreach ($items as $item) {
			$item->poradi = $i;
			if ($item->save()) {
				$i++;
			}
			else {
				break;
			}
		}
	});
	Route::post('/item/poradi/', array(
		'uses' => 'ItemController@changePosition',
		'as' => 'changePosition',
	));
	Route::get('/ajax/token', array(
		'uses' => 'DocumentItemController@getToken',
		'as' => 'token'
	));

	Route::get('/export/pdf/{id}', array(
		'uses' => 'OfferController@exportPdf',
		'as' => 'export'
	));

	Route::group(['before' => 'ajax'], function () {
		Route::resource('category', 'CategoryController', ['only' => ['index', 'create', 'show', 'edit']]);
		Route::resource('contact', 'ContactController', ['only' => ['show']]);
	});

	Route::group(['before' => 'csrf'], function () {
		Route::resource('item', 'ItemController', ['only' => ['store', 'update', 'destroy']]);
		Route::resource('contact', 'ContactController', ['only' => ['store', 'update', 'destroy']]);
		Route::resource('document', 'OfferController', ['only' => ['store', 'update', 'destroy']]);
		Route::resource('select', 'DocumentItemController', ['only' => ['store', 'update', 'destroy']]);
		Route::resource('category', 'CategoryController', ['only' => ['store', 'destroy']]);
	});
});

Route::resource('login', 'SessionController', ['only' => ['create', 'store']]);
Route::get('/login', function () {
	return Redirect::route('login.create');
});
Route::resource('user', 'UserController', ['only' => ['create', 'store']]);

Route::get('/register', function () {
	return Redirect::route('user.create');
});
