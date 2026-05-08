@extends('layouts.app')

@section('title', 'Admin Jobs')

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

    /* ===== SEARCH BAR ===== */
    .search-wrapper {
        position: relative;
    }
    .search-input {
        width: 100%;
        padding: 0.625rem 1rem 0.625rem 2.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        outline: none;
        transition: all 0.15s;
        background: #fff;
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

    /* ===== TABLE ===== */
    .table-wrapper {
        overflow-x: auto;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
    }
    .jobs-table {
        width: 100%;
        border-collapse: collapse;
    }
    .jobs-table th {
        text-align: left;
        padding: 0.875rem 1rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }
    .jobs-table td {
        padding: 1rem;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }
    .jobs-table tr:hover td {
        background: #f9fafb;
    }
    .jobs-table tr:last-child td {
        border-bottom: none;
    }

    /* ===== JOB INFO ===== */
    .job-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .job-icon {
        width: 2.25rem;
        height: 2.25rem;
        border-radius: 0.5rem;
        background: #eff6ff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .job-details {
        display: flex;
        flex-direction: column;
    }
    .job-title {
        font-weight: 600;
        color: #111827;
        line-height: 1.4;
    }
    .job-description {
        font-size: 0.75rem;
        color: #9ca3af;
        margin-top: 0.125rem;
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
    .status-pending { background: #fef9c3; color: #a16207; }
    .status-rejected { background: #fee2e2; color: #b91c1c; }
    .status-dot {
        width: 0.375rem;
        height: 0.375rem;
        border-radius: 50%;
    }
    .status-active .status-dot { background: #15803d; }
    .status-pending .status-dot { background: #a16207; }
    .status-rejected .status-dot { background: #b91c1c; }

    /* ===== ACTION BUTTONS ===== */
    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.15s;
        border: none;
    }
    .action-view {
        background: #fff;
        color: #6b7280;
        border: 1px solid #e5e7eb;
    }
    .action-view:hover {
        background: #f9fafb;
        color: #2563eb;
        border-color: #d1d5db;
    }
    .action-approve {
        background: #dcfce7;
        color: #15803d;
    }
    .action-approve:hover {
        background: #bbf7d0;
    }
    .action-reject {
        background: #fee2e2;
        color: #b91c1c;
    }
    .action-reject:hover {
        background: #fecaca;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
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
        padding: 1rem;
        border-top: 1px solid #e5e7eb;
        background: #f9fafb;
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
        .jobs-table th,
        .jobs-table td {
            padding: 0.75rem;
        }
        .action-buttons {
            justify-content: flex-start;
        }
        .action-btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.6875rem;
        }
    }
</style>

<div class="full-page-container">
    <div class="content-wrapper">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Job Listings</h1>
                <p class="page-sub">Manage and moderate job posts from employers</p>
            </div>
            <div class="search-wrapper">
                <input type="text" id="searchJobs" placeholder="Search jobs..." class="search-input">
                <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-gray-900">{{ $jobs->total() }}</div>
                    <div class="stat-icon bg-blue-100">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Total Jobs</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-green-600">{{ $jobs->where('status', 'active')->count() }}</div>
                    <div class="stat-icon bg-green-100">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Active Jobs</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-yellow-600">{{ $jobs->where('status', 'pending')->count() }}</div>
                    <div class="stat-icon bg-yellow-100">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Pending Review</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-red-600">{{ $jobs->where('status', 'rejected')->count() }}</div>
                    <div class="stat-icon bg-red-100">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Rejected</div>
            </div>
        </div>

        <!-- Jobs Table -->
        <div class="table-wrapper">
            <table class="jobs-table">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Posted Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobs as $job)
                    <tr>
                        <td>
                            <div class="job-info">
                                <div class="job-icon">
                                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="job-details">
                                    <span class="job-title">{{ $job->title }}</span>
                                    <span class="job-description">{{ Str::limit($job->description ?? 'No description', 60) }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-gray-600">{{ $job->employer->employerProfile->company_name ?? 'No Company' }}</span>
                        </td>
                        <td>
                            @php
                                $statusClass = match($job->status) {
                                    'active' => 'status-active',
                                    'pending' => 'status-pending',
                                    'rejected' => 'status-rejected',
                                    default => 'status-pending'
                                };
                            @endphp
                            <span class="status-badge {{ $statusClass }}">
                                <span class="status-dot"></span>
                                {{ ucfirst($job->status) }}
                            </span>
                        </td>
                        <td><span class="text-gray-500">{{ $job->created_at->format('M d, Y') }}</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn action-view" title="View Details">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View
                                </button>

                                @if($job->status !== 'active')
                                    <form method="POST" action="{{ route('admin.jobs.approve', $job->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="action-btn action-approve" title="Approve Job" onclick="return confirm('Approve this job posting?')">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Approve
                                        </button>
                                    </form>
                                @endif

                                @if($job->status !== 'rejected')
                                    <form method="POST" action="{{ route('admin.jobs.reject', $job->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="action-btn action-reject" title="Reject Job" onclick="return confirm('Reject this job posting?')">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Reject
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                </div>
                                <div class="empty-title">No job listings found</div>
                                <p class="empty-sub">Jobs will appear here as employers create them</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($jobs->hasPages())
        <div class="pagination-wrapper">
            {{ $jobs->links() }}
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchJobs');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('.jobs-table tbody tr');
                rows.forEach(row => {
                    if (row.querySelector('td')) {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchTerm) ? '' : 'none';
                    }
                });
            });
        }
    });
</script>
@endsection