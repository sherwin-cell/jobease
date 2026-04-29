@extends('layouts.standalone')

@section('title', 'Profile Pending Approval')

@section('content')
    <div x-data="{ showSidebar: false }" class="w-full max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8">

        <!-- HEADER -->
        <div class="text-center mb-6">
            <div class="flex justify-center mb-4">
                <svg class="w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                Profile Under Review
            </h1>

            <p class="text-gray-600">
                Thank you for completing your company profile! Your profile is now under review by our admin team.
            </p>
        </div>

        <!-- STATUS BOX -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <p class="text-sm text-yellow-700">
                <strong>Your profile status:</strong>
                <span class="font-bold">PENDING APPROVAL</span>
            </p>

            <p class="text-sm text-yellow-700 mt-2">
                We typically review profiles within 24-48 hours. You'll receive an email once approved or if we need more
                information.
            </p>
        </div>

        <!-- STEPS -->
        <div class="space-y-4 mb-8">

            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="font-semibold text-gray-800">Profile Submitted</h3>
                <p class="text-sm text-gray-600">
                    Your company profile has been successfully submitted for verification.
                </p>
            </div>

            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="font-semibold text-gray-800">Under Review</h3>
                <p class="text-sm text-gray-600">
                    Our team is currently verifying your business information and documents.
                </p>
            </div>

            <div class="border border-gray-200 rounded-lg p-4 opacity-50">
                <h3 class="font-semibold text-gray-800">Approved & Access Dashboard</h3>
                <p class="text-sm text-gray-600">
                    Once approved, you'll be able to post jobs and manage applications.
                </p>
            </div>

        </div>

        <!-- NEXT STEPS -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
            <h3 class="font-semibold text-blue-900 mb-2">What happens next?</h3>

            <ul class="text-sm text-blue-800 space-y-1 list-disc list-inside">
                <li>Your profile will be reviewed by our admin team</li>
                <li>We’ll verify your business information and documents</li>
                <li>You’ll receive an email with the decision</li>
                <li>If approved, you can start posting jobs</li>
                <li>If needed, we’ll request additional information</li>
            </ul>
        </div>

        <!-- BUTTON (HIDES SIDEBAR ON CLICK) -->
        <div class="text-center">
            <a href="{{ route('employer.profile.edit') }}" @click="showSidebar = false"
                class="inline-flex items-center px-6 py-2 text-blue-600 font-semibold hover:text-blue-800 transition">

                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>

                Review Your Profile
            </a>
        </div>

        <!-- SUPPORT -->
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>
                Questions?
                <a href="mailto:support@jobease.com" class="text-blue-600 hover:underline">
                    support@jobease.com
                </a>
            </p>
        </div>

    </div>
@endsection