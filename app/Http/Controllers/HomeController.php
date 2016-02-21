<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        // dd(Auth::user());

        Mail::raw('Kaas, gewoon kaas', function ($message) {
            $message->subject('Test');
            $message->from('no-reply@rotterdam-cloud.com', 'Rotterdam Cloud');
            $message->to('yorick17@outlook.com', 'Yorick de Wid');
        });
    }
}
