@extends('layouts.app')
@section('content')
    <div class="container max-w-2xl mx-auto p-6">
        <h1>Application Details</h1>
        @if(session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>@endif
        <p><strong>Job:</strong> {{ $application->job->title }}</p>
        <p><strong>Applicant:</strong> {{ $application->user->name }} ({{ $application->user->email }})</p>
        <p><strong>Status:</strong> {{ ucfirst($application->status) }}</p>
        <p><strong>Applied:</strong> {{ $application->created_at->format('M j, Y H:i') }}</p>

        <h3 class="mt-4 font-semibold">Update status</h3>
        <form method="POST" action="{{ route('employer.applications.updateStatus', $application->id) }}">
            @csrf
            <select name="status">
                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="hired" {{ $application->status == 'hired' ? 'selected' : '' }}>Hired</option>
            </select>
            <button type="submit">Update Status</button>
        </form>
        <p class="mt-4"><a href="{{ route('employer.applications.index') }}" class="text-blue-600">← Back to
                applications</a></p>
    </div>
@endsection