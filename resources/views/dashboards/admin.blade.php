@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-8">

    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500">Welcome back, {{ auth()->user()->name }}.</p>
        </div>
        <div class="text-sm text-gray-500">
            {{ now()->format('l, F j, Y') }}
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow transition">
            <h2 class="text-sm text-gray-500">Total Users</h2>
            <p class="text-2xl font-bold mt-2">{{ $totalUsers ?? '--' }}</p>
        </div>

        <!-- Total Jobs -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow transition">
            <h2 class="text-sm text-gray-500">Total Jobs</h2>
            <p class="text-2xl font-bold mt-2">{{ $totalJobs ?? '--' }}</p>
        </div>

        <!-- Total Applications -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow transition">
            <h2 class="text-sm text-gray-500">Applications</h2>
            <p class="text-2xl font-bold mt-2">{{ $totalApplications ?? '--' }}</p>
        </div>

        <!-- Banned Users -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow transition">
            <h2 class="text-sm text-gray-500">Banned Users</h2>
            <p class="text-2xl font-bold mt-2 text-red-600">{{ $bannedUsers ?? 0 }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="text-sm font-semibold text-gray-700">Quick Tips</h2>
            <p class="mt-2 text-sm text-gray-600">
                Use the sidebar to manage users, review jobs, and view reports.
            </p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="text-sm font-semibold text-gray-700">Moderation</h2>
            <p class="mt-2 text-sm text-gray-600">
                Banned users are excluded from the dashboard totals.
            </p>
        </div>
    </div>
</div>

@endsection