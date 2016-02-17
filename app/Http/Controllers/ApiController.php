<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Storage;
use Portal;
use App\Project;
use App\ProjectThread;
use App\ProjectTodo;
use App\ProjectField;
use App\Report;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
	private $acceptMime = [
		'application/pdf',
		'application/excel',
		'application/vnd.ms-office',
		'application/vnd.ms-excel',
		'application/x-msexcel',
		'application/msword',
		'text/plain',
		'application/x-compressed',
		'application/x-zip-compressed',
		'application/zip',
		'multipart/x-zip',
	];

    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	private function uniqueId($l = 8) {
		return substr(md5(uniqid(mt_rand(), true)), 0, $l);
	}

	public function getProjects()
	{
		$arr = [];
		foreach (Project::where('status_id', '!=', 5)->get() as $project) {
			$obj = $project;
			$obj['status'] = $project->status;
			$obj['field'] = $obj->field;
			array_push($arr, $obj);
		}

		return response()->json($arr);
	}

	public function getProjectFields()
	{
		return response()->json(ProjectField::all());
	}

	public function getProjectCompanies()
	{
        $portal = Portal::driver('vlgportal');
        $portal->setToken(Auth::token());

        $arr = [];
        foreach ($portal->portalCompanies()['companies'] as $company) {
        	$obj['id'] = $company['id'];
        	$obj['name'] = $company['name'];
        	array_push($arr, $obj);
        }

		return response()->json($arr);
	}

	public function getProjectFromId(Request $request, $id)
	{
		$obj = Project::find($id);
		if ($obj) {
			$obj['status'] = $obj->status;
			$obj['field'] = $obj->field;
			$obj['owner'] = $obj->resolveOwner();
			$obj['client'] = $obj->resolveClient();
			$obj['involved'] = $obj->resolveInvolved();
		}

		return response()->json($obj);
	}

	public function getProjectReports(Request $request, $id)
	{
		$obj = Project::find($id);
		if (!$obj)
			return response()->json([]);

		return response()->json($obj->reports);
	}

	public function getProjectThread(Request $request, $id)
	{
		$obj = Project::find($id);
		if (!$obj)
			return response()->json([]);

        $arr = [];
        foreach ($obj->thread()->orderBy('created_at')->get() as $message) {
        	$obj = $message;
        	$obj['isme'] = $obj->user_id == Auth::id();
        	if ($obj['isme']) {
        		$obj['name'] = 'Ik';
        	} else {
        		$obj['name'] = $obj->resolveUser();
        	}
        	array_push($arr, $obj);
        }

		return response()->json($arr);
	}

	public function getProjectTodo(Request $request, $id)
	{
		$arr = [];
		foreach (Project::find($id)->todo as $todo) {
			$obj = $todo;
			$obj['report'] = $todo->report()->select(['id','name'])->first();
			array_push($arr, $obj);
		}

		return response()->json($arr);
	}

	public function getProjectTodoAvailable(Request $request, $id)
	{
		$obj = Project::find($id);
		if (!$obj)
			return response()->json([]);

		return response()->json($obj->todoAvailableForAttach);
	}

	public function getDownloadRaport(Request $request, $id)
	{
		$raport = Report::find($id);
		if (!$raport)
			return response()->json(['error' => 'resource not found'], 404);

		$file = storage_path('app') . '/' . $raport->location;

		return response()->download($file, $raport->name, ['Content-Type' => $raport->mime, 'x-filename' => $raport->name]);
	}

	public function doNewProject(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|unique:projects|max:30',
			'number' => 'required|max:30',
			'reference' => 'required|max:30',
			'field' => 'required:integer',
			'client' => 'required:integer',
		]);

		$project = new Project;
		$project->name = $request->input('name');
		$project->number = $request->input('number');
		$project->reference = $request->input('reference');
		$project->status_id = 1;
		$project->field_id = $request->input('field');
		$project->owner_user_id = Auth::id();
		$project->client_company_id = $request->input('client');

		$project->save();
		$project['status'] = $project->status;
		$project['field'] = $project->field;

		if ($project->field->name == 'Asfalt')
			$project->loadDefaultTodo();

		return response()->json($project);
	}

	public function doNewTodo(Request $request)
	{
		$this->validate($request, [
			'project' => 'required',
			'message' => 'required',
		]);

		$todo = new ProjectTodo;
		$todo->message = $request->input('message');
		$todo->project_id = $request->input('project');

		$todo->save();

		return response()->json($todo);
	}

	public function doNewMessage(Request $request)
	{
		$this->validate($request, [
			'project' => 'required',
			'message' => 'required',
		]);

		$message = new ProjectThread;
		$message->message = $request->input('message');
		$message->project_id = $request->input('project');
		$message->user_id = Auth::id();

		$message->save();

		return response()->json($message);
	}

	public function doNewFile(Request $request)
	{
		$file = $request->file('uploadfile');

		if ($file->isValid() && in_array($file->getMimeType(), $this->acceptMime)) {

			$project = Project::find($request->input('project'));
			if (!$project)
				return response()->json(['error' => 'invalid project'], 406);

			/* Save file */
			$name = $project->getNameAsPath() . '/' .  $this->uniqueId() . '_' . $file->getClientOriginalName();
			Storage::put($name, file_get_contents($file->getRealPath()));

			/* Attach to project */
			$report = new Report;
			$report->name = $file->getClientOriginalName();
			$report->location = $name;
			$report->mime = $file->getMimeType();
			$report->project_id = $project->id;

			$report->save();

			return response()->json($report);
		}

		return response()->json(['error' => 'invalid resource'], 406);
	}

	public function doUpdateReport(Request $request)
	{
		$this->validate($request, [
			'report' => 'required|integer',
			'todo' => 'required|integer',
		]);

		$raport = Report::find($request->input('report'));
		if (!$raport)
			return response()->json(['error' => 'resource not found'], 404);

		$raport->todo_id = $request->input('todo');
		$raport->save();

		return response()->json($raport);
	}

	public function doUpdateNote(Request $request)
	{
		$this->validate($request, [
			'project' => 'required',
		]);

		if (!$request->input('note'))
			return response()->json(['passed' => true]);

		$project = Project::find($request->input('project'));
		if (!$project)
			return response()->json(['error' => 'invalid project'], 406);

		$project->note = $request->input('note');
		$project->save();

		return response()->json(['saved' => true]);
	}

	public function doUpdateStatus(Request $request)
	{
		$this->validate($request, [
			'project' => 'required',
			'status' => 'required|integer',
		]);

		$project = Project::find($request->input('project'));
		if (!$project)
			return response()->json(['error' => 'invalid project'], 406);

		// if ($project->status->priority > $request->input('status'))
			// return response()->json(['error' => 'invalid status'], 406);

		$project->status_id = $request->input('status');
		$project->save();

		return response()->json($project->status);
	}

	public function doUpdateTodo(Request $request)
	{
		$this->validate($request, [
			'todo' => 'required',
		]);

		$todo = ProjectTodo::find($request->input('todo'));
		if (!$todo)
			return response()->json(['error' => 'invalid todo'], 406);

		$todo->done = true;
		$todo->save();

		return response()->json(['saved' => true]);
	}

	public function getAuthStatus(Request $request)
	{
		return response()->json(['auth' => true]);
	}

}
