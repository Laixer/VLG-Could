<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('auth', 'AuthController@redirectToProvider');
	Route::get('auth/callback', 'AuthController@handleProviderCallback');
	Route::get('unauth', 'AuthController@unauth');
});

Route::group(['middleware' => ['web', 'auth']], function () {
	Route::get('/', 'HomeController@getCommonMain');
	Route::get('common/header', 'HomeController@getCommonHeader');
	Route::get('common/footer', 'HomeController@getCommonFooter');
	Route::get('dashboard', 'HomeController@getDashboard');
	Route::get('project_details', 'HomeController@getProjectDetails');
	Route::get('new_project_window', 'HomeController@getNewProjectWindow');
	Route::get('attach_todo_window', 'HomeController@getAttachTodoWindow');
    Route::get('principal', 'HomeController@about');
});

Route::group(['middleware' => ['web', 'auth'],'prefix' => 'api/v1'], function () {
	Route::get('auth/check', 'ApiController@getAuthStatus');
    Route::get('projects', 'ApiController@getProjects');
    Route::get('project_fields', 'ApiController@getProjectFields');
    Route::get('project_companies', 'ApiController@getProjectCompanies');
    Route::get('project/{id}', 'ApiController@getProjectFromId');
    Route::get('project/{id}/reports', 'ApiController@getProjectReports');
    Route::get('project/{id}/thread', 'ApiController@getProjectThread');
    Route::get('project/{id}/todo', 'ApiController@getProjectTodo');
    Route::get('project/{id}/audit', 'ApiController@getProjectAudit');
    Route::get('project/{id}/todo_available', 'ApiController@getProjectTodoAvailable');
    Route::get('report/{id}/download', 'ApiController@getDownloadRaport');
    Route::post('upload', 'ApiController@doNewFile');
    Route::post('new_message', 'ApiController@doNewMessage');
    Route::post('new_todo', 'ApiController@doNewTodo');
    Route::post('update_report', 'ApiController@doUpdateReport');
});

Route::group(['middleware' => ['web', 'auth.edit'],'prefix' => 'api/v1'], function () {
    Route::post('new_project', 'ApiController@doNewProject');
    Route::post('update_status', 'ApiController@doUpdateStatus');
    Route::post('update_note', 'ApiController@doUpdateNote');
    Route::post('update_todo', 'ApiController@doUpdateTodo');
});
