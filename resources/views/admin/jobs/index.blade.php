@extends('layouts.app')

@section('title', 'Manage Jobs')

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
            align-items: center;
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
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
            border-color: #d1d5db;
            transform: translateY(-2px);
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
            min-width: 250px;
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
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .jobs-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
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

        .status-active {
            background: #dcfce7;
            color: #15803d;
        }

        .status-pending {
            background: #fef9c3;
            color: #a16207;
        }

        .status-closed {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-rejected {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-dot {
            width: 0.375rem;
            height: 0.375rem;
            border-radius: 50%;
        }

        .status-active .status-dot {
            background: #15803d;
        }

        .status-pending .status-dot {
            background: #a16207;
        }

        .status-closed .status-dot {
            background: #b91c1c;
        }

        .status-rejected .status-dot {
            background: #b91c1c;
        }

        /* ===== ACTION BUTTONS ===== */
        .action-buttons {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: nowrap;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.375rem 0.875rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            text-decoration: none;
            background: transparent;
            white-space: nowrap;
        }

        .action-view {
            background: #f3f4f6;
            color: #4b5563;
            border: 1px solid #e5e7eb;
        }

        .action-view:hover {
            background: #e5e7eb;
            color: #2563eb;
            transform: translateY(-1px);
        }

        .action-delete {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .action-delete:hover {
            background: #fecaca;
            transform: translateY(-1px);
        }

        .action-approve {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .action-approve:hover {
            background: #bbf7d0;
            transform: translateY(-1px);
        }

        .action-reject {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .action-reject:hover {
            background: #fecaca;
            transform: translateY(-1px);
        }

        /* ===== MODAL STYLES ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            max-width: 600px;
            width: 90%;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.3s;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
            padding: 0;
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            transition: all 0.15s;
        }

        .modal-close:hover {
            background: #f3f4f6;
            color: #111827;
        }

        .modal-body {
            padding: 1.5rem;
            max-height: 60vh;
            overflow-y: auto;
        }

        .detail-row {
            display: flex;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .detail-label {
            width: 120px;
            font-weight: 600;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .detail-value {
            flex: 1;
            color: #111827;
            font-size: 0.875rem;
        }

        .detail-value p {
            margin: 0;
            line-height: 1.5;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.15s;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
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

        .alert-error {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
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

        .inline {
            display: inline-flex;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .search-wrapper {
                width: 100%;
            }

            .stats-grid {
                gap: 0.75rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .jobs-table th,
            .jobs-table td {
                padding: 0.75rem;
            }

            .action-buttons {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .action-btn {
                padding: 0.375rem 0.75rem;
                font-size: 0.6875rem;
            }
        }
    </style>

    <div class="full-page-container">
        <div class="content-wrapper">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Manage Jobs</h1>
                    <p class="page-sub">View and manage all job postings on the platform</p>
                </div>
                <div class="search-wrapper">
                    <input type="text" id="searchJobs" placeholder="Search by title, company, or location..."
                        class="search-input">
                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <!-- Total Jobs Card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-value text-gray-900">{{ $jobs->count() }}</div>
                        <div class="stat-icon bg-blue-100">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-label">Total Jobs</div>
                </div>

                <!-- Active Jobs Card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-value text-green-600">{{ $jobs->where('status', 'active')->count() }}</div>
                        <div class="stat-icon bg-green-100">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-label">Active Jobs</div>
                </div>

                <!-- Pending Jobs Card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-value text-yellow-600">{{ $jobs->where('status', 'pending')->count() }}</div>
                        <div class="stat-icon bg-yellow-100">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-label">Pending Approval</div>
                </div>

                <!-- Closed Jobs Card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-value text-red-600">{{ $jobs->where('status', 'closed')->count() }}</div>
                        <div class="stat-icon bg-red-100">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-label">Closed Jobs</div>
                </div>
            </div>

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

            <!-- Jobs Table -->
            <div class="table-wrapper">
                <table class="jobs-table">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Location</th>
                            <th>Applications</th>
                            <th>Status</th>
                            <th>Posted Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobs as $job)
                            <tr>
                                <td>
                                    <button onclick='viewJobDetails({
                                        id: {{ $job->id }},
                                        title: "{{ addslashes($job->title) }}",
                                        company: "{{ addslashes($job->employer->employerProfile->company_name ?? 'N/A') }}",
                                        location: "{{ addslashes($job->location ?? 'Remote') }}",
                                        description: "{{ addslashes(Str::limit($job->description ?? 'No description', 200)) }}",
                                        salary: "{{ $job->salary ? '$'.number_format($job->salary).'/year' : 'Not specified' }}",
                                        experience_level: "{{ addslashes($job->experience_level ?? 'Not specified') }}",
                                        applications_count: {{ $job->applications_count ?? $job->applications->count() }},
                                        status: "{{ $job->status }}",
                                        status_label: "{{ ucfirst($job->status) }}",
                                        posted_date: "{{ $job->created_at->format('F d, Y') }}"
                                    })' class="font-medium text-gray-900 hover:text-blue-600 focus:outline-none">
                                        {{ $job->title }}
                                    </button>
                                 </div>
                                 
                                <td>{{ $job->employer->employerProfile->company_name ?? 'N/A' }}</div>
                                 
                                <td>{{ $job->location ?? 'Remote' }}</div>
                                 
                                <td>
                                    <span class="text-blue-600 font-semibold">{{ $job->applications_count ?? $job->applications->count() }}</span>
                                 </div>
                                 
                                <td>
                                    @php
                                        $statusClass = match ($job->status) {
                                            'active' => 'status-active',
                                            'pending' => 'status-pending',
                                            'closed' => 'status-closed',
                                            'rejected' => 'status-rejected',
                                            default => 'status-pending'
                                        };
                                        $statusLabel = match ($job->status) {
                                            'active' => 'Active',
                                            'pending' => 'Pending',
                                            'closed' => 'Closed',
                                            'rejected' => 'Rejected',
                                            default => ucfirst($job->status)
                                        };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        <span class="status-dot"></span>
                                        {{ $statusLabel }}
                                    </span>
                                 </div>
                                 
                                <td><span class="text-gray-500">{{ $job->created_at->format('M d, Y') }}</span></div>
                                 
                                <td>
                                    <div class="action-buttons">
                                        <!-- View Button -->
                                        <button onclick='viewJobDetails({
                                            id: {{ $job->id }},
                                            title: "{{ addslashes($job->title) }}",
                                            company: "{{ addslashes($job->employer->employerProfile->company_name ?? 'N/A') }}",
                                            location: "{{ addslashes($job->location ?? 'Remote') }}",
                                            description: "{{ addslashes(Str::limit($job->description ?? 'No description', 200)) }}",
                                            salary: "{{ $job->salary ? '$'.number_format($job->salary).'/year' : 'Not specified' }}",
                                            experience_level: "{{ addslashes($job->experience_level ?? 'Not specified') }}",
                                            applications_count: {{ $job->applications_count ?? $job->applications->count() }},
                                            status: "{{ $job->status }}",
                                            status_label: "{{ ucfirst($job->status) }}",
                                            posted_date: "{{ $job->created_at->format('F d, Y') }}"
                                        })' class="action-btn action-view" title="View Details">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </button>

                                        <!-- Approve Button (only for pending jobs) -->
                                        @if($job->status === 'pending')
                                            <form action="{{ route('admin.jobs.approve', $job) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="action-btn action-approve" title="Approve Job"
                                                    onclick="return confirm('Approve this job? It will be visible to job seekers.')">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Approve
                                                </button>
                                            </form>

                                            <!-- Reject Button (only for pending jobs) -->
                                            <form action="{{ route('admin.jobs.reject', $job) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="action-btn action-reject" title="Reject Job"
                                                    onclick="return confirm('Reject this job? The employer will be notified.')">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Reject
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Close Button (only for active jobs) -->
                                        @if($job->status === 'active')
                                            <form action="{{ route('admin.jobs.close', $job) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="action-btn action-reject" title="Close Job"
                                                    onclick="return confirm('Close this job? It will no longer accept applications.')">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                    </svg>
                                                    Close
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn action-delete" title="Delete Job"
                                                onclick="return confirm('Are you sure you want to permanently delete this job? This action cannot be undone.')">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                 </div>
                             </div>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="empty-title">No jobs found</div>
                                        <p class="empty-sub">Jobs will appear here as employers post them on the platform</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if(isset($jobs) && method_exists($jobs, 'links') && $jobs->hasPages())
                <div class="pagination-wrapper" style="margin-top: 1.5rem;">
                    {{ $jobs->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Job Details Modal -->
    <div id="jobModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalJobTitle">Job Details</h2>
                <button class="modal-close" onclick="closeJobModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detail-row">
                    <div class="detail-label">Company:</div>
                    <div class="detail-value" id="modalCompany"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Location:</div>
                    <div class="detail-value" id="modalLocation"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Salary:</div>
                    <div class="detail-value" id="modalSalary"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Experience:</div>
                    <div class="detail-value" id="modalExperience"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Applications:</div>
                    <div class="detail-value" id="modalApplications"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value" id="modalStatus"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Posted Date:</div>
                    <div class="detail-value" id="modalPostedDate"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Description:</div>
                    <div class="detail-value" id="modalDescription"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-secondary" onclick="closeJobModal()">Close</button>
            </div>
        </div>
    </div>

    <script>
        // Job details modal functionality
        function viewJobDetails(job) {
            document.getElementById('modalJobTitle').textContent = job.title;
            document.getElementById('modalCompany').textContent = job.company;
            document.getElementById('modalLocation').textContent = job.location;
            document.getElementById('modalSalary').textContent = job.salary;
            document.getElementById('modalExperience').textContent = job.experience_level;
            document.getElementById('modalApplications').innerHTML = '<span class="text-blue-600 font-semibold">' + job.applications_count + '</span> applicants';
            
            // Status with badge
            let statusClass = '';
            switch(job.status) {
                case 'active': statusClass = 'status-active'; break;
                case 'pending': statusClass = 'status-pending'; break;
                case 'closed': statusClass = 'status-closed'; break;
                case 'rejected': statusClass = 'status-rejected'; break;
                default: statusClass = 'status-pending';
            }
            document.getElementById('modalStatus').innerHTML = '<span class="status-badge ' + statusClass + '"><span class="status-dot"></span>' + job.status_label + '</span>';
            
            document.getElementById('modalPostedDate').textContent = job.posted_date;
            document.getElementById('modalDescription').innerHTML = '<p class="whitespace-pre-wrap">' + job.description + '</p>';
            
            document.getElementById('jobModal').style.display = 'block';
        }

        function closeJobModal() {
            document.getElementById('jobModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('jobModal');
            if (event.target === modal) {
                closeJobModal();
            }
        }

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchJobs');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    const rows = document.querySelectorAll('.jobs-table tbody tr');
                    
                    rows.forEach(row => {
                        if (row.querySelector('td')) {
                            const text = row.textContent.toLowerCase();
                            const shouldShow = text.includes(searchTerm);
                            row.style.display = shouldShow ? '' : 'none';
                        }
                    });
                });
            }
        });
    </script>
@endsection