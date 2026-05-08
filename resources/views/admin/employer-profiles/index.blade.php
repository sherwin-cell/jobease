@extends('layouts.app')

@section('title', 'Employer Profile Approvals')

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

    /* ===== WELCOME HEADER ===== */
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

    /* ===== STATS CARDS ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
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

    /* ===== SECTION CARDS ===== */
    .section-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .section-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .section-header.pending {
        background: linear-gradient(135deg, #fef3c7 0%, #fffbeb 100%);
    }
    .section-header.approved {
        background: linear-gradient(135deg, #dcfce7 0%, #f0fdf4 100%);
    }
    .section-icon {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .section-icon.pending { background: #fef3c7; }
    .section-icon.approved { background: #dcfce7; }
    .section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }
    .section-sub {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.125rem;
    }

    /* ===== ALERTS ===== */
    .alert-success {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #15803d;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .alert-info {
        background: #dbeafe;
        border: 1px solid #bfdbfe;
        color: #1d4ed8;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* ===== TABLE ===== */
    .table-wrapper {
        overflow-x: auto;
    }
    .profiles-table {
        width: 100%;
        border-collapse: collapse;
    }
    .profiles-table th {
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
    .profiles-table td {
        padding: 1rem;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }
    .profiles-table tr:hover td {
        background: #f9fafb;
    }
    .profiles-table tr:last-child td {
        border-bottom: none;
    }

    /* ===== COMPANY INFO ===== */
    .company-name {
        font-weight: 600;
        color: #111827;
        line-height: 1.4;
    }
    .company-website {
        font-size: 0.75rem;
        color: #9ca3af;
        margin-top: 0.125rem;
    }

    /* ===== ACTION BUTTONS ===== */
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.15s;
    }
    .action-review {
        background: #eff6ff;
        color: #2563eb;
    }
    .action-review:hover {
        background: #dbeafe;
    }
    .action-view {
        background: #f3f4f6;
        color: #374151;
    }
    .action-view:hover {
        background: #e5e7eb;
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
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }
        .stat-value {
            font-size: 1.5rem;
        }
        .profiles-table th,
        .profiles-table td {
            padding: 0.75rem;
        }
    }
</style>

<div class="full-page-container">
    <div class="content-wrapper">
        <!-- Welcome Header -->
        <div class="welcome-header">
            <div style="position: relative; z-index: 10;">
                <h1 class="text-2xl font-bold text-white">Employer Profile Approvals</h1>
                <p class="text-white/80 text-sm mt-1">Manage and review employer company profiles</p>
            </div>
        </div>

        <!-- Alerts -->
        @if (session('success'))
        <div class="alert-success">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if (session('info'))
        <div class="alert-info">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('info') }}
        </div>
        @endif

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-gray-900">{{ $pendingProfiles->total() + $approvedProfiles->total() }}</div>
                    <div class="stat-icon bg-blue-100">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Total Employer Profiles</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-yellow-600">{{ $pendingProfiles->total() }}</div>
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
                    <div class="stat-value text-green-600">{{ $approvedProfiles->total() }}</div>
                    <div class="stat-icon bg-green-100">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Verified Employers</div>
            </div>
        </div>

        <!-- Pending Profiles Section -->
        <div class="section-card">
            <div class="section-header pending">
                <div class="section-icon pending">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="section-title">Pending Approval</h2>
                    <p class="section-sub">{{ $pendingProfiles->total() }} profiles waiting for review</p>
                </div>
            </div>

            @if ($pendingProfiles->count() > 0)
            <div class="table-wrapper">
                <table class="profiles-table">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingProfiles as $profile)
                        <tr>
                            <td>
                                <div class="company-name">{{ $profile->company_name }}</div>
                                @if($profile->company_website)
                                    <div class="company-website">{{ $profile->company_website }}</div>
                                @endif
                            </td>
                            <td>
                                <div class="text-gray-600">{{ $profile->user->email }}</div>
                                <div class="text-xs text-gray-400">{{ $profile->phone }}</div>
                            </td>
                            <td><span class="text-gray-600">{{ $profile->location ?? 'N/A' }}</span></td>
                            <td>
                                <div class="text-gray-600">{{ $profile->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $profile->created_at->format('h:i A') }}</div>
                            </td>
                            <td>
                                <a href="{{ route('admin.employer-profiles.show', $profile) }}" class="action-btn action-review">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Review
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($pendingProfiles->hasPages())
            <div class="pagination-wrapper">
                {{ $pendingProfiles->links() }}
            </div>
            @endif
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="empty-title">No pending profiles to review</div>
                <p class="empty-sub">All caught up! Great job!</p>
            </div>
            @endif
        </div>

        <!-- Approved Profiles Section -->
        <div class="section-card">
            <div class="section-header approved">
                <div class="section-icon approved">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h2 class="section-title">Approved Profiles</h2>
                    <p class="section-sub">{{ $approvedProfiles->total() }} verified employers</p>
                </div>
            </div>

            @if ($approvedProfiles->count() > 0)
            <div class="table-wrapper">
                <table class="profiles-table">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Approved</th>
                            <th>Approved By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approvedProfiles as $profile)
                        <tr>
                            <td>
                                <div class="company-name">{{ $profile->company_name }}</div>
                                @if($profile->company_website)
                                    <div class="company-website">{{ $profile->company_website }}</div>
                                @endif
                            </td>
                            <td>
                                <div class="text-gray-600">{{ $profile->user->email }}</div>
                                <div class="text-xs text-gray-400">{{ $profile->phone }}</div>
                            </td>
                            <td>
                                <div class="text-gray-600">{{ $profile->approved_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $profile->approved_at->format('h:i A') }}</div>
                            </td>
                            <td>
                                <div class="text-gray-600">{{ $profile->approvedByUser->name ?? 'System' }}</div>
                            </td>
                            <td>
                                <a href="{{ route('admin.employer-profiles.show', $profile) }}" class="action-btn action-view">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($approvedProfiles->hasPages())
            <div class="pagination-wrapper">
                {{ $approvedProfiles->links() }}
            </div>
            @endif
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="empty-title">No approved profiles yet</div>
                <p class="empty-sub">Approved profiles will appear here</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection