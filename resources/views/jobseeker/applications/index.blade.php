@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
<style>
    /* ===== FULL PAGE CONTAINER ===== */
    .full-page-container {
        min-height: 100vh;
        background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
        padding: 1.5rem;
    }
    .content-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0;
    }
    @media (max-width: 640px) {
        .full-page-container {
            padding: 1rem;
        }
    }

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
    }
    .btn-primary:hover { background: #1d4ed8; transform: translateY(-1px); }

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
    .stat-icon {
        width: 32px;
        height: 32px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ===== APPLICATION CARD ===== */
    .application-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        margin-bottom: 12px;
        transition: box-shadow 0.15s, border-color 0.15s;
        overflow: hidden;
    }
    .application-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.07);
        border-color: #d1d5db;
    }
    .application-card-inner {
        padding: 20px;
    }
    .application-main {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    @media (min-width: 640px) {
        .application-main {
            flex-direction: row;
            align-items: flex-start;
            justify-content: space-between;
        }
    }
    .job-info {
        flex: 1;
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
        align-items: center;
        gap: 12px;
        margin-top: 8px;
    }
    .meta-item {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.75rem;
        color: #6b7280;
    }
    .meta-icon {
        width: 14px;
        height: 14px;
    }
    .action-area {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    @media (min-width: 640px) {
        .action-area {
            flex-direction: row;
            align-items: center;
        }
    }

    /* ===== STATUS BADGES ===== */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    .status-pending { background: #fef9c3; color: #a16207; }
    .status-reviewing { background: #dbeafe; color: #1d4ed8; }
    .status-accepted { background: #dcfce7; color: #15803d; }
    .status-rejected { background: #fee2e2; color: #b91c1c; }
    .status-interview { background: #f3e8ff; color: #6b21a5; }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 999px;
    }
    .status-pending .status-dot { background: #a16207; }
    .status-reviewing .status-dot { background: #1d4ed8; }
    .status-accepted .status-dot { background: #15803d; }
    .status-rejected .status-dot { background: #b91c1c; }
    .status-interview .status-dot { background: #6b21a5; }

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
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }
    .empty-icon svg {
        width: 32px;
        height: 32px;
        color: #9ca3af;
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

    /* ===== FEEDBACK SECTION ===== */
    .feedback-section {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #f3f4f6;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }
    .feedback-text {
        font-size: 0.875rem;
        color: #6b7280;
    }

    /* ===== PAGINATION ===== */
    .pagination-wrap {
        margin-top: 24px;
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
        .application-card-inner {
            padding: 16px;
        }
    }
</style>

<div class="full-page-container">
    <div class="content-wrapper">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">My Applications</h1>
                <p class="page-sub">Track and manage all your job applications in one place</p>
            </div>
            <a href="{{ route('jobseeker.jobs.index') }}" class="btn-outline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Browse Jobs
            </a>
        </div>

        <!-- Stats Summary -->
        @if(!$applications->isEmpty())
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-gray-900">{{ $applications->count() }}</div>
                    <div class="stat-icon bg-indigo-100">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Total Applications</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-yellow-600">{{ $applications->where('status', 'pending')->count() }}</div>
                    <div class="stat-icon bg-yellow-100">
                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Pending Review</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-green-600">{{ $applications->where('status', 'accepted')->count() }}</div>
                    <div class="stat-icon bg-green-100">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Accepted</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-red-600">{{ $applications->where('status', 'rejected')->count() }}</div>
                    <div class="stat-icon bg-red-100">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Not Selected</div>
            </div>
        </div>
        @endif

        <!-- Applications List / Empty State -->
        @if($applications->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="empty-title">No applications yet</div>
            <p class="empty-sub">When you apply for jobs, they'll show up here. Start your job search today!</p>
            <a href="{{ route('jobseeker.jobs.index') }}" class="btn-primary">Browse Available Jobs</a>
        </div>
        @else
        <!-- Applications Cards -->
        <div>
            @foreach($applications as $application)
            <div class="application-card">
                <div class="application-card-inner">
                    <div class="application-main">
                        <!-- Left: Job Info -->
                        <div class="job-info">
                            <h3 class="job-title">
                                <a href="{{ route('jobseeker.jobs.show', $application->job) }}">
                                    {{ $application->job->title }}
                                </a>
                            </h3>
                            <div class="job-meta">
                                <span class="meta-item">
                                    <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    {{ $application->job->employer->employerProfile->company_name ?? 'Company' }}
                                </span>
                                <span class="meta-item">
                                    <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $application->job->location ?? 'Remote / Flexible' }}
                                </span>
                                <span class="meta-item">
                                    <svg class="meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Applied {{ $application->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        <!-- Right: Status & Action -->
                        <div class="action-area">
                            @php
                                $badgeClass = match($application->status) {
                                    'pending' => 'status-pending',
                                    'reviewing' => 'status-reviewing',
                                    'accepted' => 'status-accepted',
                                    'rejected' => 'status-rejected',
                                    'interview', 'interview_scheduled' => 'status-interview',
                                    default => 'status-pending'
                                };
                                $statusLabel = match($application->status) {
                                    'pending' => 'Pending Review',
                                    'reviewing' => 'In Review',
                                    'accepted' => 'Accepted',
                                    'rejected' => 'Not Selected',
                                    'interview', 'interview_scheduled' => 'Interview Scheduled',
                                    default => ucfirst($application->status)
                                };
                            @endphp
                            <span class="status-badge {{ $badgeClass }}">
                                <span class="status-dot"></span>
                                {{ $statusLabel }}
                            </span>

                            <a href="{{ route('jobseeker.applications.show', $application) }}" class="btn-ghost">
                                View Application
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Feedback Section -->
                    @if(in_array($application->status, ['accepted', 'rejected']) && $application->feedback)
                    <div class="feedback-section">
                        @if($application->status == 'accepted')
                        <svg class="w-4 h-4 text-green-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @else
                        <svg class="w-4 h-4 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @endif
                        <span class="feedback-text">{{ $application->feedback }}</span>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if(method_exists($applications, 'links') && $applications->hasPages())
        <div class="pagination-wrap">
            {{ $applications->links() }}
        </div>
        @endif
        @endif
    </div>
</div>
@endsection