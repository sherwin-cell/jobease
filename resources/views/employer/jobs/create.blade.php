@extends('layouts.app')

@section('title', isset($job) ? 'Edit Job' : 'Create Job')

@section('content')
<div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6 text-center">
        {{ isset($job) ? 'Edit Job' : 'Create Job' }}
    </h1>

    <form action="{{ isset($job) ? route('employer.jobs.update', $job) : route('employer.jobs.store') }}"
        method="POST"
        class="space-y-5">

        @csrf
        @if(isset($job))
            @method('PUT')
        @endif

        <!-- Job Title -->
        <div>
            <label class="block font-medium mb-1">Job Title</label>
            <input type="text"
                name="title"
                value="{{ old('title', $job->title ?? '') }}"
                class="w-full border rounded p-2 @error('title') border-red-500 @enderror"
                required>

            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block font-medium mb-1">Description</label>
            <textarea name="description"
                rows="5"
                class="w-full border rounded p-2 @error('description') border-red-500 @enderror"
                required>{{ old('description', $job->description ?? '') }}</textarea>

            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Location & Salary -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="block font-medium mb-1">Location</label>
                <input type="text"
                    name="location"
                    value="{{ old('location', $job->location ?? '') }}"
                    class="w-full border rounded p-2 @error('location') border-red-500 @enderror"
                    required>

                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">Salary</label>
                <input type="number"
                    name="salary"
                    value="{{ old('salary', $job->salary ?? '') }}"
                    class="w-full border rounded p-2 @error('salary') border-red-500 @enderror">

                @error('salary')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <!-- Experience Level -->
        <div>
            <label class="block font-medium mb-1">Experience Level</label>
            <input type="text"
                name="experience_level"
                value="{{ old('experience_level', $job->experience_level ?? '') }}"
                class="w-full border rounded p-2 @error('experience_level') border-red-500 @enderror">

            @error('experience_level')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Required Skills -->
        <div>
            <label class="block font-medium mb-1">Required Skills</label>

            <input type="text"
                name="skills_required"
                value="{{ old('skills_required', $job->skills_required ?? '') }}"
                class="w-full border rounded p-2"
                placeholder="Example: PHP, Laravel, MySQL">

            <p class="text-gray-500 text-xs mt-1">
                Separate skills with commas
            </p>
        </div>

        <!-- Submit -->
        <div class="pt-2">
            <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded">
                {{ isset($job) ? 'Update Job' : 'Create Job' }}
            </button>
        </div>

    </form>

</div>
@endsection