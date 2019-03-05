@extends('layouts.app')

@section('content')

    <div class="container">
    @foreach($projects as $project)
        <div class="row">
            <a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a>
        </div>
    @endforeach
    </div>

@endsection
