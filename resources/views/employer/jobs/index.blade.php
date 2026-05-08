@extends('layouts.app')

@section('title', 'My Job Postings')

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
    }
    .btn-outline:hover { background: #eff6ff; }

    .btn-danger {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ef4444;
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background 0.15s;
    }
    .btn-danger:hover { background: #dc2626; }

    .btn-warning {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f59e0b;
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.15s;
    }
    .btn-warning:hover { background: #d97706; }

    /* ===== ALERTS ===== */
    .alert-success {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #15803d;
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .alert-error {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ===== TABLE ===== */
    .table-wrapper {
        overflow-x: auto;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
    }
    .jobs-table {
        width: 100%;
        border-collapse: collapse;
    }
    .jobs-table th {
        text-align: left;
        padding: 14px 16px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }
    .jobs-table td {
        padding: 16px;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }
    .jobs-table tr:hover td {
        background: #f9fafb;
    }

    /* ===== STATUS BADGES ===== */
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
    .status-rejected { background: #fee2e2; color: #b91c1c; }
    .status-expired { background: #f3f4f6; color: #6b7280; }

    /* ===== SKILL TAGS ===== */
    .skills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        max-width: 250px;
    }
    .skill-tag {
        display: inline-flex;
        padding: 2px 8px;
        background: #f3f4f6;
        color: #374151;
        font-size: 0.6875rem;
        font-weight: 500;
        border-radius: 999px;
    }

    /* ===== ACTION BUTTONS GROUP ===== */
    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 60px 24px;
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

    /* ===== REJECTED NOTE ===== */
    .rejected-note {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.6875rem;
        color: #b91c1c;
        margin-top: 4px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
        }
        .jobs-table th, 
        .jobs-table td {
            padding: 12px;
        }
        .skills-container {
            max-width: 180px;
        }
        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">My Job Postings</h1>
                <p class="page-sub">Manage and track all your job listings</p>
            </div>
            <a href="{{ route('employer.jobs.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create New Job
            </a>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="alert-success">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert-error">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('error') }}
        </div>
        @endif

        <!-- Jobs Table -->
        <div class="table-wrapper">
            <table class="jobs-table">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Location</th>
                        <th>Salary</th>
                        <th>Skills Required</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                    <tr>
                        <td>
                            <div class="font-medium text-gray-900">{{ $job->title }}</div>
                            <div class="text-xs text-gray-500 mt-1">
                                📅 {{ $job->created_at->format('M d, Y') }}
                            </div>
                        </td>
                        <td>
                            <div class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $job->location }}
                            </div>
                        </td>
                        <td>
                            <div class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                ${{ number_format($job->salary) }}/year
                            </div>
                        </td>
                        <td>
                            <div class="skills-container">
                                @if(is_array($job->skills_required) && count($job->skills_required) > 0)
                                    @foreach(array_slice($job->skills_required, 0, 3) as $skill)
                                        <span class="skill-tag">{{ $skill }}</span>
                                    @endforeach
                                    @if(count($job->skills_required) > 3)
                                        <span class="skill-tag">+{{ count($job->skills_required) - 3 }}</span>
                                    @endif
                                @else
                                    <span class="text-gray-400 text-xs">None specified</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @php
                                $statusColors = [
                                    'active' => 'status-active',
                                    'pending' => 'status-pending',
                                    'rejected' => 'status-rejected',
                                    'expired' => 'status-expired',
                                ];
                            @endphp
                            <div>
                                <span class="status-badge {{ $statusColors[$job->status] ?? 'status-pending' }}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current opacity-60"></span>
                                    {{ ucfirst($job->status) }}
                                </span>
                                @if($job->status === 'rejected')
                                    <div class="rejected-note">
                                        ⚠️ Needs revision
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                @if($job->status !== 'rejected')
                                    <a href="{{ route('employer.jobs.edit', $job) }}" class="btn-outline" style="padding: 6px 14px; font-size: 0.75rem;">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                @else
                                    <button disabled class="btn-outline" style="padding: 6px 14px; font-size: 0.75rem; opacity: 0.5; cursor: not-allowed; border-color: #d1d5db; color: #9ca3af;">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>
                                @endif
                                
                                <form method="POST" action="{{ route('employer.jobs.destroy', $job) }}" 
                                      onsubmit="return confirm('Are you sure you want to delete this job? This action cannot be undone.')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                                
                                @if($job->status === 'rejected')
                                    <a href="{{ route('employer.jobs.create') }}" class="btn-warning">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                        </svg>
                                        Create Similar
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon">📭</div>
                                <div class="empty-title">No job postings yet</div>
                                <p class="empty-sub">Create your first job posting to start receiving applications</p>
                                <a href="{{ route('employer.jobs.create') }}" class="btn-primary">Create Your First Job</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection