@extends('layouts.app')

@section('title', $job->title)

@section('content')
    <div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">{{ $job->title }}</h1>

        <!-- Job Information -->
        <div class="space-y-4 mb-8">
            <div>
                <strong class="block text-gray-600">Description:</strong>
                <p class="mt-1">{{ $job->description }}</p>
            </div>

            <div>
                <strong class="block text-gray-600">Location:</strong>
                <p class="mt-1">{{ $job->location ?? 'N/A' }}</p>
            </div>

            <div>
                <strong class="block text-gray-600">Experience Level:</strong>
                <p class="mt-1">{{ $job->experience_level ?? 'Any' }}</p>
            </div>

            <div>
                <strong class="block text-gray-600">Salary:</strong>
                <p class="mt-1">{{ $job->salary ?? 'Negotiable' }}</p>
            </div>

            <div>
                <strong class="block text-gray-600">Skills Required:</strong>
                <p class="mt-1">
                    @if($job->skills_required && count($job->skills_required) > 0)
                        {{ implode(', ', $job->skills_required) }}
                    @else
                        None
                    @endif
                </p>
            </div>
        </div>

        <!-- Apply Button -->
        <div class="text-center">
            <a href="{{ route('jobseeker.jobs.apply.form', $job) }}"
                class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-2 rounded">
                Apply for this Job
            </a>
        </div>
    </div>
@endsection