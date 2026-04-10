@extends('layouts.app')

@section('title', $job->title)

@section('content')
    <div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded shadow">
        <div class="flex items-center justify-between gap-4">
            <a href="{{ route('employer.jobs.index') }}" class="text-blue-600 hover:underline text-sm">
                ← Back to My Jobs
            </a>

            <a href="{{ route('employer.jobs.edit', $job) }}"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
                Edit Job
            </a>
        </div>

        <div class="mt-4 mb-6">
            <h1 class="text-3xl font-bold">{{ $job->title }}</h1>
            <div class="text-gray-500 text-sm mt-2 space-x-4">
                <span>📍 {{ $job->location ?? 'N/A' }}</span>
                <span>💰 {{ $job->salary ?? 'Negotiable' }}</span>
                <span>🎯 {{ $job->experience_level ?? 'N/A' }}</span>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Required Skills</h2>
            @if($job->skills_required && is_array($job->skills_required) && count($job->skills_required) > 0)
                <div class="flex flex-wrap gap-2">
                    @foreach($job->skills_required as $skill)
                        <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                            {{ trim($skill) }}
                        </span>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400">No skills listed.</p>
            @endif
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Job Description</h2>
            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $job->description }}</p>
        </div>

        <div class="text-sm text-gray-500">
            Posted {{ $job->created_at?->diffForHumans() }}
        </div>
    </div>
@endsection