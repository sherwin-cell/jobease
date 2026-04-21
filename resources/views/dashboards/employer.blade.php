@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')

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

    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-6">
        <div class="flex items-start justify-between gap-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">
                    Post your next role
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Create a job post and start receiving applications.
                </p>
            </div>
            <a href="{{ route('employer.jobs.create') }}"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
                Create Job
            </a>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-3">
        <a href="{{ route('employer.jobs.index') }}"
            class="group rounded-2xl border border-gray-200 bg-white p-6 hover:border-blue-200 hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold text-gray-900">My Jobs</div>
                <div class="text-lg">💼</div>
            </div>
            <p class="mt-2 text-sm text-gray-600">
                View, edit, or create new job postings for your company.
            </p>
            <div class="mt-4 text-sm font-semibold text-blue-700 group-hover:text-blue-800">
                Manage jobs →
            </div>
        </a>

        <a href="{{ route('employer.applications.index') }}"
            class="group rounded-2xl border border-gray-200 bg-white p-6 hover:border-blue-200 hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold text-gray-900">Applications</div>
                <div class="text-lg">📋</div>
            </div>
            <p class="mt-2 text-sm text-gray-600">
                Review applications submitted by job seekers.
            </p>
            <div class="mt-4 text-sm font-semibold text-blue-700 group-hover:text-blue-800">
                View applications →
            </div>
        </a>

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
                Edit profile →
            </div>
        </a>
    </div>

@endsection