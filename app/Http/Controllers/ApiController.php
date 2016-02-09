<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
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

	public function getProjectFromId(Request $request, $id)
	{
		return response()->json(Project::find($id));
	}

	public function doNewProject(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|unique:projects|max:30',
			'number' => 'required|max:30',
			'reference' => 'required|max:30',
		]);

		$project = new Project;
		$project->name = $request->input('name');
		$project->number = $request->input('number');
		$project->reference = $request->input('reference');
		$project->status_id = 1;

		$project->save();

		return response()->json($project);
	}
	
}
