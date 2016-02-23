<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Audit;
use App\Project;
use App\Events\ProjectConfirmation;
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
        $this->middleware('auth', ['except' => 'getProjectConfirm']);
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

    public function getOptionsWindow()
    {
        return view('options_window');
    }

    public function getProjectConfirm(Request $request, $token)
    {
        $project = project::where('token', $token)->first();
        if (!$project)
            return redirect('/');

        if ($project->confirmed != -1)
            return redirect('/');

        if ($request->get('accept') == 'true') {
            $project->confirmed = true;
            $project->save();

            (new Audit('Project akkoord', $project->id))->save();

            event(new ProjectConfirmation($project));
        } else if ($request->get('accept') == 'false') {
            $project->confirmed = false;
            $project->save();

            (new Audit('Project afgewezen', $project->id))->save();

            event(new ProjectConfirmation($project));
        }

        return redirect('/');
    }

    public function about(Request $request)
    {
        dd(Auth::user());
    }
}
