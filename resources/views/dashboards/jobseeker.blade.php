@extends('layouts.app')

@section('title', 'Job Seeker Dashboard')

@section('content')
<h1>Welcome, {{ auth()->user()->name }}</h1>

<p>This is your Job Seeker Dashboard.</p>

<ul>
    <li><a href="{{ route('profile.edit') }}">Edit Profile</a></li>
    <li><a href="{{ route('jobs.index') }}">Browse Jobs</a></li>
    <li><a href="{{ route('applications.index') }}">My Applications</a></li>
</ul>
@endsection