@extends('layouts.app')
@section('content')
<h1>{{ isset($job) ? 'Edit Job' : 'Create Job' }}</h1>

<form action="{{ isset($job) ? route('employer.jobs.update',$job) : route('employer.jobs.store') }}" method="POST">
    @csrf
    @if(isset($job)) @method('PUT') @endif

    <div>
        <label>Title</label>
        <input type="text" name="title" value="{{ old('title', $job->title ?? '') }}">
    </div>

    <div>
        <label>Description</label>
        <textarea name="description">{{ old('description', $job->description ?? '') }}</textarea>
    </div>

    <div>
        <label>Location</label>
        <input type="text" name="location" value="{{ old('location', $job->location ?? '') }}">
    </div>

    <div>
        <label>Salary</label>
        <input type="number" name="salary" value="{{ old('salary', $job->salary ?? '') }}">
    </div>

    <div>
        <label>Experience Level</label>
        <input type="text" name="experience_level" value="{{ old('experience_level', $job->experience_level ?? '') }}">
    </div>

    <button type="submit">{{ isset($job) ? 'Update' : 'Create' }}</button>
</form>
@endsection