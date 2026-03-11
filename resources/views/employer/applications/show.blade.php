@extends('layouts.app')

@section('content')
    <div class="container max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Application Details</h1>

        @if(session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
        @endif

        <!-- Applicant Info -->
        <div class="bg-gray-50 p-4 rounded mb-6 border">
            <p><strong>Job:</strong> {{ $application->job->title }}</p>
            <p><strong>Applicant:</strong> {{ $application->user->name }} ({{ $application->user->email }})</p>
            <p><strong>Status:</strong> {{ ucfirst($application->status) }}</p>
            <p><strong>Applied:</strong> {{ $application->created_at->format('M j, Y H:i') }}</p>
        </div>

        <!-- Cover Letter -->
        @if($application->cover_letter)
            <div class="mb-6 border p-4 rounded bg-gray-50">
                <h3 class="font-semibold mb-2">Cover Letter</h3>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $application->cover_letter }}</p>
            </div>
        @endif

        <!-- Resume -->
        @if($application->resume)
            <div class="mb-6 border p-4 rounded bg-gray-50">
                <h3 class="font-semibold mb-2">Resume</h3>
                <p class="text-gray-600 text-sm mb-2">{{ basename($application->resume) }}</p>
                <a href="{{ asset('storage/' . $application->resume) }}" target="_blank"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold px-4 py-2 rounded">
                    📥 Download Resume
                </a>
            </div>
        @endif

        <!-- Update Status Form -->
        <div class="border p-4 rounded bg-gray-50 mb-6">
            <h3 class="font-semibold mb-4">Update Status</h3>
            <form method="POST" action="{{ route('employer.applications.updateStatus', $application->id) }}">
                @csrf
                <div class="flex gap-2">
                    <select name="status" class="border rounded px-3 py-2">
                        <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted
                        </option>
                        <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="hired" {{ $application->status == 'hired' ? 'selected' : '' }}>Hired</option>
                    </select>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-2 rounded">
                        Update
                    </button>
                </div>
            </form>
        </div>

        <!-- Back Link -->
        <p><a href="{{ route('employer.applications.index') }}" class="text-blue-600 hover:underline">← Back to
                applications</a></p>
    </div>
@endsection