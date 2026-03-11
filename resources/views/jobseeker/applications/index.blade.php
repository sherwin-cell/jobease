@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
<div class="max-w-5xl mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6">My Job Applications</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if($applications->isEmpty())
        <!-- No Applications Message -->
        <div class="bg-blue-50 border border-blue-200 p-6 rounded text-center">
            <p class="text-gray-600 mb-4">You haven't applied to any jobs yet.</p>
            <a href="{{ route('jobseeker.jobs.index') }}" 
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold px-6 py-2 rounded inline-block">
                Browse Jobs
            </a>
        </div>
    @else
        <!-- Applications Table -->
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="text-left px-6 py-4 font-bold text-gray-700">Job Title</th>
                        <th class="text-left px-6 py-4 font-bold text-gray-700">Location</th>
                        <th class="text-left px-6 py-4 font-bold text-gray-700">Applied Date</th>
                        <th class="text-left px-6 py-4 font-bold text-gray-700">Status</th>
                        <th class="text-center px-6 py-4 font-bold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <!-- Job Title -->
                        <td class="px-6 py-4">
                            <a href="{{ route('jobseeker.jobs.show', $application->job) }}" 
                                class="text-blue-500 hover:underline font-semibold">
                                {{ $application->job->title }}
                            </a>
                        </td>

                        <!-- Location -->
                        <td class="px-6 py-4 text-gray-600">
                            {{ $application->job->location ?? 'N/A' }}
                        </td>

                        <!-- Applied Date -->
                        <td class="px-6 py-4 text-gray-600">
                            {{ $application->created_at->format('M d, Y') }}
                        </td>

                        <!-- Status Badge -->
                        <td class="px-6 py-4">
                            @if($application->status === 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-sm font-semibold">
                                    Pending
                                </span>
                            @elseif($application->status === 'accepted')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded text-sm font-semibold">
                                    Accepted
                                </span>
                            @elseif($application->status === 'rejected')
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded text-sm font-semibold">
                                    Rejected
                                </span>
                            @else
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded text-sm font-semibold">
                                    {{ ucfirst($application->status) }}
                                </span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('jobseeker.applications.show', $application) }}" 
                                class="text-blue-500 hover:text-blue-700 font-semibold text-sm">
                                View Details
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection