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
	Route::put('a/configuration/categories',[ 'uses'=>'Admin\Configuration\CategoriesController@update']);
	Route::delete('a/configuration/categories',[ 'uses'=>'Admin\Configuration\CategoriesController@destroy']);
	Route::get('a/configuration/categories/getCategoriesDropdown',[ 'uses'=>'Admin\Configuration\CategoriesController@getCategoriesDropdown']);

	#Section Configuration/Chapters
	Route::get('a/configuration/chapters',[ 'uses'=>'Admin\Configuration\ChaptersController@index']);
	Route::get('a/configuration/chapters/getAllChapters',[ 'uses'=>'Admin\Configuration\ChaptersController@getAllChapters']);
	Route::get('a/configuration/chapters/getChaptersDropdownForCategory/{category}',[ 'uses'=>'Admin\Configuration\ChaptersController@getChaptersDropdownForCategory']);
	Route::post('a/configuration/chapters',[ 'uses'=>'Admin\Configuration\ChaptersController@create']);
	Route::put('a/configuration/chapters',[ 'uses'=>'Admin\Configuration\ChaptersController@update']);
	Route::delete('a/configuration/chapters',[ 'uses'=>'Admin\Configuration\ChaptersController@destroy']);
	

	#Section Configuration/QuestionBank
	Route::get('a/configuration/questionbank',[ 'uses'=>'Admin\Configuration\QuestionBankController@index']);
	Route::get('a/configuration/questionbank/getAllQuestions',[ 'uses'=>'Admin\Configuration\QuestionBankController@getAllQuestions']);
	Route::get('a/configuration/questionbank/getQuestionById',[ 'uses'=>'Admin\Configuration\QuestionBankController@getQuestionById']);
	Route::post('a/configuration/questionbank',[ 'uses'=>'Admin\Configuration\QuestionBankController@create']);
	Route::put('a/configuration/questionbank',[ 'uses'=>'Admin\Configuration\QuestionBankController@update']);	
	Route::get('a/configuration/questionbank/mcq',[ 'uses'=>'Admin\Configuration\QuestionBankController@mcq']);
	Route::delete('a/configuration/questionbank',[ 'uses'=>'Admin\Configuration\QuestionBankController@destroy']);		

	
});

Route::group(['middleware'=>['auth','auth.user']],function(){
	Route::get('u', function(){
		return 'user logged in';
	});
});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
