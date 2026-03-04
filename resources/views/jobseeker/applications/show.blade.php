@extends('layouts.app')
@section('content')
<h1>Application Details</h1>

<p><strong>Job:</strong> {{ $application->job->title }}</p>
<p><strong>Status:</strong> {{ ucfirst($application->status) }}</p>

<h3>Job Details</h3>
<p>{{ $application->job->description }}</p>
<p>Location: {{ $application->job->location }}</p>
<p>Salary: {{ $application->job->salary ?? 'N/A' }}</p>
@endsection