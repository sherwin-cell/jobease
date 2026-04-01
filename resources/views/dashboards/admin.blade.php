@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="min-h-screen p-6 bg-gray-50">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            Welcome, {{ auth()->user()->name }} 👋
        </h1>
        <p class="text-gray-500">Admin Dashboard Overview</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- Users -->
        <div class="bg-white/70 backdrop-blur-md border border-gray-200 rounded-xl p-6 shadow hover:shadow-lg transition">
            <h2 class="text-sm text-gray-500">Total Users</h2>
            <p class="text-2xl font-bold mt-2">--</p>
        </div>

        <!-- Jobs -->
        <div class="bg-white/70 backdrop-blur-md border border-gray-200 rounded-xl p-6 shadow hover:shadow-lg transition">
            <h2 class="text-sm text-gray-500">Total Jobs</h2>
            <p class="text-2xl font-bold mt-2">--</p>
        </div>

        <!-- Applications -->
        <div class="bg-white/70 backdrop-blur-md border border-gray-200 rounded-xl p-6 shadow hover:shadow-lg transition">
            <h2 class="text-sm text-gray-500">Applications</h2>
            <p class="text-2xl font-bold mt-2">--</p>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="bg-white/70 backdrop-blur-md border border-gray-200 rounded-xl p-6 shadow">

        <h2 class="text-lg font-semibold mb-4">Quick Actions</h2>

        <div class="flex flex-wrap gap-4">

            <a href="#" class="px-4 py-2 bg-black text-white rounded-lg hover:translate-y-[-2px] transition">
                Manage Users
            </a>

            <a href="#" class="px-4 py-2 bg-black text-white rounded-lg hover:translate-y-[-2px] transition">
                Manage Jobs
            </a>

            <a href="#" class="px-4 py-2 bg-black text-white rounded-lg hover:translate-y-[-2px] transition">
                View Reports
            </a>

        </div>

    </div>

</div>

@endsection