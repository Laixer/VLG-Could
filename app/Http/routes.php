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

Route::get('/', function () {
    return view('common.main');
});

Route::get('common/header', function () {
    return view('common.header');
});

Route::get('common/footer', function () {
    return view('common.footer');
});

Route::get('dashboard', function () {
    return view('dashboard');
});

Route::get('project_details', function () {
    return view('project_details');
});

Route::get('validation', function () {
    return view('validation');
});

Route::get('toastr', function () {
    return view('toastr');
});

Route::get('sweet_alert', function () {
    return view('sweet_alert');
});

Route::get('loading_buttons', function () {
    return view('loading_buttons');
});

Route::get('modal_window', function () {
    return view('modal_window');
});

Route::get('new_project_window', function () {
    return view('new_project_window');
});

Route::get('attach_todo_window', function () {
    return view('attach_todo_window');
});

Route::group(['prefix' => 'api/v1'], function () {
	Route::get('auth/check', 'ApiController@getAuthStatus');
    Route::get('projects', 'ApiController@getProjects');
    Route::get('project_fields', 'ApiController@getProjectFields');
    Route::get('project/{id}', 'ApiController@getProjectFromId');
    Route::get('project/{id}/reports', 'ApiController@getProjectReports');
    Route::get('project/{id}/thread', 'ApiController@getProjectThread');
    Route::get('project/{id}/todo', 'ApiController@getProjectTodo');
    Route::get('project/{id}/todo_available', 'ApiController@getProjectTodoAvailable');
    Route::get('report/{id}/download', 'ApiController@getDownloadRaport');
    Route::post('upload', 'ApiController@doNewFile');
    Route::post('new_project', 'ApiController@doNewProject');
    Route::post('new_message', 'ApiController@doNewMessage');
    Route::post('new_todo', 'ApiController@doNewTodo');
    Route::post('update_report', 'ApiController@doUpdateReport');
    Route::post('update_note', 'ApiController@doUpdateNote');
    Route::post('update_status', 'ApiController@doUpdateStatus');
    Route::post('update_todo', 'ApiController@doUpdateTodo');
});

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
    //
});
