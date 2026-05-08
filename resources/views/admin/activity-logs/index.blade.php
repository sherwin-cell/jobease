@extends('layouts.app')

@section('title', 'Activity Logs - JobEase')

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

    /* ===== PAGE HEADER ===== */
    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }
    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 0.25rem;
        line-height: 1.2;
    }
    .page-sub {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0;
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

    /* ===== ACTIVITY CARD ===== */
    .activity-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        transition: all 0.2s;
        height: 100%;
    }
    .activity-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.07);
        border-color: #d1d5db;
        transform: translateY(-2px);
    }
    .activity-card-inner {
        padding: 1.25rem;
    }
    .activity-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    .activity-icon {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .activity-badge {
        display: inline-flex;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .badge-create { background: #dcfce7; color: #15803d; }
    .badge-update { background: #dbeafe; color: #1d4ed8; }
    .badge-delete { background: #fee2e2; color: #b91c1c; }
    .badge-login { background: #f3e8ff; color: #6b21a5; }
    .badge-logout { background: #f3f4f6; color: #6b7280; }
    .badge-default { background: #fef3c7; color: #a16207; }

    .activity-time {
        text-align: right;
        flex-shrink: 0;
    }
    .activity-date {
        font-size: 0.6875rem;
        color: #9ca3af;
    }
    .activity-hour {
        font-size: 0.6875rem;
        color: #9ca3af;
        margin-top: 0.125rem;
    }
    .activity-description {
        font-size: 0.875rem;
        color: #4b5563;
        line-height: 1.5;
        margin-bottom: 1rem;
    }
    .activity-user {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-top: 0.75rem;
        border-top: 1px solid #f3f4f6;
        margin-bottom: 0.75rem;
    }
    .user-icon {
        width: 1rem;
        height: 1rem;
        color: #9ca3af;
    }
    .user-name {
        font-size: 0.8125rem;
        font-weight: 500;
        color: #111827;
    }
    .user-email {
        font-size: 0.6875rem;
        color: #9ca3af;
    }

    .activity-footer {
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
        padding-top: 0.75rem;
        border-top: 1px solid #f3f4f6;
    }
    .footer-icon {
        width: 0.75rem;
        height: 0.75rem;
        color: #9ca3af;
        margin-top: 0.125rem;
        flex-shrink: 0;
    }
    .footer-text {
        font-size: 0.6875rem;
        color: #9ca3af;
        word-break: break-all;
    }

    /* ===== ACTION BUTTON ===== */
    .btn-cleanup {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #ef4444;
        color: #fff;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 0.75rem;
        border: none;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-cleanup:hover {
        background: #dc2626;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
    }
    .empty-icon {
        width: 4rem;
        height: 4rem;
        background: #f3f4f6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
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

    /* ===== PAGINATION ===== */
    .pagination-wrapper {
        margin-top: 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }
    .pagination-links {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        justify-content: center;
    }
    .pagination-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem;
        border-radius: 0.5rem;
        transition: all 0.15s;
    }
    .pagination-btn.disabled {
        color: #d1d5db;
        cursor: not-allowed;
    }
    .pagination-btn:not(.disabled) {
        color: #6b7280;
    }
    .pagination-btn:not(.disabled):hover {
        background: #eff6ff;
        color: #2563eb;
    }
    .pagination-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.375rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.15s;
    }
    .pagination-number.active {
        background: #2563eb;
        color: #fff;
    }
    .pagination-number:not(.active) {
        color: #6b7280;
    }
    .pagination-number:not(.active):hover {
        background: #eff6ff;
        color: #2563eb;
    }
    .pagination-ellipsis {
        padding: 0.375rem 0.5rem;
        color: #9ca3af;
    }
    .results-info {
        font-size: 0.75rem;
        color: #9ca3af;
        text-align: center;
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
        .page-header {
            flex-direction: column;
        }
        .activity-header {
            flex-direction: column;
            gap: 0.75rem;
        }
        .activity-time {
            text-align: left;
        }
    }
</style>

<div class="full-page-container">
    <div class="content-wrapper">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Activity Logs</h1>
                <p class="page-sub">View all system activities and user actions</p>
            </div>
            <form action="{{ route('admin.activity-logs.cleanup') }}" method="POST"
                onsubmit="return confirm('⚠️ Warning: This will permanently delete orphaned activity logs. This action cannot be undone!')">
                @csrf
                <button type="submit" class="btn-cleanup">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Clean Up Orphaned Logs
                </button>
            </form>
        </div>

        <!-- Stats Cards -->
        @php
            $totalLogs = $logs->total();
            $createCount = $logs->where('action', 'CREATE')->count();
            $updateCount = $logs->where('action', 'UPDATE')->count();
            $deleteCount = $logs->where('action', 'DELETE')->count();
        @endphp
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-gray-900">{{ $totalLogs }}</div>
                    <div class="stat-icon bg-blue-100">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Total Activities</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-green-600">{{ $createCount }}</div>
                    <div class="stat-icon bg-green-100">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Create Actions</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-blue-600">{{ $updateCount }}</div>
                    <div class="stat-icon bg-blue-100">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Update Actions</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-red-600">{{ $deleteCount }}</div>
                    <div class="stat-icon bg-red-100">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Delete Actions</div>
            </div>
        </div>

        <!-- Activity Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse ($logs as $log)
                @php
                    $actionClass = match($log->action) {
                        'CREATE' => 'badge-create',
                        'UPDATE' => 'badge-update',
                        'DELETE' => 'badge-delete',
                        'LOGIN' => 'badge-login',
                        'LOGOUT' => 'badge-logout',
                        default => 'badge-default'
                    };
                    $iconBgClass = match($log->action) {
                        'CREATE' => 'bg-green-100',
                        'UPDATE' => 'bg-blue-100',
                        'DELETE' => 'bg-red-100',
                        'LOGIN' => 'bg-purple-100',
                        'LOGOUT' => 'bg-gray-100',
                        default => 'bg-yellow-100'
                    };
                @endphp
                <div class="activity-card">
                    <div class="activity-card-inner">
                        <!-- Header -->
                        <div class="activity-header">
                            <div class="flex items-center gap-2">
                                <div class="activity-icon {{ $iconBgClass }}">
                                    @if($log->action == 'CREATE')
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    @elseif($log->action == 'UPDATE')
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    @elseif($log->action == 'DELETE')
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    @elseif($log->action == 'LOGIN')
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    @endif
                                </div>
                                <span class="activity-badge {{ $actionClass }}">{{ $log->action }}</span>
                            </div>
                            <div class="activity-time">
                                <div class="activity-date">{{ $log->created_at->format('M d, Y') }}</div>
                                <div class="activity-hour">{{ $log->created_at->format('h:i A') }}</div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="activity-description">
                            {{ $log->description }}
                        </div>

                        <!-- User Info -->
                        <div class="activity-user">
                            <svg class="user-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <div>
                                @if ($log->user)
                                    <div class="user-name">{{ $log->user->name }}</div>
                                    <div class="user-email">{{ $log->user->email }}</div>
                                @else
                                    <div class="user-name text-gray-500">System / Deleted User</div>
                                @endif
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="activity-footer">
                            <svg class="footer-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="footer-text">{{ $log->ip_address ?? 'N/A' }}</span>
                        </div>
                        @if($log->user_agent)
                        <div class="activity-footer mt-1">
                            <svg class="footer-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 7h14M5 10h14M5 13h14M5 16h14M5 19h14" />
                            </svg>
                            <span class="footer-text">{{ Str::limit($log->user_agent, 50) }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3">
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="empty-title">No activity logs found</div>
                        <p class="empty-sub">Activities will appear here as users interact with the system</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($logs->hasPages())
        <div class="pagination-wrapper">
            <div class="pagination-links">
                <!-- First Page -->
                @if ($logs->onFirstPage())
                    <span class="pagination-btn disabled">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $logs->url(1) }}" class="pagination-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                        </svg>
                    </a>
                @endif

                <!-- Previous Page -->
                @if ($logs->onFirstPage())
                    <span class="pagination-btn disabled">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $logs->previousPageUrl() }}" class="pagination-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                @endif

                <!-- Page Numbers -->
                @php
                    $currentPage = $logs->currentPage();
                    $lastPage = $logs->lastPage();
                    $start = max(1, $currentPage - 2);
                    $end = min($lastPage, $currentPage + 2);
                @endphp

                @if($start > 1)
                    <a href="{{ $logs->url(1) }}" class="pagination-number">1</a>
                    @if($start > 2)
                        <span class="pagination-ellipsis">...</span>
                    @endif
                @endif

                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $logs->currentPage())
                        <span class="pagination-number active">{{ $page }}</span>
                    @else
                        <a href="{{ $logs->url($page) }}" class="pagination-number">{{ $page }}</a>
                    @endif
                @endfor

                @if($end < $lastPage)
                    @if($end < $lastPage - 1)
                        <span class="pagination-ellipsis">...</span>
                    @endif
                    <a href="{{ $logs->url($lastPage) }}" class="pagination-number">{{ $lastPage }}</a>
                @endif

                <!-- Next Page -->
                @if ($logs->hasMorePages())
                    <a href="{{ $logs->nextPageUrl() }}" class="pagination-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @else
                    <span class="pagination-btn disabled">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                @endif

                <!-- Last Page -->
                @if ($logs->hasMorePages())
                    <a href="{{ $logs->url($logs->lastPage()) }}" class="pagination-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                        </svg>
                    </a>
                @else
                    <span class="pagination-btn disabled">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                        </svg>
                    </span>
                @endif
            </div>
            <div class="results-info">
                Showing {{ $logs->firstItem() ?? 0 }} to {{ $logs->lastItem() ?? 0 }} of {{ $logs->total() }} results
            </div>
        </div>
        @endif
    </div>
</div>
@endsection