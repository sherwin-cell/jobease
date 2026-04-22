@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.employer-profiles.index') }}" class="text-blue-600 hover:text-blue-900 font-semibold">← Back to Profiles</a>
    <h1 class="text-3xl font-bold text-gray-800 mt-2">Employer Profile Review</h1>
</div>

@if (session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-4">
        <p class="text-green-800">{{ session('success') }}</p>
    </div>
@endif

@if (session('error'))
    <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-4">
        <p class="text-red-800">{{ session('error') }}</p>
    </div>
@endif

<div class="grid grid-cols-3 gap-6">
    <!-- Profile Information -->
    <div class="col-span-2 space-y-6">
        <!-- Status Badge -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Status</h2>
                @if ($employerProfile->isPending())
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        Pending Review
                    </span>
                @elseif ($employerProfile->isApproved())
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        Approved
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        Rejected
                    </span>
                @endif
            </div>

            @if ($employerProfile->isApproved())
                <p class="text-sm text-gray-600">Approved on {{ $employerProfile->approved_at->format('M d, Y \a\t g:i A') }} by {{ $employerProfile->approvedByUser->name }}</p>
            @elseif ($employerProfile->isRejected())
                <div class="bg-red-50 border border-red-200 rounded p-3 mt-3">
                    <p class="text-sm font-semibold text-red-900">Rejection Reason:</p>
                    <p class="text-sm text-red-700 mt-1">{{ $employerProfile->rejection_reason }}</p>
                </div>
            @endif
        </div>

        <!-- Employer & Company Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Employer Information</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Employer Name</label>
                    <p class="text-gray-900">{{ $employerProfile->user->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="text-gray-900">{{ $employerProfile->user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Company Profile Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Company Information</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Company Name</label>
                    <p class="text-gray-900">{{ $employerProfile->company_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Location</label>
                    <p class="text-gray-900">{{ $employerProfile->location }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                    <p class="text-gray-900">{{ $employerProfile->phone }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Website</label>
                    @if ($employerProfile->website)
                        <p class="text-gray-900"><a href="{{ $employerProfile->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $employerProfile->website }}</a></p>
                    @else
                        <p class="text-gray-500">Not provided</p>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <p class="text-gray-900 whitespace-pre-line">{{ $employerProfile->description }}</p>
                </div>
            </div>
        </div>

        <!-- Business Permit -->
        @if ($employerProfile->business_permit)
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Business Permit</h2>
                <div>
                    <a href="{{ asset('storage/' . $employerProfile->business_permit) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download / View Document
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Action Panel -->
    <div class="col-span-1">
        <div class="bg-white rounded-lg shadow p-6 sticky top-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Actions</h3>

            @if ($employerProfile->isPending())
                <!-- Approve Button -->
                <form method="POST" action="{{ route('admin.employer-profiles.approve', $employerProfile) }}" class="mb-3">
                    @csrf
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Approve Profile
                    </button>
                </form>

                <!-- Reject Button -->
                <button type="button" onclick="document.getElementById('rejectModal').classList.remove('hidden')" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    Reject Profile
                </button>
            @else
                <!-- Reset Status Button -->
                <form method="POST" action="{{ route('admin.employer-profiles.reset', $employerProfile) }}" onsubmit="return confirm('Are you sure you want to reset this profile to pending status?')">
                    @csrf
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset to Pending
                    </button>
                </form>
            @endif

            <div class="mt-6 pt-6 border-t">
                <p class="text-sm text-gray-600 mb-2">Submitted: {{ $employerProfile->created_at->format('M d, Y \a\t g:i A') }}</p>
                <p class="text-sm text-gray-600">Profile ID: #{{ $employerProfile->id }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Reject Profile</h3>
        <p class="text-gray-600 mb-4">Please provide a reason for rejecting this profile. The employer will receive this feedback.</p>

        <form method="POST" action="{{ route('admin.employer-profiles.reject', $employerProfile) }}">
            @csrf
            <div class="mb-4">
                <textarea name="rejection_reason" placeholder="Enter rejection reason..." rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required></textarea>
                @error('rejection_reason')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition font-semibold">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                    Reject
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
