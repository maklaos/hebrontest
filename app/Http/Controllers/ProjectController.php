<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $apiProjects = $this->curlExec('https://redmine.ekreative.com/projects.json?key='.config('redmine.redmine_api_key'));

        if (is_array($apiProjects)) {
            return $apiProjects['error']; // return error code if connection failed
        }

        foreach ($apiProjects->projects as $project) {
            Project::updateOrCreate([
                'id' => $project->id,
            ], [
                'id' => $project->id,
                'name' => $project->name,
                'identifier' => $project->identifier,
                'description' => $project->description,
                'status' => $project->status,
                'created_on' => $project->created_on,
                'updated_on' => $project->updated_on,
            ]); //update projects from api
        }

        return view('projects.index')->with([
            'projects' => Project::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $projects
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project) {
        return view('projects.show')->with([
            'issues' => $project->issues,
            'commnets' => $project->comments,
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $projects
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $projects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project) {
        //
    }
}
