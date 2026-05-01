@extends('layouts.app')

@section('title', 'Job Seeker Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Your Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500">
                Welcome back, <strong class="text-gray-900">{{ auth()->user()->name }}</strong>. Your next opportunity awaits!
            </p>
        </div>
        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
            {{ now()->format('l, F j, Y') }}
        </div>
    </div>

    <!-- Profile Completion Banner -->
    <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-2xl border border-purple-100 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-start gap-3">
                <div class="text-3xl">⭐</div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Complete your profile</h2>
                    <p class="text-sm text-gray-600 mt-1">A complete profile increases your chances of getting hired by 40%</p>
                </div>
            </div>
            <a href="{{ route('jobseeker.profile.show') }}" 
                class="inline-flex items-center justify-center bg-purple-600 text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-purple-700 transition-all shadow-md hover:shadow-lg">
                Complete Profile →
            </a>
        </div>
    </div>

    <!-- Action Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Browse Jobs -->
        <a href="{{ route('jobseeker.jobs.index') }}" 
            class="group bg-white rounded-2xl border border-gray-200 p-6 hover:border-blue-300 hover:shadow-xl transition-all duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="text-lg font-semibold text-gray-900">Browse Jobs</div>
                <div class="text-3xl">💼</div>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed">
                Discover thousands of job opportunities that match your skills and career goals.
            </p>
            <div class="mt-5 text-sm font-semibold text-blue-600 group-hover:text-blue-700 group-hover:translate-x-1 transition-all">
                Find your next role →
            </div>
        </a>

        <!-- My Applications -->
        <a href="{{ route('jobseeker.applications.index') }}" 
            class="group bg-white rounded-2xl border border-gray-200 p-6 hover:border-blue-300 hover:shadow-xl transition-all duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="text-lg font-semibold text-gray-900">Applications</div>
                <div class="text-3xl">📋</div>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed">
                Track your submitted applications, view status updates, and manage your job search.
            </p>
            <div class="mt-5 text-sm font-semibold text-blue-600 group-hover:text-blue-700 group-hover:translate-x-1 transition-all">
                Track applications →
            </div>
        </a>

        <!-- My Profile -->
        <a href="{{ route('jobseeker.profile.show') }}" 
            class="group bg-white rounded-2xl border border-gray-200 p-6 hover:border-blue-300 hover:shadow-xl transition-all duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="text-lg font-semibold text-gray-900">My Profile</div>
                <div class="text-3xl">👤</div>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed">
                Update your personal information, resume, work experience, and skills.
            </p>
            <div class="mt-5 text-sm font-semibold text-blue-600 group-hover:text-blue-700 group-hover:translate-x-1 transition-all">
                Update profile →
            </div>
        </a>
    </div>

    <!-- Quick Stats -->
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Quick Stats</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600">{{ $applicationsCount ?? 0 }}</div>
                    <div class="text-sm text-gray-500 mt-1">Applications Sent</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-600">{{ $profileViews ?? 0 }}</div>
                    <div class="text-sm text-gray-500 mt-1">Profile Views</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection