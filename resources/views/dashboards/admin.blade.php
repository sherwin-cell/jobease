@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500">Welcome back, {{ auth()->user()->name }}.</p>
        </div>
        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
            {{ now()->format('l, F j, Y') }}
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers ?? '--' }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">👥</span>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <span class="text-xs text-gray-400">Active accounts</span>
            </div>
        </div>

        <!-- Total Jobs -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Jobs</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalJobs ?? '--' }}</p>
                </div>
                <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">💼</span>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <span class="text-xs text-gray-400">Posted positions</span>
            </div>
        </div>

        <!-- Total Applications -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Applications</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalApplications ?? '--' }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">📋</span>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <span class="text-xs text-gray-400">Total submissions</span>
            </div>
        </div>

        <!-- Banned Users -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Banned Users</p>
                    <p class="text-3xl font-bold text-red-600 mt-2">{{ $bannedUsers ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">🚫</span>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <span class="text-xs text-gray-400">Restricted accounts</span>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl border border-blue-100 p-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center text-white text-xl">💡</div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Quick Tips</h2>
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                        Use the sidebar to manage users, review jobs, and view reports. Monitor platform activity from this central dashboard.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 p-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-purple-500 rounded-xl flex items-center justify-center text-white text-xl">⚙️</div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Moderation</h2>
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                        Banned users are excluded from the dashboard totals. Review reported content regularly to maintain platform quality.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection