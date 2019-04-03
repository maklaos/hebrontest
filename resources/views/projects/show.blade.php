@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>{{ $project->name }}</h3>
        <table>
            <tr>
                <td>Name</td>
                <td>{{ $project->name }}</td>
            </tr>
            <tr>
                <td>Indentifier</td>
                <td>{{ $project->identifier }}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{{ $project->description }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>{{ $project->status }}</td>
            </tr>
            <tr>
                <td>Created</td>
                <td>{{ $project->created_on }}</td>
            </tr>
            <tr>
                <td>Updated</td>
                <td>{{ $project->updated_on }}</td>
            </tr>
        </table>
    </div>

    <div class="container">
        <h4>Project issues</h4>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Project</th>
                    <th>Tracker</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Subject</th>
                    <th>Author</th>
                    <th>Assignee</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
            @foreach($issues as $issue)
                <tr>
                    <td><a href="{{ route('issues.show', $issue->id) }}">{{ $issue->id }}</a></td>
                    <td><a href="{{ route('projects.show', $issue->project_id) }}">{{ $issue->project->name }}</a></td>
                    <td>{{ $issue->tracker }}</td>
                    <td>{{ $issue->status }}</td>
                    <td>{{ $issue->priority }}</td>
                    <td><a href="{{ route('issues.show', $issue->id) }}">{{ $issue->subject }}</a></td>
                    <td>{{ $issue->author }}</td>
                    <td>{{ $issue->assigned_to }}</td>
                    <td>{{ $issue->updated_on }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="container">
        <h4>Comments</h4>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Author</th>
                <th>Comment</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($commnets as $commnet)
                <tr>
                    <td>{{ $commnet->user->name }}</td>
                    <td>{{ $commnet->comment }}</td>
                    <td>{{ $commnet->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p style="color:#79ff55">{!! \Session::get('success_comment') !!}</p>
        <h4>Write a comment</h4>
        <form action="{{ route('comment.store') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <div>
                <textarea name="comment" id="" cols="30" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Send</button>
        </form>

        <h4>Add time</h4>
        <p style="color:#79ff55">{!! \Session::get('success') !!}</p>
        <p style="color:#ff0005">{!! \Session::get('error') !!}</p>
        <form action="{{ route('projects.update', $project->id) }}" accept-charset="UTF-8" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <p><label for="time_entry_hours">Hours<span class="required"> *</span></label><input size="6" value="" type="text" name="hours" id="time_entry_hours"></p>
            <p><label for="time_entry_comments">Comment</label><input size="100" maxlength="1024" type="text" name="comments" id="time_entry_comments"></p>
            <p><label for="time_entry_activity_id">Activity<span class="required"> *</span></label>
                <select name="activity_id" id="time_entry_activity_id"><option value="8">Design</option>
                    <option selected="selected" value="9">Development</option>
                    <option value="10">Management</option>
                    <option value="11">Testing</option>
                    <option value="12">Automation QA</option>
                </select>
            </p>
            <p><label for="time_entry_custom_field_values_5"><span title="Is this spent time overtime?" class="field-description">Overtime</span> <span class="required">*</span></label><span class="bool_cf"><input type="checkbox" name="overtime" id="time_entry_custom_field_values_5" value="1"></span></p>

            <input type="submit" name="commit" value="Add time">
        </form>
    </div>

@endsection
