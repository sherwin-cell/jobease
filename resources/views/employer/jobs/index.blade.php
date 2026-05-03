@extends('layouts.app')

@section('title', 'My Job Postings')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">My Job Postings</h1>
        <a href="{{ route('employer.jobs.create') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            + Create New Job
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Location</th>
                <th class="border px-4 py-2">Salary</th>
                <th class="border px-4 py-2">Skills Required</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jobs as $job)
                <tr>
                    <td class="border px-4 py-2">{{ $job->title }}</td>
                    <td class="border px-4 py-2">{{ $job->location }}</td>
                    <td class="border px-4 py-2">${{ number_format($job->salary) }}</td>
                    <td class="border px-4 py-2">
                        @if(is_array($job->skills_required))
                            {{ implode(', ', $job->skills_required) }}
                        @else
                            {{ $job->skills_required }}
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @php
                            $statusColors = [
                                'active' => 'bg-green-100 text-green-800',
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'rejected' => 'bg-red-100 text-red-800',
                                'expired' => 'bg-gray-100 text-gray-800',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded text-xs font-semibold {{ $statusColors[$job->status] ?? 'bg-gray-100' }}">
                            {{ ucfirst($job->status) }}
                        </span>
                        
                        @if($job->status === 'rejected')
                            <div class="text-xs text-red-600 mt-1">
                                ⚠️ Needs revision
                            </div>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        <div class="flex gap-2">
                            @if($job->status !== 'rejected')
                                <a href="{{ route('employer.jobs.edit', $job) }}" 
                                   class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                    Edit
                                </a>
                            @else
                                <button disabled 
                                        class="bg-gray-300 text-gray-500 px-3 py-1 rounded text-sm cursor-not-allowed"
                                        title="Rejected jobs cannot be edited. Please delete and create a new one.">
                                    Edit (Disabled)
                                </button>
                            @endif
                            
                            <form method="POST" action="{{ route('employer.jobs.destroy', $job) }}" 
                                  onsubmit="return confirm('Are you sure you want to delete this job?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                            
                            @if($job->status === 'rejected')
                                <a href="{{ route('employer.jobs.create') }}" 
                                   class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                    Create Similar
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border px-4 py-8 text-center text-gray-500">
                        No jobs posted yet. 
                        <a href="{{ route('employer.jobs.create') }}" class="text-blue-500">Create your first job</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection