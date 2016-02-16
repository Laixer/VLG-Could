<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function getCommonMain()
    {
    	return view('common.main');
    }

    public function getCommonHeader()
    {
    	return view('common.header');
    }

    public function getCommonFooter()
    {
    	return view('common.footer');
    }

    public function getDashboard()
    {
    	return view('dashboard');
    }

    public function getProjectDetails()
    {
    	return view('project_details');
    }

    public function getNewProjectWindow()
    {
    	return view('new_project_window');
    }

    public function getAttachTodoWindow()
    {
    	return view('attach_todo_window');
    }

    public function about(Request $request)
    {
        dd(Auth::user());
    }
}
