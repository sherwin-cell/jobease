@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                <p class="mt-1 text-sm text-gray-500">Monitor and manage all system activities</p>
            </div>
            <div
                class="flex items-center gap-3 text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200 w-fit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>

        <!-- Stats Cards Grid (Responsive 4/2/1) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Total Users Card -->
            <div
                class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Users</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Job Seekers Card -->
            <div
                class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Job Seekers</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalJobSeekers }}</p>
                    </div>
                    <div class="w-12 h-12 bg-teal-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Employers Card -->
            <div
                class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Employers</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalEmployers }}</p>
                    </div>
                    <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Jobs Card -->
            <div
                class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Active Jobs</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $activeJobs }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Section (Responsive overflow) -->
        <div class="border-b border-gray-200 overflow-x-auto scrollbar-hide">
            <nav class="flex gap-8 min-w-max md:min-w-0 px-1" aria-label="Tabs">
                <button
                    class="tab-btn whitespace-nowrap py-3 px-1 text-sm font-medium border-b-2 border-blue-600 text-blue-600 transition-all"
                    data-tab="users">
                    User Management
                </button>
                <button
                    class="tab-btn whitespace-nowrap py-3 px-1 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-all"
                    data-tab="jobs">
                    Job Postings
                </button>
                <button
                    class="tab-btn whitespace-nowrap py-3 px-1 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-all"
                    data-tab="logs">
                    Activity Log
                </button>
            </nav>
        </div>

        <!-- Tab Panels -->
        <!-- USERS PANEL -->
        <div id="usersPanel" class="tab-panel">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">User Management</h2>
                    <p class="text-sm text-gray-500 mt-1">Manage job seekers and employer accounts</p>
                </div>

                <div class="w-full md:w-72 relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>

                    <input type="text" placeholder="Search by name, email or company..."
                        class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto bg-white rounded-xl border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name / Company</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Join Date</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-9 w-9 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-bold">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>

                                        <div>
                                            <p class="text-sm font-semibold">{{ $user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $user->employer->company_name ?? 'No Company' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>

                                <td class="px-6 py-4 text-sm">
                                    @if($user->role_id == 1)
                                        <span class="px-2 py-1 bg-blue-50 text-blue-700 text-xs rounded">Job Seeker</span>
                                    @elseif($user->role_id == 2)
                                        <span class="px-2 py-1 bg-indigo-50 text-indigo-700 text-xs rounded">Employer</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-sm">
                                    @if($user->is_banned)
                                        <span class="px-2 py-1 bg-red-50 text-red-700 text-xs rounded">Banned</span>
                                    @else
                                        <span class="px-2 py-1 bg-green-50 text-green-700 text-xs rounded">Active</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-400">
                                    No users found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="md:hidden space-y-4 p-4">
                @forelse ($users as $user)
                    <div class="border rounded-xl p-4 bg-white shadow-sm">

                        <div class="flex items-center gap-3">
                            <div
                                class="h-10 w-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>

                            <div>
                                <p class="font-semibold">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="mt-3 grid grid-cols-2 gap-2 text-sm">

                            <div>
                                <p class="text-xs text-gray-400">Type</p>
                                <p>
                                    {{ $user->role_id == 1 ? 'Job Seeker' : 'Employer' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-400">Status</p>
                                <p>{{ $user->is_banned ? 'Banned' : 'Active' }}</p>
                            </div>

                            <div class="col-span-2">
                                <p class="text-xs text-gray-400">Join Date</p>
                                <p>{{ $user->created_at->format('M d, Y') }}</p>
                            </div>

                        </div>

                    </div>
                @empty
                    <p class="text-center text-gray-400">No users found</p>
                @endforelse
            </div>
        </div>


        <!-- JOBS PANEL -->
        <div id="jobsPanel" class="tab-panel hidden">

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-900">Job Postings</h2>
                <p class="text-sm text-gray-500 mt-1">Manage all job listings</p>
            </div>

            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto bg-white border rounded-xl">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Job Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Company</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Applicants</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posted Date</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">

                        @forelse ($jobs as $job)
                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 font-semibold">{{ $job->title }}</td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $job->employer->employerProfile->company_name ?? 'No Company' }}
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 text-xs rounded
                                                                                        {{ $job->status == 'active' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $job->applications_count }}
                                </td>

                                <td class="px-6 py-4 text-gray-500">
                                    {{ $job->created_at->format('M d, Y') }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-400">
                                    No jobs found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Mobile Cards -->
            <div class="md:hidden space-y-4 p-4">

                @forelse ($jobs as $job)
                    <div class="border rounded-xl p-4 bg-white shadow-sm">

                        <div class="flex justify-between">
                            <div>
                                <p class="font-semibold">{{ $job->title }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ $job->employer->employerProfile->company_name ?? 'No Company' }}
                                </p>
                            </div>

                            <span
                                class="text-xs px-2 py-1 rounded
                                                                                {{ $job->status == 'active' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                {{ ucfirst($job->status) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-3 mt-3 text-sm">
                            <div>
                                <p class="text-xs text-gray-400">Applicants</p>
                                <p>{{ $job->applications_count }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-400">Posted</p>
                                <p>{{ $job->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>

                    </div>
                @empty
                    <p class="text-center text-gray-400">No jobs found</p>
                @endforelse

            </div>

        </div>
        <!-- ACTIVITY LOG PANEL -->
        <div id="logsPanel" class="tab-panel hidden">

            <!-- Activity Log Header with Cleanup Button -->
            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">System Activity Log</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Monitor recent system activities and user actions
                    </p>
                </div>

                <!-- Cleanup Button -->
                <form action="{{ route('admin.activity-logs.cleanup') }}" method="POST"
                    onsubmit="return confirm('⚠️ WARNING: This will permanently delete all orphaned activity logs (logs from deleted users). This action cannot be undone! Are you sure?')">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        🗑️ Clean Up Orphaned Logs
                    </button>
                </form>
            </div>

            <!-- Logs List -->
            <div class="bg-white border border-gray-200 rounded-xl divide-y divide-gray-100">
                @forelse ($logs as $log)
                    <div class="p-4 sm:p-5 flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-900">
                                {{ $log->action }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                By
                                @if($log->user)
                                    {{ $log->user->name }}
                                    <span class="text-gray-400">
                                        ({{ $log->user->role_id == 2 ? 'Employer' : ($log->user->role_id == 1 ? 'Job Seeker' : 'User') }})
                                    </span>
                                @else
                                    <span class="text-red-400">Deleted User (Account Removed)</span>
                                @endif
                            </p>
                            @if($log->description)
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $log->description }}
                                </p>
                            @endif
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-xs text-gray-500">
                                {{ $log->created_at->format('Y-m-d h:i A') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="text-5xl mb-3">📭</div>
                        <p class="text-gray-500 text-sm">No activity logs found</p>
                        <p class="text-xs text-gray-400 mt-1">Activities will appear here as users interact with the system</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination (if using paginate instead of limit) -->
            @if(method_exists($logs, 'hasPages') && $logs->hasPages())
                <div class="mt-6">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.tab-btn');
            const panels = {
                users: document.getElementById('usersPanel'),
                jobs: document.getElementById('jobsPanel'),
                logs: document.getElementById('logsPanel')
            };

            function activateTab(tabId) {
                // Hide all panels
                Object.values(panels).forEach(panel => {
                    if (panel) panel.classList.add('hidden');
                });
                // Show selected panel
                if (panels[tabId]) panels[tabId].classList.remove('hidden');

                // Update tab styles
                tabs.forEach(tab => {
                    const isActive = tab.dataset.tab === tabId;
                    if (isActive) {
                        tab.classList.add('border-blue-600', 'text-blue-600');
                        tab.classList.remove('border-transparent', 'text-gray-500');
                    } else {
                        tab.classList.remove('border-blue-600', 'text-blue-600');
                        tab.classList.add('border-transparent', 'text-gray-500');
                    }
                });
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const tabId = tab.dataset.tab;
                    if (tabId) activateTab(tabId);
                });
            });
        });
    </script>
@endsection