@extends('layouts.app')

@section('content')

    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Project</th>
                <th>Tracker</th>
                <th>Estimated hours</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Subject</th>
                <th>Author</th>
                <th>Assignee</th>
                <th>Updated</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="{{ route('issues.show', $issue->id) }}">{{ $issue->id }}</a></td>
                    <td><a href="{{ route('projects.show', $issue->project_id) }}">{{ $issue->project->name }}</a></td>
                    <td>{{ $issue->tracker }}</td>
                    <td>{{ $issue->estimated_hours }}</td>
                    <td>{{ $issue->status }}</td>
                    <td>{{ $issue->priority }}</td>
                    <td><a href="{{ route('issues.show', $issue->id) }}">{{ $issue->subject }}</a></td>
                    <td>{{ $issue->author }}</td>
                    <td>{{ $issue->assigned_to }}</td>
                    <td>{{ $issue->updated_on }}</td>
                </tr>
            </tbody>
        </table>
    </div>


@endsection
