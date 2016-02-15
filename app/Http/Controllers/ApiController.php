<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
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

	private function uniqueId($l = 8) {
		return substr(md5(uniqid(mt_rand(), true)), 0, $l);
	}

	public function getProjects()
	{
		$arr = [];
		foreach (Project::all() as $project) {
			$obj = $project;
			$obj['status'] = $project->status;
			array_push($arr, $obj);
		}

		return response()->json($arr);
	}

	public function getProjectFields()
	{
		return response()->json(ProjectField::all());
	}

	public function getProjectFromId(Request $request, $id)
	{
		$obj = Project::find($id);
		if ($obj)
			$obj['status'] = $obj->status;
			$obj['field'] = $obj->field;

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

		return response()->json($obj->thread()->orderBy('created_at')->get());
	}

	public function getProjectTodo(Request $request, $id)
	{
		$obj = Project::find($id);
		if (!$obj)
			return response()->json([]);

		return response()->json($obj->todo);
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
		]);

		$project = new Project;
		$project->name = $request->input('name');
		$project->number = $request->input('number');
		$project->reference = $request->input('reference');
		$project->status_id = 1;
		$project->field_id = $request->input('field');

		$project->save();
		$project['status'] = $project->status;
		$project['field'] = $project->field;

		if ($project->field->name == 'Asfalt') {
			$todo = new ProjectTodo;
			$todo->message = 'Bestek (met opbouw van asfalt) ';
			$todo->project_id = $project->id;
			$todo->save();

			$todo = new ProjectTodo;
			$todo->message = 'Laagopbouw asfaltcilinder met de mengselcode';
			$todo->project_id = $project->id;
			$todo->save();

			$todo = new ProjectTodo;
			$todo->message = 'Laagdikte';
			$todo->project_id = $project->id;
			$todo->save();

			$todo = new ProjectTodo;
			$todo->message = 'Aantal m2 totaal project';
			$todo->project_id = $project->id;
			$todo->save();

			$todo = new ProjectTodo;
			$todo->message = 'CE-bladen';
			$todo->project_id = $project->id;
			$todo->save();

			$todo = new ProjectTodo;
			$todo->message = 'Streefdichtheid';
			$todo->project_id = $project->id;
			$todo->save();

			$todo = new ProjectTodo;
			$todo->message = 'Refenrentie samenstelling';
			$todo->project_id = $project->id;
			$todo->save();
		}

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
		$message->user_id = 1; //TODO

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

	public function doUpdateNote(Request $request)
	{
		$this->validate($request, [
			'project' => 'required',
			'note' => 'required',
		]);

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
		// $this->validate($request, [
		// 	'project' => 'required',
		// 	'status' => 'required|integer',
		// ]);

		// $project = Project::find($request->input('project'));
		// if (!$project)
		// 	return response()->json(['error' => 'invalid project'], 406);

		// // if ($project->status->priority > $request->input('status'))
		// 	// return response()->json(['error' => 'invalid status'], 406);

		// $project->status_id = $request->input('status');
		// $project->save();

		return response()->json(['auth' => true]);
	}

}
