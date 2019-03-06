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

        <h4>Add time</h4>
        <p style="color:#79ff55">{!! \Session::get('success') !!}</p>
        <form action="{{ route('issues.update', $issue->id) }}" accept-charset="UTF-8" method="post">
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
