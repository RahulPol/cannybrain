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
	#Section Dashboard
	Route::get('a/dashboard',[ 'uses'=>'Admin\Dashboard\DashboardController@index']);	

	#Section Configuration/Categories	
	Route::get('a/configuration/categories',[ 'uses'=>'Admin\Configuration\CategoriesController@index']);
	Route::get('a/configuration/categories/getAllCategories',[ 'uses'=>'Admin\Configuration\CategoriesController@getAllCategories']);
	Route::post('a/configuration/categories',[ 'uses'=>'Admin\Configuration\CategoriesController@create']);

	#Section Configuration/Chapters
	Route::get('a/configuration/chapters',[ 'uses'=>'Admin\Configuration\ChaptersController@index']);

	#Section Configuration/QuestionBank
	Route::get('a/configuration/questionbank',[ 'uses'=>'Admin\Configuration\QuestionBankController@index']);
	
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
