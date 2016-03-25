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
	Route::resource('export', 'ExportDocumentController', ['only' => ['show']]);

	Route::get("/export/document/{document_id}/{pdf?}", array(
		'uses' => "ExportDocumentController@export",
		'as' => "export.offer"
		));
	Route::get("/export/json/{id}.json", array(
			'uses' 	=> "ExportDocumentController@exportJson",
			"as"	=> "export.offer.json"
		));
	Route::post('/item/poradi/', array(
		'uses' => 'ItemController@changePosition',
		'as' => 'changePosition',
	));
	Route::group(['prefix' => 'api','before' => 'ajax'], function()
	{
		Route::resource('category', 'CategoryController', ['only' => ['index', 'create', 'show', 'edit']]);
		Route::resource('contact', 'ContactController', ['only' => ['show']]);
		Route::get('setting/user/{id?}', array('as' => 'get.setting.user','uses' => 'SettingController@getUserSetting'));
		Route::get('documents', array('as'=>"api.get.documents","uses"=>"OfferController@getOffers"));
		Route::get('items', array('as'=>"api.get.items","uses"=>"ItemController@getItems"));
		Route::get('contacts', array('as'=>"api.get.contacts","uses"=>"ContactController@getContacts"));
		Route::resource("user", "UserController", ['only' => ['edit']]);
		Route::resource('export', 'ExportDocumentController', ['only' => ['index']]);

	});

	Route::group(['before' => 'csrf'], function () {
		Route::resource('item', 'ItemController', ['only' => ['store', 'update', 'destroy']]);
		Route::resource('contact', 'ContactController', ['only' => ['store', 'update', 'destroy']]);
		Route::resource('document', 'OfferController', ['only' => ['store', 'update', 'destroy']]);
		Route::resource('category', 'CategoryController', ['only' => ['store','update', 'destroy']]);
		Route::post('setting/user', array('as' => 'post.setting.user','uses' => 'SettingController@postUserSetting'));
		Route::resource('select', 'DocumentItemController', ['only' => ['store', 'update', 'destroy']]);
		Route::resource('user', 'UserController', ['only' => ['update']]);
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

Route::group(['prefix'=>'admin','before' => 'admin'], function () {
		Route::resource('user', 'UserController', ['only' => ['index']]);
	});
Route::get('/logout', ['uses' => "SessionController@destroy", 'as' => "session.destroy"]);
