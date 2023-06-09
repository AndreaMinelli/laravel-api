<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::where('published', '1')->orderBy('updated_at', 'DESC')->with('type')->paginate(10);

        foreach ($projects as $project) {
            if ($project->project_img) $project->project_img = url('storage/' . $project->project_img);
        }

        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with('type', 'technologies')->find($id);
        if (!$project) return response(null, 404);
        if ($project->project_img) $project->project_img = url('storage/' . $project->project_img);

        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function projectsForType(string $id)
    {
        $type = Type::find($id);
        if (!$type) return response(null, 404);

        $projects = Project::where('type_id', $id)->orderBy('updated_at', 'DESC')->with('type')->paginate(10);

        return response()->json(compact('projects', 'type'));
    }
}
