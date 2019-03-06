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
        $ch = curl_init();
        $post = [
            'time_entry[hours]' => $request->hours,
            'time_entry[project_id]' => $project->id,
            'time_entry[comments]'   => $request->comments,
            'time_entry[activity_id]'   => $request->activity_id,
            'time_entry[overtime]'   => $request->overtime,
            'key' => config('redmine.redmine_api_key'),
        ];

        $options = array(
            CURLOPT_URL            => 'https://redmine.ekreative.com/time_entries.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_CONNECTTIMEOUT => 120,
            CURLOPT_TIMEOUT        => 120,
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_POST           => 1,
            CURLOPT_POSTFIELDS     => $post
        );
        curl_setopt_array($ch, $options);

        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode != 200){
            return redirect()->back()->with('success', 'Time saved');
        } else {
            return $httpCode;
        }
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
