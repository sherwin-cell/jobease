@extends('layouts.app')
@section('content')
<div class="container max-w-2xl mx-auto p-6">
    <h1>Application Details</h1>
    @if(session('success'))<div class="text-green-600 mb-4">{{ session('success') }}</div>@endif
    <p><strong>Job:</strong> {{ $application->job->title }}</p>
    <p><strong>Applicant:</strong> {{ $application->user->name }} ({{ $application->user->email }})</p>
    <p><strong>Status:</strong> {{ ucfirst($application->status) }}</p>
    <p><strong>Applied:</strong> {{ $application->created_at->format('M j, Y H:i') }}</p>

    <h3 class="mt-4 font-semibold">Update status</h3>
    <form method="POST" action="{{ route('employer.applications.updateStatus', $application) }}" class="mt-2">
        @csrf
        <select name="status" class="border rounded px-2 py-1">
            <option value="pending" @if($application->status === 'pending') selected @endif>Pending</option>
            <option value="shortlisted" @if($application->status === 'shortlisted') selected @endif>Shortlisted</option>
            <option value="rejected" @if($application->status === 'rejected') selected @endif>Rejected</option>
            <option value="hired" @if($application->status === 'hired') selected @endif>Hired</option>
        </select>
        <button type="submit" class="ml-2 px-4 py-1 bg-blue-600 text-white rounded">Update</button>
    </form>
    <p class="mt-4"><a href="{{ route('employer.applications.index') }}" class="text-blue-600">← Back to applications</a></p>
</div>
@endsection
