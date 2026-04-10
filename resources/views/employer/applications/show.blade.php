@extends('layouts.app')

@section('content')
    <div class="container max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Application Details</h1>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Applicant Info -->
        <div class="bg-gray-50 p-4 rounded mb-6 border">
            <p><strong>Job:</strong> {{ $application->job->title }}</p>
            <p><strong>Applicant:</strong> {{ $application->user->name }} ({{ $application->user->email }})</p>
            <p><strong>Status:</strong> 
                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                    @if($application->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($application->status == 'shortlisted') bg-blue-100 text-blue-800
                    @elseif($application->status == 'rejected') bg-red-100 text-red-800
                    @elseif($application->status == 'hired') bg-green-100 text-green-800
                    @endif
                ">
                    {{ ucfirst($application->status) }}
                </span>
            </p>
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

        <!-- Q&A Answers -->
        @if($application->qa_answers && count($application->qa_answers) > 0)
            <div class="mb-6 border p-4 rounded bg-gray-50">
                <h3 class="font-semibold mb-4">Application Questions & Answers</h3>
                @foreach($application->qa_answers as $index => $qa)
                    <div class="mb-4">
                        <p class="font-medium text-gray-700">{{ $index + 1 }}. {{ $qa['question'] }}</p>
                        <p class="text-gray-600 mt-1 pl-4">{{ $qa['answer'] ?: 'No answer provided.' }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Update Status Form -->
        <div class="border p-4 rounded bg-gray-50 mb-6">
            <h3 class="font-semibold mb-4">Update Status</h3>
            <form method="POST" action="{{ route('employer.applications.updateStatus', $application->id) }}">
                @csrf
                <div class="flex gap-2">
                    <select name="status" class="border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                        <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="hired" {{ $application->status == 'hired' ? 'selected' : '' }}>Hired</option>
                    </select>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-2 rounded transition">
                        Update
                    </button>
                </div>
                @error('status')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </form>
        </div>

        <!-- Back Link -->
        <p><a href="{{ route('employer.applications.index') }}" class="text-blue-600 hover:underline">← Back to applications</a></p>
    </div>
@endsection