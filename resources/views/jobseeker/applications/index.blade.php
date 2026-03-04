@extends('layouts.app')
@section('content')
<h1>My Applications</h1>

@if(session('success')) <div>{{ session('success') }}</div> @endif
@if(session('error')) <div>{{ session('error') }}</div> @endif

<table>
    <thead>
        <tr>
            <th>Job Title</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($applications as $app)
        <tr>
            <td>{{ $app->job->title }}</td>
            <td>{{ ucfirst($app->status) }}</td>
            <td>
                <a href="{{ route('applications.show', $app) }}">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection