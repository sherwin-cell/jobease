@extends('layouts.app')

@section('title', 'My Job Postings')

@section('content')
    <div class="max-w-7xl mx-auto mt-8 bg-white p-6 rounded shadow">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">My Job Postings</h1>
            <a href="{{ route('employer.jobs.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded">
                + Create New Job
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($jobs->isEmpty())
            <p class="text-gray-500 text-center py-8">You have not posted any jobs yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-3 text-left font-semibold w-1/4">Title</th>
                            <th class="border p-3 text-left font-semibold w-1/6">Location</th>
                            <th class="border p-3 text-left font-semibold w-1/6">Salary</th>
                            <th class="border p-3 text-left font-semibold w-1/4">Skills Required</th>
                            <th class="border p-3 text-left font-semibold w-1/6">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                            <tr class="hover:bg-gray-50 transition border-b">
                                <!-- Title -->
                                <td class="border p-3 w-1/4">
                                    <a href="{{ route('jobseeker.jobs.show', $job) }}" 
                                        class="text-blue-600 hover:underline font-semibold break-words"
                                        title="{{ $job->title }}">
                                        {{ Str::limit($job->title, 25, '...') }}
                                    </a>
                                </td>

                                <!-- Location -->
                                <td class="border p-3 w-1/6">
                                    {{ $job->location ?? 'N/A' }}
                                </td>

                                <!-- Salary -->
                                <td class="border p-3 w-1/6">
                                    {{ $job->salary ?? 'Negotiable' }}
                                </td>

                                <!-- Skills -->
                                <td class="border p-3 w-1/4">
                                    @if($job->skills_required && is_array($job->skills_required) && count($job->skills_required) > 0)
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($job->skills_required as $skill)
                                                <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded">
                                                    {{ trim($skill) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">None</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="border p-3 w-1/6 whitespace-nowrap">
                                    <a href="{{ route('employer.jobs.edit', $job) }}" 
                                        class="text-blue-500 hover:text-blue-700 font-semibold text-sm mr-3">
                                        Edit
                                    </a>
                                    <form action="{{ route('employer.jobs.destroy', $job) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            onclick="return confirm('Delete this job?')"
                                            class="text-red-500 hover:text-red-700 font-semibold text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection