@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Job Listings</h1>

    <!-- Filters -->
    <form method="GET" action="{{ route('jobs.index') }}">
        <input type="text" name="location" placeholder="Location" value="{{ request('location') }}">
        <input type="text" name="skills" placeholder="Skills (comma-separated)" value="{{ request('skills') }}">
        <select name="experience_level">
            <option value="">Any experience</option>
            <option value="Junior" @if(request('experience_level')=='Junior') selected @endif>Junior</option>
            <option value="Mid" @if(request('experience_level')=='Mid') selected @endif>Mid</option>
            <option value="Senior" @if(request('experience_level')=='Senior') selected @endif>Senior</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <hr>

    <!-- Job Listings -->
    @forelse($jobs as $job)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <h3><a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a></h3>
            <p>{{ Str::limit($job->description, 150) }}</p>
            <p>Location: {{ $job->location ?? 'N/A' }} | Experience: {{ $job->experience_level ?? 'Any' }}</p>
            <p>Skills Required: {{ $job->skills_required ?? 'None' }}</p>
        </div>
    @empty
        <p>No jobs found.</p>
    @endforelse

    {{ $jobs->links() }} <!-- pagination -->
</div>
@endsection