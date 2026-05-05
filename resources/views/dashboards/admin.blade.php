@extends('layouts.app')

@section('title', 'Admin Dashboard - JobEase')

@section('content')
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --success: #06d6a0;
            --warning: #ff9f1c;
            --danger: #ef476f;
            --gray-50: #f8f9fa;
            --gray-100: #f1f3f5;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
            --gray-900: #212529;
        }

        .dashboard-card {
            transition: all 0.3s ease;
            border-radius: 1rem;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -12px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tab-btn {
            position: relative;
            transition: all 0.2s ease;
        }

        .tab-btn.active {
            color: var(--primary);
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--primary);
            border-radius: 2px;
        }

        .log-entry {
            transition: all 0.2s ease;
        }

        .log-entry:hover {
            background: var(--gray-50);
            transform: translateX(4px);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tab-panel {
            animation: slideIn 0.3s ease;
        }

        /* Custom scrollbar */
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: var(--gray-100);
            border-radius: 10px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: var(--gray-400);
            border-radius: 10px;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: var(--gray-500);
        }
    </style>

    <div class="space-y-8">
        <!-- Header Section with Gradient -->
        <!-- Header Section with Gradient -->
        <div class="relative rounded-2xl bg-gradient-to-r from-[#4361ee] to-[#7209b7] text-white"
            style="overflow: visible; z-index: 100;">
            <!-- Background Pattern inside header -->
            <div class="absolute top-0 right-0 opacity-10 pointer-events-none">
                <svg width="300" height="300" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="40" stroke="white" stroke-width="2" fill="none" />
                    <circle cx="50" cy="50" r="30" stroke="white" stroke-width="2" fill="none" />
                    <circle cx="50" cy="50" r="20" stroke="white" stroke-width="2" fill="none" />
                    <circle cx="50" cy="50" r="10" stroke="white" stroke-width="2" fill="none" />
                </svg>
            </div>

            <div class="relative p-8" style="overflow: visible; z-index: 101;">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold tracking-tight">Welcome back, {{ auth()->user()->name }}!</h1>
                        <p class="mt-2 text-white/80">Here's what's happening with your job marketplace today.</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <!-- Date Card -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2 text-center">
                            <p class="text-xs text-white/60">Today's Date</p>
                            <p class="text-sm font-semibold">{{ now()->format('M d, Y') }}</p>
                        </div>

                        <!-- Profile Avatar with Info Dropdown -->
                        <div class="relative" style="z-index: 9999;">
                            <button id="profileInfoBtn"
                                class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-2 py-1 hover:bg-white/20 transition-all duration-200">
                                <div
                                    class="w-8 h-8 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Info Dropdown (No Logout) -->
                            <div id="profileInfoDropdown"
                                class="absolute right-0 mt-2 w-72 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden hidden"
                                style="z-index: 99999;">
                                <div class="p-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-purple-50">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg shadow-md">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                            <p class="text-xs text-gray-500">Administrator</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="mb-3">
                                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Email Address</p>
                                        <p class="text-sm text-gray-800 font-mono">{{ auth()->user()->email }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Account Type</p>
                                        <p class="text-sm text-gray-800">Administrator</p>
                                    </div>
                                    <div class="pt-2 border-t border-gray-100">
                                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Member Since</p>
                                        <p class="text-sm text-gray-800">{{ auth()->user()->created_at->format('F d, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid with top margin for spacing -->
        <div class="mt-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Total Users -->
                <div class="dashboard-card bg-white p-6 border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Users</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
                            <div class="flex items-center gap-1 mt-2">
                            </div>
                        </div>
                        <div class="stat-icon bg-blue-50">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Job Seekers -->
                <div class="dashboard-card bg-white p-6 border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Job Seekers</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalJobSeekers }}</p>
                            <div class="flex items-center gap-1 mt-2">
                            </div>
                        </div>
                        <div class="stat-icon bg-teal-50">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Employers -->
                <div class="dashboard-card bg-white p-6 border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Companies</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalEmployers }}</p>
                            <div class="flex items-center gap-1 mt-2">
                            </div>
                        </div>
                        <div class="stat-icon bg-indigo-50">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Jobs -->
                <div class="dashboard-card bg-white p-6 border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Jobs</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $activeJobs }}</p>
                            <div class="flex items-center gap-1 mt-2">
                            </div>
                        </div>
                        <div class="stat-icon bg-yellow-50">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Tabs Navigation -->
    <div class="border-b border-gray-200">
        <nav class="flex gap-2 md:gap-6 overflow-x-auto custom-scroll" id="tabNav">
            <button
                class="tab-btn px-4 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 transition whitespace-nowrap"
                data-tab="users">
                <span class="inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    User Management
                </span>
            </button>
            <button
                class="tab-btn px-4 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 transition whitespace-nowrap"
                data-tab="jobs">
                <span class="inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Job Postings
                </span>
            </button>
            <button
                class="tab-btn px-4 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 transition whitespace-nowrap"
                data-tab="logs">
                <span class="inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Activity Log
                </span>
            </button>
        </nav>
    </div>

    <!-- USERS PANEL -->
    <div id="usersPanel" class="tab-panel">
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">All Users</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Manage and monitor user accounts</p>
                    </div>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Search users..."
                            class="pl-9 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none w-full md:w-80">
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Company</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Joined</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 text-white flex items-center justify-center text-xs font-bold">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if($user->isEmployer() && $user->employerProfile)
                                        {{ $user->employerProfile->company_name }}
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @if($user->isEmployer())
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">🏢
                                            Employer</span>
                                    @elseif($user->isJobSeeker())
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">👤
                                            Job Seeker</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->is_banned)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">⛔
                                            Banned</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">✅
                                            Active</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        @if($user->is_banned)
                                            <form action="{{ route('admin.users.unban', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="text-green-600 hover:text-green-800 text-sm font-medium">Unban</button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.ban', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="text-orange-600 hover:text-orange-800 text-sm font-medium">Ban</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-400">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JOBS PANEL -->
    <div id="jobsPanel" class="tab-panel hidden">
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Job Listings</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Monitor all job postings across the platform</p>
                </div>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse ($jobs as $job)
                    <div class="p-6 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="text-base font-semibold text-gray-900">{{ $job->title }}</h3>
                                <div class="flex flex-wrap items-center gap-3 mt-1">
                                    <span class="text-sm text-gray-500">🏢
                                        {{ $job->employer->employerProfile->company_name ?? 'No Company' }}</span>
                                    <span class="text-sm text-gray-500">📅 Posted
                                        {{ $job->created_at->format('M d, Y') }}</span>
                                    <span class="text-sm text-gray-500">👥 {{ $job->applications_count }} applicants</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-medium {{ $job->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $job->status == 'active' ? 'Active' : 'Closed' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <p>No job postings yet</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- ACTIVITY LOG PANEL -->
    <div id="logsPanel" class="tab-panel hidden">
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Activity Timeline</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Real-time system activities and user actions</p>
                </div>
                <form action="{{ route('admin.activity-logs.cleanup') }}" method="POST"
                    onsubmit="return confirm('⚠️ Warning: This will permanently delete all orphaned activity logs. This action cannot be undone! Are you sure?')">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-3 py-1.5 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Clean Up Orphaned Logs
                    </button>
                </form>
            </div>
        </div>


        <div class="divide-y divide-gray-100 max-h-[600px] overflow-y-auto custom-scroll">
            @forelse ($logs as $log)
                <div class="p-5 log-entry">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                @if($log->action == 'User Login')
                                    <span class="text-blue-600">🔐</span>
                                @elseif($log->action == 'User Registered' || $log->action == 'New Account Created')
                                    <span class="text-green-600">✨</span>
                                @elseif($log->action == 'User Banned')
                                    <span class="text-red-600">⚠️</span>
                                @else
                                    <span class="text-gray-400">📋</span>
                                @endif
                                <p class="text-sm font-medium text-gray-900">{{ $log->action }}</p>
                            </div>
                            @if($log->description)
                                <p class="text-sm text-gray-600 mt-1">{{ $log->description }}</p>
                            @endif
                            <div class="flex items-center gap-2 mt-2">
                                <p class="text-xs text-gray-400">
                                    By
                                    @if($log->user)
                                        <span class="font-medium text-gray-600">{{ $log->user->name }}</span>
                                        @if($log->user->isEmployer() && $log->user->employerProfile)
                                            <span class="text-gray-400">({{ $log->user->employerProfile->company_name }})</span>
                                        @endif
                                    @else
                                        <span class="text-red-400">Deleted User</span>
                                    @endif
                                </p>
                                <span class="text-gray-300">•</span>
                                <p class="text-xs text-gray-400">{{ $log->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-xs text-gray-400">{{ $log->created_at->format('M d, h:i A') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="text-5xl mb-3">📭</div>
                    <p class="text-gray-500 text-sm">No activity logs found</p>
                    <p class="text-xs text-gray-400 mt-1">Activities will appear here as users interact with the system
                    </p>
                </div>
            @endforelse
        </div>
    </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.tab-btn');
            const panels = {
                users: document.getElementById('usersPanel'),
                jobs: document.getElementById('jobsPanel'),
                logs: document.getElementById('logsPanel')
            };

            function switchTab(tabId) {
                // Hide all panels
                Object.values(panels).forEach(panel => {
                    if (panel) panel.classList.add('hidden');
                });

                // Show selected panel
                if (panels[tabId]) panels[tabId].classList.remove('hidden');

                // Update active tab styling
                tabs.forEach(tab => {
                    if (tab.dataset.tab === tabId) {
                        tab.classList.add('active', 'text-blue-600');
                        tab.classList.remove('text-gray-600');
                    } else {
                        tab.classList.remove('active', 'text-blue-600');
                        tab.classList.add('text-gray-600');
                    }
                });
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const tabId = tab.dataset.tab;
                    if (tabId) switchTab(tabId);
                });
            });

            // Check URL hash for initial tab
            const hash = window.location.hash.substring(1);
            if (hash && panels[hash]) {
                switchTab(hash);
            }

            // Profile Info Dropdown (View Only)
            const profileInfoBtn = document.getElementById('profileInfoBtn');
            const profileInfoDropdown = document.getElementById('profileInfoDropdown');

            if (profileInfoBtn && profileInfoDropdown) {
                profileInfoBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    profileInfoDropdown.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', (e) => {
                    if (!profileInfoBtn.contains(e.target) && !profileInfoDropdown.contains(e.target)) {
                        profileInfoDropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
@endsection