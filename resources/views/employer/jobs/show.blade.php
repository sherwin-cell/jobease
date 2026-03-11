@extends('layouts.app')

@section('title', $job->title)

@section('content')
<div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded shadow">

    <!-- Back Button -->
    <a href="{{ route('jobseeker.jobs.index') }}" class="text-blue-500 hover:underline text-sm">← Back to Jobs</a>

    <!-- Job Title & Meta -->
    <div class="mt-4 mb-6">
        <h1 class="text-3xl font-bold">{{ $job->title }}</h1>
        <div class="text-gray-500 text-sm mt-2 space-x-4">
            <span>📍 {{ $job->location }}</span>
            <span>💰 {{ $job->salary }}</span>
            <span>🎯 {{ $job->experience_level }}</span>
        </div>
    </div>

    <!-- Skills -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Required Skills</h2>
        @if(!empty($job->skills))
            <div class="flex flex-wrap gap-2">
                @foreach($job->skills as $skill)
                    <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $skill->name }}
                    </span>
                @endforeach
            </div>
        @else
            <p class="text-gray-400">No skills listed.</p>
        @endif
    </div>

    <!-- Description -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Job Description</h2>
        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $job->description }}</p>
    </div>

    <!-- Posted By -->
    <div class="mb-6 text-sm text-gray-500">
        Posted by <span class="font-semibold">{{ $job->employer->name ?? 'Unknown' }}</span>
        · {{ $job->created_at->diffForHumans() }}
    </div>

    <!-- Apply Button -->
    @auth
        @if(auth()->user()->role === 'job_seeker')
            <form action="{{ route('jobseeker.jobs.apply', $job) }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded transition">
                    Apply Now
                </button>
            </form>
        @endif
    @endauth

</div>
@endsection