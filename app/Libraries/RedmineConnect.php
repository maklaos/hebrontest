<?php

namespace App\Libraries;

use App\Issue;
use App\Project;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RedmineConnect {
    protected $key;

    public function __construct($key) {
        $this->key = $key;
    }

    public function getIssues() {
        return $this->getFromRedmine('https://redmine.ekreative.com/issues.json?key='.$this->key);
    }

    public function getProjects() {
        return $this->getFromRedmine('https://redmine.ekreative.com/projects.json?key='.$this->key);
    }

    private function getFromRedmine($url) {
        $client = new Client();
        $response = $client->request('GET', $url);

        return json_decode($response->getBody()->getContents());
    }

    public function issueToRedmine(Request $request, Issue $issue) {
        $post = [
            'time_entry[hours]' => $request->hours,
            'time_entry[issue_id]' => $issue->id,
            'time_entry[comments]'   => $request->comments,
            'time_entry[activity_id]'   => $request->activity_id,
            'time_entry[overtime]'   => $request->overtime,
            'key' => config('redmine.redmine_api_key'),
        ];

        $client = new Client();
        return $client->request('GET', 'https://redmine.ekreative.com/time_entries.json', [
            'form_params' => $post
        ]);
    }

    public function projectToRedmine(Request $request, Project $project) {
        $post = [
            'time_entry[hours]' => $request->hours,
            'time_entry[project_id]' => $project->id,
            'time_entry[comments]'   => $request->comments,
            'time_entry[activity_id]'   => $request->activity_id,
            'time_entry[overtime]'   => $request->overtime,
            'key' => config('redmine.redmine_api_key'),
        ];

        $client = new Client();
        return $client->request('GET', 'https://redmine.ekreative.com/time_entries.json', [
            'form_params' => $post
        ]);
    }
}