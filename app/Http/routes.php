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
    return view('main');
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

Route::group(['prefix' => 'api/v1'], function () {
    Route::get('projects', 'ApiController@getProjects');
    Route::get('project/{id}', 'ApiController@getProjectFromId');
    Route::get('project/{id}/reports', 'ApiController@getProjectReports');
    Route::get('project/{id}/thread', 'ApiController@getProjectThread');
    Route::get('report/{id}/download', 'ApiController@getDownloadRaport');
    Route::post('upload', 'ApiController@doNewFile');
    Route::post('new_project', 'ApiController@doNewProject');
    Route::post('update_note', 'ApiController@doUpdateNote');
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
