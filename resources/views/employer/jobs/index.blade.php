@extends('layouts.app')
@section('content')
<h1>My Job Postings</h1>
<a href="{{ route('employer.jobs.create') }}">Create New Job</a>

@if(session('success'))<div>{{ session('success') }}</div>@endif

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Location</th>
            <th>Salary</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jobs as $job)
        <tr>
            <td>{{ $job->title }}</td>
            <td>{{ $job->location }}</td>
            <td>{{ $job->salary }}</td>
            <td>
                <a href="{{ route('employer.jobs.edit', $job) }}">Edit</a>
                <form action="{{ route('employer.jobs.destroy', $job) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this job?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection