@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Employer Profile Approvals</h1>
    <p class="text-gray-600">Manage and review employer company profiles</p>
</div>

@if (session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-4">
        <p class="text-green-800">{{ session('success') }}</p>
    </div>
@endif

@if (session('info'))
    <div class="mb-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <p class="text-blue-800">{{ session('info') }}</p>
    </div>
@endif

<!-- Pending Profiles Section -->
<div class="mb-8">
    <div class="flex items-center mb-4">
        <svg class="w-6 h-6 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h2 class="text-2xl font-bold text-gray-800">Pending Approval ({{ $pendingProfiles->total() }})</h2>
    </div>

    @if ($pendingProfiles->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Company Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Contact Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Location</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Phone</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Submitted</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($pendingProfiles as $profile)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $profile->company_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $profile->user->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $profile->location }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $profile->phone }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $profile->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('admin.employer-profiles.show', $profile) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Review</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $pendingProfiles->links() }}
        </div>
    @else
        <div class="bg-gray-50 rounded-lg p-8 text-center">
            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-gray-600">No pending profiles to review</p>
        </div>
    @endif
</div>

<!-- Approved Profiles Section -->
<div class="mb-8">
    <div class="flex items-center mb-4">
        <svg class="w-6 h-6 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <h2 class="text-2xl font-bold text-gray-800">Approved ({{ $approvedProfiles->total() }})</h2>
    </div>

    @if ($approvedProfiles->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Company Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Contact Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Approved On</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Approved By</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($approvedProfiles as $profile)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $profile->company_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $profile->user->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $profile->approved_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $profile->approvedByUser->name ?? 'System' }}</td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('admin.employer-profiles.show', $profile) }}" class="text-blue-600 hover:text-blue-900 font-semibold">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $approvedProfiles->links() }}
        </div>
    @else
        <div class="bg-gray-50 rounded-lg p-8 text-center">
            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-gray-600">No approved profiles</p>
        </div>
    @endif
</div>
@endsection
