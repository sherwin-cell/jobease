@extends('layouts.app')

@section('title', 'Application Details - ' . $application->job->title)

@section('content')
    <style>
        /* ===== PAGE CONTAINER ===== */
        .full-page-container {
            min-height: 100vh;
            background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
            padding: 2rem 0;
        }

        .content-wrapper {
            max-width: 900px;
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

        .btn-success {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #10b981;
            color: #fff;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 9px 18px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.15s;
            white-space: nowrap;
            gap: 6px;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 9px 18px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            text-decoration: none;
            transition: background 0.15s;
        }

        .btn-outline:hover {
            background: #f9fafb;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            color: #2563eb;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.15s;
        }

        .btn-back:hover {
            background: #eff6ff;
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

        /* ===== INFO CARDS ===== */
        .info-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .info-card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .info-label {
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #9ca3af;
        }

        .info-value {
            font-size: 0.9375rem;
            font-weight: 500;
            color: #111827;
        }

        .info-value a {
            color: #2563eb;
            text-decoration: none;
        }

        .info-value a:hover {
            text-decoration: underline;
        }

        /* ===== STATUS BADGE ===== */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-pending {
            background: #fef9c3;
            color: #a16207;
        }

        .status-shortlisted {
            background: #dbeafe;
            color: #1d4ed8;
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

        /* ===== CONTENT CARD ===== */
        .content-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .content-title {
            font-size: 0.9375rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .content-text {
            font-size: 0.875rem;
            color: #4b5563;
            line-height: 1.6;
            white-space: pre-wrap;
            margin: 0;
        }

        .file-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
        }

        .file-name {
            font-size: 0.8125rem;
            color: #6b7280;
            font-family: monospace;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ===== FORM SECTION ===== */
        .form-section {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .form-title {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 0.875rem;
            color: #374151;
            background: #fff;
            transition: all 0.15s;
        }

        .form-select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 0.875rem;
            color: #374151;
            transition: all 0.15s;
        }

        .form-input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-error {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 4px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 16px;
        }

        /* ===== BACK LINK ===== */
        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 640px) {
            .info-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .file-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn-primary,
            .form-actions .btn-success {
                justify-content: center;
            }
        }
    </style>

    <div class="full-page-container">
        <div class="content-wrapper">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Application Details</h1>
                    <p class="page-sub">Review candidate information and manage application status</p>
                </div>
                <a href="{{ route('employer.applications.index') }}" class="btn-back">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Applications
                </a>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="alert-success">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Applicant Info Card -->
            <div class="info-card">
                <h2 class="info-card-title">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Candidate Information
                </h2>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Job Position</span>
                        <span class="info-value">{{ $application->job->title }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Applicant Name</span>
                        <span class="info-value">{{ $application->user->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email Address</span>
                        <span class="info-value">
                            <a href="mailto:{{ $application->user->email }}">{{ $application->user->email }}</a>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Applied On</span>
                        <span class="info-value">{{ $application->created_at->format('F j, Y \a\t g:i A') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Current Status</span>
                        <span class="info-value">
                            @php
                                $statusClass = match ($application->status) {
                                    'pending' => 'status-pending',
                                    'shortlisted' => 'status-shortlisted',
                                    'interview' => 'status-interview',
                                    'interview_scheduled' => 'status-interview_scheduled',
                                    'rejected' => 'status-rejected',
                                    'hired' => 'status-hired',
                                    default => 'status-pending'
                                };
                                $statusLabel = match ($application->status) {
                                    'pending' => 'Pending Review',
                                    'shortlisted' => 'Shortlisted',
                                    'interview' => 'Interview',
                                    'interview_scheduled' => 'Interview Scheduled',
                                    'rejected' => 'Not Selected',
                                    'hired' => 'Hired',
                                    default => ucfirst(str_replace('_', ' ', $application->status))
                                };
                            @endphp
                            <span class="status-badge {{ $statusClass }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-current opacity-60"></span>
                                {{ $statusLabel }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Cover Letter Card -->
            @if($application->cover_letter)
                <div class="content-card">
                    <h3 class="content-title">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Cover Letter
                    </h3>
                    <p class="content-text">{{ $application->cover_letter }}</p>
                </div>
            @endif

            <!-- Resume Card -->
            @if($application->resume)
                <div class="content-card">
                    <h3 class="content-title">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Resume / CV
                    </h3>
                    <div class="file-info">
                        <span class="file-name">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            {{ basename($application->resume) }}
                        </span>
                        <a href="{{ asset('storage/' . $application->resume) }}" target="_blank" class="btn-primary"
                            style="background: #4b5563; padding: 6px 14px;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download Resume
                        </a>
                    </div>
                </div>
            @endif

            <!-- Update Status Form -->
            <div class="form-section">
                <h3 class="form-title">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Update Application Status
                </h3>
                <form method="POST" action="{{ route('employer.applications.updateStatus', $application->id) }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Change Status</label>
                        <div class="flex gap-2">
                            <select name="status" class="form-select">
                                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>
                                    ⟳ Pending Review
                                </option>
                                <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>
                                    ★ Shortlisted
                                </option>
                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>
                                    ✗ Not Selected
                                </option>
                                <option value="hired" {{ $application->status == 'hired' ? 'selected' : '' }}>
                                    ✓ Hired
                                </option>
                            </select>
                            <button type="submit" class="btn-success">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Update Status
                            </button>
                        </div>
                        @error('status')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </form>
            </div>

            <!-- Schedule Interview Form (Only for shortlisted candidates) -->
            @if($application->status === 'shortlisted')
                <div class="form-section">
                    <h3 class="form-title">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Schedule Interview
                    </h3>
                    <form method="POST" action="{{ route('employer.interviews.schedule', $application->id) }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Interview Date & Time</label>
                            <input type="datetime-local" name="scheduled_at" class="form-input" required>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Schedule Interview
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- Back Link -->
            <div class="back-link">
                <a href="{{ route('employer.applications.index') }}" class="btn-outline">
                    ← Back to All Applications
                </a>
            </div>
        </div>
    </div>
@endsection