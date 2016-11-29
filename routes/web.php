<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web', 'auth']], function () {
	Route::get('/', 'HomeController@getCommonMain');
	Route::get('common/header', 'HomeController@getCommonHeader');
	Route::get('common/footer', 'HomeController@getCommonFooter');
	Route::get('dashboard', 'HomeController@getDashboard');
	Route::get('project_details', 'HomeController@getProjectDetails');
	Route::get('new_project_window', 'HomeController@getNewProjectWindow');
	Route::get('attach_todo_window', 'HomeController@getAttachTodoWindow');
	Route::get('options_window', 'HomeController@getOptionsWindow');
	Route::get('principal', 'HomeController@about');
});
