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
	Route::get('auth/check', 'ApiController@getAuthStatus');
	Route::get('projects', 'ApiController@getProjects');
	Route::get('projects_all', 'ApiController@getProjectsAll');
	Route::get('project_fields', 'ApiController@getProjectFields');
	Route::get('project_companies', 'ApiController@getProjectCompanies');
	Route::get('project_company/{id}/users', 'ApiController@getProjectCompanyUsers');
	Route::get('project/{id}', 'ApiController@getProjectFromId');
	Route::get('project/{id}/reports', 'ApiController@getProjectReports');
	Route::get('project/{id}/thread', 'ApiController@getProjectThread');
	Route::get('project/{id}/todo', 'ApiController@getProjectTodo');
	Route::get('project/{id}/audit', 'ApiController@getProjectAudit');
	Route::get('project/{id}/todo_available', 'ApiController@getProjectTodoAvailable');
	Route::get('report/{id}/download', 'ApiController@getDownloadRaport');
	Route::post('project_close', 'ApiController@doProjectClose');
	Route::post('project_confirm', 'ApiController@doProjectConfirm');
	Route::post('upload', 'ApiController@doNewFile');
	Route::post('new_message', 'ApiController@doNewMessage');
	Route::post('new_todo', 'ApiController@doNewTodo');
	Route::post('update_report', 'ApiController@doUpdateReport');
});

Route::group(['middleware' => ['web', 'auth.edit']], function () {
	Route::post('new_project', 'ApiController@doNewProject');
	Route::post('update_status', 'ApiController@doUpdateStatus');
	Route::post('update_note', 'ApiController@doUpdateNote');
	Route::post('update_todo', 'ApiController@doUpdateTodo');
	Route::post('update_options', 'ApiController@doUpdateOptions');
});
