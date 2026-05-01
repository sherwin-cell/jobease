@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Employer Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500">
                Welcome back, {{ auth()->user()->name }}. Here's what's happening with your recruitment.
            </p>
        </div>
        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
            {{ now()->format('l, F j, Y') }}
        </div>
    </div>

    <!-- Post Job Banner -->
    <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-6 text-white shadow-lg">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold">Post your next role</h2>
                <p class="mt-1 text-blue-100">Create a job post and start receiving qualified applications.</p>
            </div>
            <a href="{{ route('employer.jobs.create') }}"
                class="inline-flex items-center justify-center bg-white text-blue-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-300 shadow-md hover:shadow-xl">
                ✨ Create Job Posting
            </a>
        </div>
    </div>

    <!-- Quick Actions Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- My Jobs Card -->
        <a href="{{ route('employer.jobs.index') }}"
            class="group bg-white rounded-2xl border border-gray-200 p-6 hover:border-blue-300 hover:shadow-xl transition-all duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="text-lg font-semibold text-gray-900">My Jobs</div>
                <div class="text-3xl">💼</div>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed">
                View, edit, or create new job postings for your company. Track performance and manage listings.
            </p>
            <div class="mt-5 text-sm font-semibold text-blue-600 group-hover:text-blue-700 group-hover:translate-x-1 transition-all">
                Manage jobs →
            </div>
        </a>

        <!-- Applications Card -->
        <a href="{{ route('employer.applications.index') }}"
            class="group bg-white rounded-2xl border border-gray-200 p-6 hover:border-blue-300 hover:shadow-xl transition-all duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="text-lg font-semibold text-gray-900">Applications</div>
                <div class="text-3xl">📋</div>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed">
                Review and manage applications submitted by job seekers. Shortlist candidates and schedule interviews.
            </p>
            <div class="mt-5 text-sm font-semibold text-blue-600 group-hover:text-blue-700 group-hover:translate-x-1 transition-all">
                View applications →
            </div>
        </a>

        <!-- Edit Profile Card -->
        <a href="{{ route('employer.profile.edit') }}"
            class="group bg-white rounded-2xl border border-gray-200 p-6 hover:border-blue-300 hover:shadow-xl transition-all duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="text-lg font-semibold text-gray-900">Company Profile</div>
                <div class="text-3xl">🏢</div>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed">
                Update your company profile, logo, and contact information. Make your brand stand out to candidates.
            </p>
            <div class="mt-5 text-sm font-semibold text-blue-600 group-hover:text-blue-700 group-hover:translate-x-1 transition-all">
                Edit profile →
            </div>
        </a>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
            <p class="text-sm text-gray-500 mt-1">Latest updates on your jobs and applications</p>
        </div>
        <div class="p-6 text-center">
            <div class="py-8">
                <div class="text-5xl mb-3">📭</div>
                <p class="text-gray-500">No recent activity to show</p>
                <p class="text-sm text-gray-400 mt-1">Activities will appear here once you start receiving applications</p>
            </div>
        </div>
    </div>
</div>
@endsection