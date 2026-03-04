@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
<h1>Welcome, {{ auth()->user()->name }}</h1>

<p>This is your Employer Dashboard.</p>

<ul>
    <li><a href="{{ route('employer.profile.edit') }}">Edit Profile</a></li>
    <li><a href="{{ route('employer.jobs.index') }}">My Jobs</a></li>
    <li><a href="{{ route('employer.applications.index') }}">Applications</a></li>
</ul>
@endsection