@extends('layouts.app')

@section('title', 'Applications for My Jobs')

@section('content')
    <style>
        /* ===== PAGE CONTAINER ===== */
        .full-page-container {
            min-height: 100vh;
            background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
            padding: 2rem 0;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        @media (max-width: 640px) {
            .content-wrapper {
                padding: 0 1rem;
            }

            .full-page-container {
                padding: 1rem 0;
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
            gap: 6px;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

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

        .btn-outline:hover {
            background: #eff6ff;
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            color: #374151;
            font-size: 0.8125rem;
            font-weight: 500;
            padding: 6px 14px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            text-decoration: none;
            transition: all 0.15s;
        }

        .btn-ghost:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        /* ===== STATS GRID ===== */
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
            transition: all 0.2s;
        }

        .stat-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
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
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

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

        .applications-table {
            width: 100%;
            border-collapse: collapse;
        }

        .applications-table th {
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

        .applications-table td {
            padding: 16px;
            font-size: 0.875rem;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }

        .applications-table tr:hover td {
            background: #f9fafb;
        }

        .applications-table tr:last-child td {
            border-bottom: none;
        }

        /* ===== STATUS BADGES ===== */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.6875rem;
            font-weight: 600;
        }

        .status-pending {
            background: #fef9c3;
            color: #a16207;
        }

        .status-reviewing {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-shortlisted {
            background: #f3e8ff;
            color: #6b21a5;
        }

        .status-interview {
            background: #fce7f3;
            color: #be185d;
        }

        .status-interview_scheduled {
            background: #dcfce7;
            color: #15803d;
        }

        .status-rejected {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-hired {
            background: #dcfce7;
            color: #15803d;
        }

        .status-accepted {
            background: #dcfce7;
            color: #15803d;
        }

        /* ===== APPLICANT INFO ===== */
        .applicant-name {
            font-weight: 600;
            color: #111827;
            margin: 0 0 2px;
        }

        .applicant-email {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        /* ===== JOB TITLE LINK ===== */
        .job-title-link {
            color: #111827;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.15s;
        }

        .job-title-link:hover {
            color: #2563eb;
            text-decoration: underline;
        }

        .job-location {
            font-size: 0.6875rem;
            color: #9ca3af;
            margin-top: 2px;
            display: flex;
            align-items: center;
            gap: 2px;
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

            .page-header {
                flex-direction: column;
            }

            .applications-table th,
            .applications-table td {
                padding: 12px;
            }
        }
    </style>

    <div class="full-page-container">
        <div class="content-wrapper">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Applications for My Jobs</h1>
                    <p class="page-sub">Review and manage all job applications in one place</p>
                </div>
                <a href="{{ route('employer.jobs.index') }}" class="btn-outline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    View My Jobs
                </a>
            </div>

            <!-- Stats Summary -->
            @if(!$applications->isEmpty())
                <div class="stats-grid" style="grid-template-columns: repeat(3, 1fr);">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-value text-gray-900">{{ $applications->count() }}</div>
                            <div class="stat-icon bg-indigo-100">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-label">Total Applications</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-value text-yellow-600">{{ $applications->where('status', 'pending')->count() }}
                            </div>
                            <div class="stat-icon bg-yellow-100">
                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-label">Pending Review</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-value text-green-600">
                                {{ $applications->whereIn('status', ['interview', 'interview_scheduled'])->count() }}</div>
                            <div class="stat-icon bg-green-100">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-label">Interviews</div>
                    </div>
                </div>
            @endif

            <!-- Alerts -->
            @if(session('success'))
                <div class="alert-success">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-error">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Applications Table -->
            @if($applications->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <div class="empty-title">No applications yet</div>
                    <p class="empty-sub">When candidates apply to your jobs, they'll appear here.</p>
                    <a href="{{ route('employer.jobs.index') }}" class="btn-primary">View Your Jobs</a>
                </div>
            @else
                <div class="table-wrapper">
                    <table class="applications-table">
                        <thead>
                            <tr>
                                <th>Job</th>
                                <th>Applicant</th>
                                <th>Status</th>
                                <th>Applied On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $app)
                                <tr>
                                    <td>
                                        <div>
                                            <a href="{{ route('employer.jobs.show', $app->job) }}" class="job-title-link">
                                                {{ $app->job->title }}
                                            </a>
                                            <div class="job-location">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                {{ $app->job->location ?? 'Remote' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="applicant-name">{{ $app->user->name }}</div>
                                            <div class="applicant-email">{{ $app->user->email }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = match ($app->status) {
                                                'pending' => 'status-pending',
                                                'shortlisted' => 'status-shortlisted',
                                                'interview' => 'status-interview',
                                                'interview_scheduled' => 'status-interview_scheduled',
                                                'rejected' => 'status-rejected',
                                                'hired' => 'status-hired',
                                                'accepted' => 'status-accepted',
                                                default => 'status-pending'
                                            };
                                            $statusLabel = match ($app->status) {
                                                'pending' => 'Pending Review',
                                                'shortlisted' => 'Shortlisted',
                                                'interview' => 'Interview',
                                                'interview_scheduled' => 'Interview Scheduled',
                                                'rejected' => 'Not Selected',
                                                'hired' => 'Hired',
                                                'accepted' => 'Accepted',
                                                default => ucfirst(str_replace('_', ' ', $app->status))
                                            };
                                        @endphp
                                        <span class="status-badge {{ $statusClass }}">
                                            <span class="w-1.5 h-1.5 rounded-full bg-current opacity-60"></span>
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $app->created_at->format('M d, Y') }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('employer.applications.show', $app) }}" class="btn-ghost">
                                            Review Application
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection