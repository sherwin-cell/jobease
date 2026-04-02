@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
<div class="flex min-h-screen bg-gray-50">

    <!-- Sidebar (Job Seeker Style) -->
    <aside class="w-64 bg-white shadow-lg hidden md:block">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-blue-600 mb-8">Employer Panel</h2>
            <nav class="space-y-4">
                <a href="{{ route('employer.dashboard') }}" 
                   class="flex items-center px-4 py-2 rounded hover:bg-blue-100 transition">
                   <span class="mr-3 text-blue-500">🏠</span>
                   Dashboard
                </a>
                <a href="{{ route('employer.profile.edit') }}" 
                   class="flex items-center px-4 py-2 rounded hover:bg-blue-100 transition">
                   <span class="mr-3 text-blue-500">✏️</span>
                   Edit Profile
                </a>
                <a href="{{ route('employer.jobs.index') }}" 
                   class="flex items-center px-4 py-2 rounded hover:bg-blue-100 transition">
                   <span class="mr-3 text-green-500">💼</span>
                   My Jobs
                </a>
                <a href="{{ route('employer.applications.index') }}" 
                   class="flex items-center px-4 py-2 rounded hover:bg-blue-100 transition">
                   <span class="mr-3 text-yellow-500">📋</span>
                   Applications
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <!-- Welcome Header -->
        <div class="flex items-start justify-between gap-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Welcome back, {{ auth()->user()->name }}. Here’s what’s happening today.
                </p>
            </div>
            <div class="text-sm text-gray-500">
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-3">
            <a href="{{ route('employer.profile.edit') }}"
                class="group rounded-2xl border border-gray-200 bg-white p-6 hover:border-blue-200 hover:shadow-sm transition">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-semibold text-gray-900">Edit Profile</div>
                    <div class="text-lg">✏️</div>
                </div>
                <p class="mt-2 text-sm text-gray-600">
                    Update your company profile, logo, and contact information.
                </p>
                <div class="mt-4 text-sm font-semibold text-blue-700 group-hover:text-blue-800">
                    Go to Profile →
                </div>
            </a>

            <a href="{{ route('employer.jobs.index') }}"
                class="group rounded-2xl border border-gray-200 bg-white p-6 hover:border-green-200 hover:shadow-sm transition">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-semibold text-gray-900">My Jobs</div>
                    <div class="text-lg">💼</div>
                </div>
                <p class="mt-2 text-sm text-gray-600">
                    View, edit, or create new job postings for your company.
                </p>
                <div class="mt-4 text-sm font-semibold text-green-700 group-hover:text-green-800">
                    Manage Jobs →
                </div>
            </a>

            <a href="{{ route('employer.applications.index') }}"
                class="group rounded-2xl border border-gray-200 bg-white p-6 hover:border-yellow-200 hover:shadow-sm transition">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-semibold text-gray-900">Applications</div>
                    <div class="text-lg">📋</div>
                </div>
                <p class="mt-2 text-sm text-gray-600">
                    Review applications submitted by job seekers.
                </p>
                <div class="mt-4 text-sm font-semibold text-yellow-700 group-hover:text-yellow-800">
                    View Applications →
                </div>
            </a>
        </div>
    </main>
</div>
@endsection