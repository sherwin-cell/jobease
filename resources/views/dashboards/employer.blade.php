@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
<div class="max-w-5xl mx-auto mt-8">

    <!-- Welcome Header -->
    <div class="bg-white p-6 rounded shadow mb-8 text-center">
        <h1 class="text-3xl font-bold mb-2">Welcome, {{ auth()->user()->name }}</h1>
        <p class="text-gray-600">This is your Employer Dashboard.</p>
    </div>

    <!-- Dashboard Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Edit Profile -->
        <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>
            <p class="text-gray-500 mb-4">Update your company profile, logo, and contact information.</p>
            <a href="{{ route('employer.profile.edit') }}"
               class="block bg-blue-500 hover:bg-blue-600 text-white font-semibold text-center py-2 rounded">
               Go to Profile
            </a>
        </div>

        <!-- My Jobs -->
        <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-4">My Jobs</h2>
            <p class="text-gray-500 mb-4">View, edit, or create new job postings for your company.</p>
            <a href="{{ route('employer.jobs.index') }}"
               class="block bg-green-500 hover:bg-green-600 text-white font-semibold text-center py-2 rounded">
               Manage Jobs
            </a>
        </div>

        <!-- Applications -->
        <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-4">Applications</h2>
            <p class="text-gray-500 mb-4">Review applications submitted by job seekers.</p>
            <a href="{{ route('employer.applications.index') }}"
               class="block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold text-center py-2 rounded">
               View Applications
            </a>
        </div>
    </div>
</div>
@endsection