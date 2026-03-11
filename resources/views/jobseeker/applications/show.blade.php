@extends('layouts.app')

@section('title', 'Application Details')

@section('content')
<div class="max-w-3xl mx-auto mt-8">
    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('jobseeker.applications.index') }}" class="text-blue-500 hover:underline">
            ← Back to Applications
        </a>
    </div>

    <div class="bg-white rounded shadow p-6">
        <!-- Job Information -->
        <div class="mb-8 pb-8 border-b">
            <h1 class="text-3xl font-bold mb-4">{{ $application->job->title }}</h1>
            
            <div class="grid grid-cols-2 gap-4 text-gray-700">
                <div>
                    <p><strong>Location:</strong> {{ $application->job->location ?? 'N/A' }}</p>
                    <p><strong>Salary:</strong> {{ $application->job->salary ?? 'Negotiable' }}</p>
                </div>
                <div>
                    <p><strong>Applied Date:</strong> {{ $application->created_at->format('M d, Y') }}</p>
                    <p><strong>Applied Time:</strong> {{ $application->created_at->format('h:i A') }}</p>
                </div>
            </div>
        </div>

        <!-- Application Status -->
        <div class="mb-8 pb-8 border-b">
            <h2 class="text-xl font-bold mb-4">Application Status</h2>
            
            @if($application->status === 'pending')
                <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded text-sm font-semibold">
                    ⏳ Pending Review
                </span>
                <p class="text-gray-600 text-sm mt-2">Your application is under review. You'll be notified once the employer responds.</p>
            @elseif($application->status === 'accepted')
                <span class="bg-green-100 text-green-800 px-4 py-2 rounded text-sm font-semibold">
                    ✓ Accepted
                </span>
                <p class="text-gray-600 text-sm mt-2">Congratulations! Your application has been accepted.</p>
            @elseif($application->status === 'rejected')
                <span class="bg-red-100 text-red-800 px-4 py-2 rounded text-sm font-semibold">
                    ✗ Rejected
                </span>
                <p class="text-gray-600 text-sm mt-2">Unfortunately, your application was not selected at this time.</p>
            @else
                <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded text-sm font-semibold">
                    {{ ucfirst($application->status) }}
                </span>
            @endif
        </div>

        <!-- Cover Letter -->
        @if($application->cover_letter)
        <div class="mb-8 pb-8 border-b">
            <h2 class="text-xl font-bold mb-4">Your Cover Letter</h2>
            <div class="bg-gray-50 p-4 rounded border">
                <p class="text-gray-700 whitespace-pre-wrap">{{ $application->cover_letter }}</p>
            </div>
        </div>
        @endif

        <!-- Resume -->
        <div class="mb-8 pb-8 border-b">
            <h2 class="text-xl font-bold mb-4">Your Resume</h2>
            
            @if($application->resume)
                <div class="bg-gray-50 p-4 rounded border flex items-center justify-between">
                    <div>
                        <p class="font-semibold text-gray-800">{{ basename($application->resume) }}</p>
                        <p class="text-gray-600 text-sm">Uploaded on {{ $application->created_at->format('M d, Y') }}</p>
                    </div>
                    <a href="{{ asset('storage/' . $application->resume) }}" 
                        target="_blank"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold px-6 py-2 rounded">
                        📥 Download
                    </a>
                </div>
            @else
                <p class="text-gray-600">No resume uploaded with this application.</p>
            @endif
        </div>

        <!-- Job Description -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4">Job Description</h2>
            <div class="bg-gray-50 p-4 rounded border">
                <p class="text-gray-700 whitespace-pre-wrap">{{ $application->job->description ?? 'No description available' }}</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-4 justify-center">
            <a href="{{ route('jobseeker.jobs.show', $application->job) }}" 
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold px-6 py-2 rounded">
                View Job Post
            </a>
            <a href="{{ route('jobseeker.applications.index') }}" 
                class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-6 py-2 rounded">
                Back to Applications
            </a>
        </div>
    </div>
</div>
@endsection