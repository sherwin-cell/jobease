@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $job->title }}</h1>
    <p>{{ $job->description }}</p>
    <p>Location: {{ $job->location ?? 'N/A' }}</p>
    <p>Experience: {{ $job->experience_level ?? 'Any' }}</p>
    <p>Salary: {{ $job->salary ?? 'Negotiable' }}</p>
    <p>Skills Required: {{ $job->skills_required ?? 'None' }}</p>

    <form method="POST" action="{{ route('jobs.apply', $job) }}">
        @csrf
        <button type="submit">Apply for this job</button>
    </form>
</div>
@endsection