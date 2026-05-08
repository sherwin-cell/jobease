@extends('layouts.app')

@section('title', 'Admin Dashboard - JobEase')

@section('content')
<style>
    /* ===== PAGE CONTAINER ===== */
    .full-page-container {
        min-height: 100vh;
        background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
        padding: 1.5rem 0;
    }
    .content-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    @media (max-width: 640px) {
        .content-wrapper {
            padding: 0 1rem;
        }
    }

    /* ===== STATS CARDS ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.25rem;
        margin-bottom: 1.5rem;
    }
    .stat-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        padding: 1.25rem;
        transition: all 0.2s;
    }
    .stat-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.07);
        border-color: #d1d5db;
    }
    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }
    .stat-value {
        font-size: 1.875rem;
        font-weight: 700;
    }
    .stat-label {
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
    }
    .stat-icon {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ===== TAB CONTROLLER ===== */
    .tab-controller {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        overflow: hidden;
        margin-top: 1.5rem;
    }
    .tab-headers {
        display: flex;
        border-bottom: 1px solid #e5e7eb;
        background: #fff;
        padding: 0 1.25rem;
        gap: 0.5rem;
    }
    .tab-btn {
        padding: 0.875rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #6b7280;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .tab-btn.active {
        color: #2563eb;
    }
    .tab-btn.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 2px;
        background: #2563eb;
        border-radius: 2px;
    }
    .tab-btn:hover:not(.active) {
        color: #374151;
        background: #f9fafb;
    }
    .tab-content {
        display: none;
        padding: 1.5rem;
        animation: fadeIn 0.3s ease;
    }
    .tab-content.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== TABLE STYLES ===== */
    .table-wrapper {
        overflow-x: auto;
    }
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    .data-table th {
        text-align: left;
        padding: 0.75rem 1rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }
    .data-table td {
        padding: 1rem;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }
    .data-table tr:hover td {
        background: #f9fafb;
    }

    /* ===== STATUS BADGES ===== */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .status-active { background: #dcfce7; color: #15803d; }
    .status-banned { background: #fee2e2; color: #b91c1c; }
    .status-closed { background: #f3f4f6; color: #6b7280; }

    /* ===== USER AVATAR ===== */
    .user-avatar {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 600;
        color: #fff;
    }

    /* ===== ACTION BUTTONS ===== */
    .action-link {
        color: #2563eb;
        font-size: 0.813rem;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.15s;
    }
    .action-link:hover { color: #1d4ed8; text-decoration: underline; }
    .action-danger { color: #ef4444; }
    .action-danger:hover { color: #dc2626; }

    /* ===== SEARCH INPUT ===== */
    .search-wrapper {
        position: relative;
    }
    .search-input {
        width: 100%;
        padding: 0.625rem 1rem 0.625rem 2.25rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        outline: none;
        transition: all 0.15s;
    }
    .search-input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }
    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1rem;
        height: 1rem;
        color: #9ca3af;
    }

    /* ===== HEADER SECTION ===== */
    .welcome-header {
        background: linear-gradient(135deg, #2563eb 0%, #7c3aed 50%, #db2777 100%);
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    .welcome-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        transform: translate(50%, -50%);
    }
    .welcome-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 150px;
        height: 150px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
        transform: translate(-50%, 50%);
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
    }
    .empty-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    .empty-title {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.25rem;
    }
    .empty-sub {
        font-size: 0.875rem;
        color: #6b7280;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }
        .stat-value {
            font-size: 1.5rem;
        }
        .tab-headers {
            padding: 0 0.75rem;
            overflow-x: auto;
        }
        .tab-btn {
            padding: 0.75rem 1rem;
            font-size: 0.813rem;
            white-space: nowrap;
        }
        .tab-content {
            padding: 1rem;
        }
        .data-table th,
        .data-table td {
            padding: 0.75rem;
        }
    }
</style>

<div class="full-page-container">
    <div class="content-wrapper">
        <!-- Welcome Header -->
        <div class="welcome-header">
            <div class="relative" style="z-index: 10;">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Welcome back, {{ auth()->user()->name }}!</h1>
                        <p class="mt-1 text-white/80 text-sm">Here's what's happening with your job marketplace today.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2 text-center">
                            <p class="text-xs text-white/60">Today's Date</p>
                            <p class="text-sm font-semibold text-white">{{ now()->format('M d, Y') }}</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-full px-3 py-1.5">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="text-left hidden sm:block">
                                    <p class="text-xs font-medium text-white">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-white/60">Administrator</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-gray-900">{{ $totalUsers }}</div>
                    <div class="stat-icon bg-blue-100">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Total Users</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-teal-600">{{ $totalJobSeekers }}</div>
                    <div class="stat-icon bg-teal-100">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Job Seekers</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-purple-600">{{ $totalEmployers }}</div>
                    <div class="stat-icon bg-purple-100">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Companies</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-amber-600">{{ $activeJobs }}</div>
                    <div class="stat-icon bg-amber-100">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Active Jobs</div>
            </div>
        </div>

        <!-- Tab Controller -->
        <div class="tab-controller">
            <div class="tab-headers">
                <button class="tab-btn active" data-tab="users">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    User Management
                </button>
                <button class="tab-btn" data-tab="jobs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Job Postings
                </button>
                <button class="tab-btn" data-tab="logs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Activity Log
                </button>
            </div>

            <!-- Users Tab -->
            <div id="users-tab" class="tab-content active">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">All Users</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Manage and monitor user accounts</p>
                    </div>
                    <div class="search-wrapper w-full md:w-64">
                        <input type="text" id="searchUsers" placeholder="Search users..." class="search-input">
                        <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                        <span class="font-medium text-gray-900">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($user->isEmployer() && $user->employerProfile)
                                        {{ $user->employerProfile->company_name }}
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td><span class="text-gray-600">{{ $user->email }}</span></td>
                                <td>
                                    @if($user->isEmployer())
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">🏢 Employer</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">👤 Job Seeker</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_banned)
                                        <span class="status-badge status-banned">⛔ Banned</span>
                                    @else
                                        <span class="status-badge status-active">✅ Active</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>
                                    @if($user->is_banned)
                                        <form action="{{ route('admin.users.unban', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="action-link">Unban</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.users.ban', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="action-link action-danger">Ban</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center py-8 text-gray-400">No users found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Jobs Tab -->
            <div id="jobs-tab" class="tab-content">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Job Listings</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Monitor all job postings across the platform</p>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($jobs as $job)
                    <div class="py-4 first:pt-0 last:pb-0">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $job->title }}</h3>
                                <div class="flex flex-wrap items-center gap-3 mt-1">
                                    <span class="text-sm text-gray-500">🏢 {{ $job->employer->employerProfile->company_name ?? 'No Company' }}</span>
                                    <span class="text-sm text-gray-500">📅 Posted {{ $job->created_at->format('M d, Y') }}</span>
                                    <span class="text-sm text-gray-500">👥 {{ $job->applications_count }} applicants</span>
                                </div>
                            </div>
                            <div>
                                <span class="status-badge {{ $job->status == 'active' ? 'status-active' : 'status-closed' }}">
                                    {{ $job->status == 'active' ? 'Active' : 'Closed' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <div class="empty-icon">📭</div>
                        <div class="empty-title">No job postings yet</div>
                        <p class="empty-sub">Jobs will appear here as employers create them</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Activity Log Tab -->
            <div id="logs-tab" class="tab-content">
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Activity Timeline</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Real-time system activities and user actions</p>
                    </div>
                    <form action="{{ route('admin.activity-logs.cleanup') }}" method="POST"
                        onsubmit="return confirm('⚠️ Warning: This will permanently delete all orphaned activity logs. This action cannot be undone! Are you sure?')">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Clean Up Orphaned Logs
                        </button>
                    </form>
                </div>

                <div class="divide-y divide-gray-100 max-h-[500px] overflow-y-auto">
                    @forelse ($logs as $log)
                    <div class="py-4 first:pt-0 last:pb-0 hover:bg-gray-50 -mx-4 px-4 transition">
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
                    <div class="empty-state">
                        <div class="empty-icon">📭</div>
                        <div class="empty-title">No activity logs found</div>
                        <p class="empty-sub">Activities will appear here as users interact with the system</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-btn');
        const contents = {
            users: document.getElementById('users-tab'),
            jobs: document.getElementById('jobs-tab'),
            logs: document.getElementById('logs-tab')
        };

        function switchTab(tabId) {
            Object.values(contents).forEach(content => {
                if (content) content.classList.remove('active');
            });
            tabs.forEach(btn => btn.classList.remove('active'));
            
            if (contents[tabId]) contents[tabId].classList.add('active');
            const activeBtn = Array.from(tabs).find(btn => btn.dataset.tab === tabId);
            if (activeBtn) activeBtn.classList.add('active');
            
            localStorage.setItem('adminActiveTab', tabId);
        }

        tabs.forEach(btn => {
            btn.addEventListener('click', () => {
                const tabId = btn.dataset.tab;
                if (tabId) switchTab(tabId);
            });
        });

        const savedTab = localStorage.getItem('adminActiveTab');
        if (savedTab && contents[savedTab]) {
            switchTab(savedTab);
        }

        // Search functionality
        const searchInput = document.getElementById('searchUsers');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('#users-tab tbody tr');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        }
    });
</script>
@endsection