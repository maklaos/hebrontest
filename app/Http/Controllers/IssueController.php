<?php

namespace App\Http\Controllers;

use App\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $apiIssues = resolve('redmine')->getIssues();

        foreach ($apiIssues->issues as $issue) {
            Issue::updateOrCreate([
                'id' => $issue->id,
            ], [
                'id' => $issue->id,
                'project_id' => $issue->project->id,
                'assigned_to' => isset($issue->assigned_to) ? $issue->assigned_to->name : '',
                'author' => $issue->author->name,
                'description' => $issue->description,
                'subject' => $issue->subject,
                'done_ratio' => $issue->done_ratio,
                'estimated_hours' => isset($issue->estimated_hours) ? $issue->estimated_hours : 0.00,
                'priority' => $issue->priority->id,
                'status' => $issue->status->id,
                'tracker' => $issue->tracker->name,
                'start_date' => $issue->start_date,
                'closed_on' => isset($issue->closed_on) ? $issue->closed_on : '',
                'created_on' => $issue->created_on,
                'updated_on' => $issue->updated_on,
            ]); //update issues from api
        }

        return view('issues.index')->with([
            'issues' => Issue::get()
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
     * @param  \App\Issue  $issues
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue) {
        return view('issues.show')->with([
            'issue' => $issue
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issue  $issues
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Issue  $issues
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue) {
        $result = resolve('redmine')->issueToRedmine($request, $issue);

        if ($result->getStatusCode() == "200") {
            return redirect()->back()->with('success', 'Time saved');
        } else {
            return redirect()->back()->with('error', 'Something went wrong=(');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Issue  $issues
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue) {
        //
    }
}
