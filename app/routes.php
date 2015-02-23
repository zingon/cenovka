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
Route::group(['before'=>'auth'],function(){

	Route::get('/', function()
	{
		return Redirect::route('document.index');
	});
	Route::resource('item', 'ItemController', ['except' => ['store', 'update', 'destory', 'show']]);
	Route::resource('contact', 'ContactController', ['except' => ['store', 'update', 'destory']]);
	Route::resource('document', 'OfferController', ['except' => ['store', 'update', 'destory']]);
	Route::resource('select', 'DocumentItemController', ['only' => ['create', 'edit']]);
	Route::get('/document/{id}/reload', array(
			'uses' => 'OfferController@reload',
			'as' => 'reload'
		));
	Route::get('/items/serad', function(){
		$i = 1; 
		foreach (Item::orderBy('created_at','ASC')->get() as $key => $value) {
			$value->poradi = $i;
			if($value->save()){
				$i++;
			} else {
				break;
			}
		}
	});
	Route::get('/items/{id}/poradi/{action}', array(
			'uses' 	=> 'ItemController@changePosition',
			'as'	=> 'changePosition',
		));
	Route::get('/ajax/token',array(
			'uses' => 'DocumentItemController@getToken',
			'as' => 'token'
		));

	Route::group(['before' => 'ajax'], function() {
		Route::resource('category', 'CategoryController', ['only' => ['index','create', 'show','edit']]);
		Route::resource('contact', 'ContactController', ['only' => ['show']]);
	});

	Route::group(['before' => 'csrf'], function() {
	    Route::resource('item', 'ItemController', ['only' => ['store', 'update', 'destroy']]);
	    Route::resource('contact', 'ContactController', ['only' => ['store', 'update', 'destroy']]);
	    Route::resource('document', 'OfferController', ['only' => ['store', 'update', 'destroy']]);
	    Route::resource('select', 'DocumentItemController', ['only' => ['store', 'update', 'destroy']]);
	    Route::resource('category', 'CategoryController', ['only' => ['store', 'destroy']]);
	});

});

Route::resource('login', 'SessionController', ['only'=>['create','store']]);
Route::get('/login',function(){
	return Redirect::route('login.create');
});

Route::get('/hash-my-password/{password}',function($password){
	return Hash::make($password);
});