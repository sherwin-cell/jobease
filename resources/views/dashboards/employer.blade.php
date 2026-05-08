@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
<style>
    /* ===== PAGE HEADER ===== */
    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }
    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 4px;
        line-height: 1.2;
    }
    .page-sub {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0;
    }

    /* ===== BUTTONS ===== */
    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #2563eb;
        color: #fff;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 9px 18px;
        border-radius: 10px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background 0.15s, transform 0.1s;
        white-space: nowrap;
        gap: 6px;
    }
    .btn-primary:hover { background: #1d4ed8; transform: translateY(-1px); }

    .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fff;
        color: #2563eb;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 9px 18px;
        border-radius: 10px;
        border: 1.5px solid #2563eb;
        text-decoration: none;
        transition: background 0.15s;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .btn-outline:hover { background: #eff6ff; }

    .btn-ghost {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        color: #374151;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 9px 18px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.15s;
        white-space: nowrap;
    }
    .btn-ghost:hover { background: #f9fafb; }

    /* ===== STATS CARDS ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    .stat-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 16px;
        transition: box-shadow 0.15s, border-color 0.15s;
    }
    .stat-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.07);
        border-color: #d1d5db;
    }
    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
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
    .stat-sub {
        font-size: 0.6875rem;
        color: #9ca3af;
        margin-top: 4px;
    }
    .stat-icon {
        width: 32px;
        height: 32px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ===== QUICK ACTION BANNER ===== */
    .quick-action {
        background: linear-gradient(135deg, #eff6ff 0%, #f5f3ff 100%);
        border: 1px solid #e0e7ff;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }
    .quick-action-content {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .quick-action-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .quick-action-title {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
        margin: 0 0 4px;
    }
    .quick-action-desc {
        font-size: 0.8125rem;
        color: #6b7280;
        margin: 0;
    }

    /* ===== TAB CONTROLLER ===== */
    .tab-controller {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        overflow: hidden;
    }
    .tab-headers {
        display: flex;
        border-bottom: 1px solid #e5e7eb;
        background: #fff;
        padding: 0 20px;
    }
    .tab-btn {
        padding: 14px 20px;
        font-size: 0.875rem;
        font-weight: 600;
        color: #6b7280;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
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
        padding: 24px;
    }
    .tab-content.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== SEARCH BAR ===== */
    .search-wrapper {
        position: relative;
    }
    .search-input {
        width: 100%;
        padding: 10px 16px 10px 40px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 0.875rem;
        outline: none;
        transition: all 0.15s;
    }
    .search-input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.08);
    }
    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: #9ca3af;
    }

    /* ===== JOB CARD ===== */
    .job-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 12px;
        transition: all 0.2s;
    }
    .job-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.07);
        border-color: #d1d5db;
        transform: translateY(-2px);
    }
    .job-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 12px;
    }
    .job-title {
        font-size: 1.0625rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 4px;
    }
    .job-title a {
        color: inherit;
        text-decoration: none;
    }
    .job-title a:hover { color: #2563eb; }
    .job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 12px;
    }
    .job-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.75rem;
        color: #6b7280;
    }
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 0.6875rem;
        font-weight: 600;
    }
    .status-active { background: #dcfce7; color: #15803d; }
    .status-pending { background: #fef9c3; color: #a16207; }
    .status-closed { background: #fee2e2; color: #b91c1c; }

    /* ===== APPLICATIONS TABLE ===== */
    .table-wrapper {
        overflow-x: auto;
    }
    .applications-table {
        width: 100%;
        border-collapse: collapse;
    }
    .applications-table th {
        text-align: left;
        padding: 12px 16px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }
    .applications-table td {
        padding: 16px;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
    }
    .applications-table tr:hover td {
        background: #f9fafb;
    }
    .candidate-name {
        font-weight: 600;
        color: #111827;
        margin: 0 0 2px;
    }
    .candidate-email {
        font-size: 0.75rem;
        color: #9ca3af;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 48px 24px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
    }
    .empty-icon {
        width: 64px;
        height: 64px;
        background: #f3f4f6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 2rem;
    }
    .empty-title {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 4px;
    }
    .empty-sub {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 20px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .stat-value {
            font-size: 1.5rem;
        }
        .quick-action {
            flex-direction: column;
            text-align: center;
        }
        .quick-action-content {
            flex-direction: column;
            text-align: center;
        }
        .tab-headers {
            padding: 0 12px;
        }
        .tab-btn {
            padding: 12px 16px;
            font-size: 0.813rem;
        }
        .tab-content {
            padding: 16px;
        }
        .job-header {
            flex-direction: column;
        }
    }
</style>

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Employer Dashboard</h1>
                <p class="page-sub">Welcome back, <strong class="text-gray-900">{{ auth()->user()->name }}</strong>. Here's what's happening with your recruitment.</p>
            </div>
            <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>

        <!-- Quick Action Banner -->
        <div class="quick-action">
            <div class="quick-action-content">
                <div class="quick-action-icon">✨</div>
                <div>
                    <h2 class="quick-action-title">Post your next role</h2>
                    <p class="quick-action-desc">Create a job post and start receiving qualified applications.</p>
                </div>
            </div>
            <a href="{{ route('employer.jobs.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create Job Posting
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-blue-600">{{ $activeJobs ?? 0 }}</div>
                    <div class="stat-icon bg-blue-100">💼</div>
                </div>
                <div class="stat-label">Active Jobs</div>
                <div class="stat-sub">{{ $activeJobs ?? 0 }} active listings</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-green-600">{{ $totalApplicants ?? 0 }}</div>
                    <div class="stat-icon bg-green-100">📋</div>
                </div>
                <div class="stat-label">Total Applicants</div>
                <div class="stat-sub">+{{ $applicantsThisMonth ?? 0 }} this month</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-amber-600">{{ $shortlisted ?? 0 }}</div>
                    <div class="stat-icon bg-amber-100">⭐</div>
                </div>
                <div class="stat-label">Shortlisted</div>
                <div class="stat-sub">Across all jobs</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-purple-600">{{ $interviews ?? 0 }}</div>
                    <div class="stat-icon bg-purple-100">🎯</div>
                </div>
                <div class="stat-label">Interviews</div>
                <div class="stat-sub">Scheduled</div>
            </div>
        </div>

        <!-- Tab Controller -->
        <div class="tab-controller">
            <div class="tab-headers">
                <button class="tab-btn active" data-tab="jobs">💼 Job Postings</button>
                <button class="tab-btn" data-tab="applications">📋 Applicants</button>
            </div>

            <!-- Jobs Tab -->
            <div id="jobs-tab" class="tab-content active">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Your Job Postings</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Manage and track your active job listings</p>
                    </div>
                    <div class="search-wrapper w-full sm:w-64">
                        <input type="text" id="search-jobs" placeholder="Search jobs..." class="search-input">
                        <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <div id="jobs-list">
                    @forelse($jobs ?? [] as $job)
                    <div class="job-card">
                        <div class="job-header">
                            <div>
                                <h3 class="job-title">
                                    <a href="{{ route('employer.jobs.show', $job) }}">{{ $job->title }}</a>
                                </h3>
                                <div class="job-meta">
                                    <span class="job-meta-item">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $job->location }}
                                    </span>
                                    <span class="job-meta-item">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        {{ ucfirst($job->experience_level ?? 'Any') }}
                                    </span>
                                    <span class="job-meta-item">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Posted {{ $job->created_at->diffForHumans() }}
                                    </span>
                                    <span class="job-meta-item">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        {{ $job->applications_count ?? 0 }} applicants
                                    </span>
                                </div>
                            </div>
                            @php
                                $statusClass = match($job->status) {
                                    'active' => 'status-active',
                                    'pending' => 'status-pending',
                                    default => 'status-closed'
                                };
                            @endphp
                            <span class="status-badge {{ $statusClass }}">{{ ucfirst($job->status) }}</span>
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('employer.jobs.show', $job) }}" class="btn-ghost text-sm">
                                View Details →
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <div class="empty-icon">📭</div>
                        <div class="empty-title">No job postings yet</div>
                        <p class="empty-sub">Create your first job posting to start receiving applications</p>
                        <a href="{{ route('employer.jobs.create') }}" class="btn-primary">Create Job Posting</a>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Applications Tab -->
            <div id="applications-tab" class="tab-content">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Recent Applications</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Review and manage applications from candidates</p>
                </div>

                <div class="table-wrapper">
                    <table class="applications-table">
                        <thead>
                            <tr>
                                <th>Candidate</th>
                                <th>Job Title</th>
                                <th>Applied On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentApplications ?? [] as $application)
                            <tr>
                                <td>
                                    <div class="candidate-name">{{ $application->user->name ?? 'N/A' }}</div>
                                    <div class="candidate-email">{{ $application->user->email ?? 'N/A' }}</div>
                                </td>
                                <td>{{ $application->job->title ?? 'N/A' }}</td>
                                <td>{{ $application->created_at->format('M d, Y') }}</td>
                                <td>
                                    @php
                                        $appColors = [
                                            'pending' => 'status-pending',
                                            'reviewing' => 'status-pending',
                                            'shortlisted' => 'status-active',
                                            'interview' => 'status-active',
                                            'interview_scheduled' => 'status-active',
                                            'rejected' => 'status-closed',
                                        ];
                                    @endphp
                                    <span class="status-badge {{ $appColors[$application->status] ?? 'status-pending' }}">
                                        {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('employer.applications.show', $application) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                        Review →
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-12 text-gray-500">
                                    <div class="text-6xl mb-4">📭</div>
                                    <p>No applications yet</p>
                                    <p class="text-sm mt-1">Applications will appear here once candidates start applying</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Tab switching
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    function switchTab(tabId) {
        tabContents.forEach(content => content.classList.remove('active'));
        tabBtns.forEach(btn => btn.classList.remove('active'));
        
        document.getElementById(tabId + '-tab').classList.add('active');
        document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
    }
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => switchTab(btn.dataset.tab));
    });
    
    // Search functionality
    const searchInput = document.getElementById('search-jobs');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const jobCards = document.querySelectorAll('.job-card');
            
            jobCards.forEach(card => {
                const title = card.querySelector('.job-title')?.textContent.toLowerCase() || '';
                if (title.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
</script>
@endsection