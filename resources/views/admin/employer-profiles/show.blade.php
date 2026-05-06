@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-10 lg:py-14">
    <div class="max-w-[1600px] mx-auto px-6 sm:px-8 lg:px-12">

        <!-- Header -->
        <div class="mb-12">
            <a href="{{ route('admin.employer-profiles.index') }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Employer Profiles
            </a>

            <div class="mt-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="max-w-3xl">
                    <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight text-gray-900 leading-tight">
                        Employer Profile Review
                    </h1>
                    <p class="text-lg text-gray-500 mt-3 leading-relaxed">
                        Review employer registration details, company credentials, and verification documents before approval.
                    </p>
                </div>

                <!-- Status Badge -->
                <div>
                    @if ($employerProfile->isPending())
                        <span class="inline-flex items-center px-5 py-2.5 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800">
                            ⏳ Pending Review
                        </span>
                    @elseif ($employerProfile->isApproved())
                        <span class="inline-flex items-center px-5 py-2.5 rounded-full text-sm font-bold bg-green-100 text-green-800">
                            ✅ Approved
                        </span>
                    @else
                        <span class="inline-flex items-center px-5 py-2.5 rounded-full text-sm font-bold bg-red-100 text-red-800">
                            ❌ Rejected
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="mb-8 bg-green-50 border border-green-200 rounded-3xl p-5 shadow-sm">
                <p class="text-green-800 font-medium text-base">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-8 bg-red-50 border border-red-200 rounded-3xl p-5 shadow-sm">
                <p class="text-red-800 font-medium text-base">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Main Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-10 2xl:gap-14">

            <!-- Left Section -->
            <div class="xl:col-span-2 space-y-10">

                <!-- Employer Information -->
                <div class="bg-white rounded-[28px] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 bg-gradient-to-r from-blue-600 to-indigo-600">
                        <h2 class="text-2xl font-bold tracking-tight text-white">
                            Employer Information
                        </h2>
                    </div>

                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm uppercase tracking-wide font-semibold text-gray-500 mb-2">
                                Employer Name
                            </label>
                            <p class="text-xl lg:text-2xl font-semibold text-gray-900 leading-snug">
                                {{ $employerProfile->user->name }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm uppercase tracking-wide font-semibold text-gray-500 mb-2">
                                Email Address
                            </label>
                            <p class="text-base lg:text-lg text-gray-800 leading-relaxed break-all">
                                {{ $employerProfile->user->email }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Company Information -->
                <div class="bg-white rounded-[28px] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 bg-gradient-to-r from-gray-800 to-gray-700">
                        <h2 class="text-2xl font-bold tracking-tight text-white">
                            Company Information
                        </h2>
                    </div>

                    <div class="p-8 space-y-8">
                        <div>
                            <label class="block text-sm uppercase tracking-wide font-semibold text-gray-500 mb-2">
                                Company Name
                            </label>
                            <p class="text-xl lg:text-2xl font-semibold text-gray-900 leading-snug">
                                {{ $employerProfile->company_name }}
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-sm uppercase tracking-wide font-semibold text-gray-500 mb-2">
                                    Location
                                </label>
                                <p class="text-base lg:text-lg text-gray-800 leading-relaxed">
                                    {{ $employerProfile->location }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm uppercase tracking-wide font-semibold text-gray-500 mb-2">
                                    Phone
                                </label>
                                <p class="text-base lg:text-lg text-gray-800 leading-relaxed">
                                    {{ $employerProfile->phone }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm uppercase tracking-wide font-semibold text-gray-500 mb-2">
                                Website
                            </label>
                            @if ($employerProfile->website)
                                <a href="{{ $employerProfile->website }}" target="_blank"
                                    class="text-blue-600 hover:text-blue-800 font-semibold break-all text-base lg:text-lg">
                                    {{ $employerProfile->website }}
                                </a>
                            @else
                                <p class="text-gray-400 italic text-base">Not provided</p>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm uppercase tracking-wide font-semibold text-gray-500 mb-2">
                                Company Description
                            </label>
                            <div class="bg-gray-50 rounded-3xl p-6 border text-gray-700 text-base lg:text-lg leading-8 whitespace-pre-line">
                                {{ $employerProfile->description }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Permit -->
                @if ($employerProfile->business_permit)
                    <div class="bg-white rounded-[28px] shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-8 py-6 bg-gradient-to-r from-green-600 to-emerald-600">
                            <h2 class="text-2xl font-bold tracking-tight text-white">
                                Business Permit
                            </h2>
                        </div>

                        <div class="p-8">
                            <a href="{{ asset('storage/' . $employerProfile->business_permit) }}" target="_blank"
                                class="inline-flex items-center px-6 py-4 bg-blue-600 text-white rounded-2xl hover:bg-blue-700 transition duration-200 font-semibold text-lg shadow-sm">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                View / Download Permit
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Rejection Reason -->
                @if ($employerProfile->isRejected())
                    <div class="bg-red-50 border border-red-200 rounded-[28px] p-8">
                        <h3 class="text-2xl font-bold tracking-tight text-red-800 mb-4">
                            Rejection Reason
                        </h3>
                        <p class="text-red-700 text-lg leading-relaxed">
                            {{ $employerProfile->rejection_reason }}
                        </p>
                    </div>
                @endif

            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <div class="bg-white rounded-[28px] shadow-sm border border-gray-100 p-8 sticky top-8">

                    <h3 class="text-2xl font-bold tracking-tight text-gray-900 mb-8">
                        Admin Actions
                    </h3>

                    @if ($employerProfile->isPending())

                        <!-- Approve -->
                        <form method="POST"
                            action="{{ route('admin.employer-profiles.approve', $employerProfile) }}"
                            class="mb-4">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center px-5 py-4 bg-green-600 hover:bg-green-700 text-white rounded-2xl font-bold text-lg transition duration-200 shadow-sm">
                                ✅ Approve Profile
                            </button>
                        </form>

                        <!-- Reject -->
                        <button type="button"
                            onclick="document.getElementById('rejectModal').classList.remove('hidden')"
                            class="w-full flex items-center justify-center px-5 py-4 bg-red-600 hover:bg-red-700 text-white rounded-2xl font-bold text-lg transition duration-200 shadow-sm">
                            ❌ Reject Profile
                        </button>

                    @else

                        <!-- Reset -->
                        <form method="POST"
                            action="{{ route('admin.employer-profiles.reset', $employerProfile) }}"
                            onsubmit="return confirm('Reset this profile back to pending?')">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center px-5 py-4 bg-gray-700 hover:bg-gray-800 text-white rounded-2xl font-bold text-lg transition duration-200 shadow-sm">
                                🔄 Reset to Pending
                            </button>
                        </form>

                    @endif

                    <!-- Meta -->
                    <div class="mt-10 border-t pt-8 space-y-4 text-base text-gray-600 leading-relaxed">
                        <p>
                            <span class="font-semibold text-gray-800">Submitted:</span><br>
                            {{ $employerProfile->created_at->format('M d, Y \a\t g:i A') }}
                        </p>

                        <p>
                            <span class="font-semibold text-gray-800">Profile ID:</span><br>
                            #{{ $employerProfile->id }}
                        </p>

                        @if ($employerProfile->isApproved())
                            <p>
                                <span class="font-semibold text-gray-800">Approved By:</span><br>
                                {{ $employerProfile->approvedByUser->name }}
                            </p>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
        <div class="bg-white rounded-[30px] shadow-2xl w-full max-w-2xl p-10">
            <h3 class="text-3xl font-bold tracking-tight text-gray-900 mb-3">
                Reject Employer Profile
            </h3>

            <p class="text-lg text-gray-500 mb-8 leading-relaxed">
                Provide a clear explanation for rejection. This feedback will be sent directly to the employer.
            </p>

            <form method="POST"
                action="{{ route('admin.employer-profiles.reject', $employerProfile) }}">
                @csrf

                <textarea name="rejection_reason"
                    rows="5"
                    required
                    placeholder="Enter rejection reason..."
                    class="w-full border border-gray-300 rounded-3xl p-5 text-lg leading-relaxed focus:ring-2 focus:ring-red-500 focus:outline-none"></textarea>

                @error('rejection_reason')
                    <p class="text-red-600 text-sm mt-3">{{ $message }}</p>
                @enderror

                <div class="flex gap-4 mt-8">
                    <button type="button"
                        onclick="document.getElementById('rejectModal').classList.add('hidden')"
                        class="flex-1 px-5 py-4 bg-gray-200 hover:bg-gray-300 rounded-2xl font-semibold text-lg transition">
                        Cancel
                    </button>

                    <button type="submit"
                        class="flex-1 px-5 py-4 bg-red-600 hover:bg-red-700 text-white rounded-2xl font-bold text-lg transition">
                        Reject Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection