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
	Route::group(['before' => 'admin'], function () {
		Route::resource('user', 'UserController', ['only' => ['index', 'destroy']]);
	});

	Route::post('/item/poradi/', array(
		'uses' => 'ItemController@changePosition',
		'as' => 'changePosition',
	));
	Route::get("/test/pdf", function() {
		$view = View::make('offer.document');
		$view = mb_convert_encoding($view, 'HTML-ENTITIES', 'UTF-8');
		$pdf = App::make('dompdf');
		$pdf->loadHTML($view);
		return $pdf->download('temp.pdf');//PDF::load($view, 'A4', 'portrait')->download('my_pdf');
	});
	Route::get("/test/doc", function() {

		return Response::view('offer.show');
	});
	Route::group(['prefix' => 'api','before' => 'ajax'], function()
	{
		Route::resource('category', 'CategoryController', ['only' => ['index', 'create', 'show', 'edit']]);
		Route::resource('contact', 'ContactController', ['only' => ['show']]);
		Route::get('setting/user/{id?}', array('as' => 'get.setting.user','uses' => 'SettingController@getUserSetting'));

	});

	Route::group(['before' => 'csrf'], function () {
		Route::resource('item', 'ItemController', ['only' => ['store', 'update', 'destroy']]);
		Route::resource('contact', 'ContactController', ['only' => ['store', 'update', 'destroy']]);
		Route::resource('document', 'OfferController', ['only' => ['store', 'update', 'destroy']]);
		Route::resource('category', 'CategoryController', ['only' => ['store', 'destroy']]);
		Route::post('setting/user', array('as' => 'post.setting.user','uses' => 'SettingController@postUserSetting'));
		Route::resource('select', 'DocumentItemController', ['only' => ['store', 'update', 'destroy']]);
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

Route::get('/logout', ['uses' => "SessionController@destroy", 'as' => "session.destroy"]);
