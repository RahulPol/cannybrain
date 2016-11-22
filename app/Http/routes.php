<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Route::get('/', function(){
// 	return view('layout.master');
// });


//Route::get('home', 'HomeController@index');

Route::group(['middleware'=>['auth','auth.admin']],function(){
	Route::get('a/dashboard',[ 'uses'=>'AdminDashboardController@index']);
	Route::get('a/testsetup/categories',[ 'uses'=>'CategoriesController@index']);
	Route::get('a/testsetup/chapters',[ 'uses'=>'ChaptersController@index']);
	// Route::get('a/testsetup/{configurationname}',[ 'uses'=>'TestSetupController@index']);
});

Route::group(['middleware'=>['auth']],function(){
	Route::get('u', function(){
		return 'user logged in';
	});
});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
