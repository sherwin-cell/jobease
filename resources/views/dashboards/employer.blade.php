@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')

<div class="px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 sm:gap-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="mt-1 text-xs sm:text-sm text-gray-500">
                Welcome back, {{ auth()->user()->name }}. Here’s what’s happening today.
            </p>
        </div>
        <div class="text-xs sm:text-sm text-gray-500">
            {{ now()->format('l, F j, Y') }}
        </div>
    </div>

    <!-- Post Job Card -->
    <div class="mt-4 sm:mt-6 rounded-2xl border border-gray-200 bg-white p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
                <h2 class="text-base sm:text-lg font-semibold text-gray-900">
                    Post your next role
                </h2>
                <p class="mt-1 text-xs sm:text-sm text-gray-600">
                    Create a job post and start receiving applications.
                </p>
            </div>
            <a href="{{ route('employer.jobs.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition w-full sm:w-auto">
                Create Job
            </a>
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="mt-4 sm:mt-6 grid grid-cols-1 gap-3 sm:gap-4 md:grid-cols-3">
        
        <!-- My Jobs Card -->
        <a href="{{ route('employer.jobs.index') }}"
            class="group rounded-2xl border border-gray-200 bg-white p-4 sm:p-6 hover:border-blue-200 hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold text-gray-900">My Jobs</div>
                <div class="text-xl sm:text-2xl">💼</div>
            </div>
            <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-gray-600">
                View, edit, or create new job postings for your company.
            </p>
            <div class="mt-3 sm:mt-4 text-xs sm:text-sm font-semibold text-blue-700 group-hover:text-blue-800">
                Manage jobs →
            </div>
        </a>

        <!-- Applications Card -->
        <a href="{{ route('employer.applications.index') }}"
            class="group rounded-2xl border border-gray-200 bg-white p-4 sm:p-6 hover:border-blue-200 hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold text-gray-900">Applications</div>
                <div class="text-xl sm:text-2xl">📋</div>
            </div>
            <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-gray-600">
                Review applications submitted by job seekers.
            </p>
            <div class="mt-3 sm:mt-4 text-xs sm:text-sm font-semibold text-blue-700 group-hover:text-blue-800">
                View applications →
            </div>
        </a>

        <!-- Edit Profile Card -->
        <a href="{{ route('employer.profile.edit') }}"
            class="group rounded-2xl border border-gray-200 bg-white p-4 sm:p-6 hover:border-blue-200 hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold text-gray-900">Edit Profile</div>
                <div class="text-xl sm:text-2xl">✏️</div>
            </div>
            <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-gray-600">
                Update your company profile, logo, and contact information.
            </p>
            <div class="mt-3 sm:mt-4 text-xs sm:text-sm font-semibold text-blue-700 group-hover:text-blue-800">
                Edit profile →
            </div>
        </a>
    </div>

    <!-- Optional: Recent Activity Section for Mobile -->
    <div class="mt-6 sm:mt-8">
        <div class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-6">
            <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3 sm:mb-4">Recent Activity</h3>
            <p class="text-xs sm:text-sm text-gray-500 text-center py-4">
                No recent activity to show.
            </p>
        </div>
    </div>
</div>

@endsection

<!-- Add this to your layouts/app.blade.php inside <head> for better mobile viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">