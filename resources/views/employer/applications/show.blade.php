@extends('layouts.app')

@section('title', 'Application Details - ' . $application->job->title)

@section('content')
<style>
    /* ============================================================
       GLOBAL RESET
    ============================================================ */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    /* ============================================================
       PAGE CONTAINER
    ============================================================ */
    .full-page-container {
        min-height: 100vh;
        background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
        padding: 2rem 0;
    }

    .content-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    /* ============================================================
       PAGE HEADER
    ============================================================ */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;  /* FIXED: was 'nowrap' */
        margin-bottom: 24px;
    }

    .page-header > div:first-child {
        flex: 1;
        min-width: 0;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 4px;
        line-height: 1.2;
        word-break: break-word;
    }

    .page-sub {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0;
    }

    /* ============================================================
       BUTTONS
    ============================================================ */
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
        gap: 6px;
        white-space: normal;  /* FIXED: was 'nowrap' */
        text-align: center;
        word-break: keep-all;
    }

    .btn-primary svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
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
        white-space: normal;  /* FIXED: was 'nowrap' */
        text-align: center;
        word-break: keep-all;
    }

    .btn-outline svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
    }

    .btn-outline:hover {
        background: #eff6ff;
    }

    .btn-success {
        background: #10b981;
    }

    .btn-success:hover {
        background: #059669;
    }

    /* ============================================================
       TWO COLUMN LAYOUT
    ============================================================ */
    .two-columns {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    /* ============================================================
       CARDS
    ============================================================ */
    .card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: all 0.2s;
        overflow-x: auto;
    }

    .card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
        border-color: #d1d5db;
    }

    .card-title {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-title svg {
        width: 18px;
        height: 18px;
        color: #6b7280;
        flex-shrink: 0;
    }

    /* ============================================================
       INFO GRID
    ============================================================ */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .info-item {
        padding: 0.75rem;
        background: #f9fafb;
        border-radius: 12px;
        word-break: break-word;
    }

    .info-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 600;
        color: #6b7280;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-size: 0.9rem;
        font-weight: 600;
        color: #111827;
        word-break: break-word;
    }

    .info-value a {
        color: #2563eb;
        text-decoration: none;
        word-break: break-all;
    }

    .info-value a:hover {
        text-decoration: underline;
    }

    /* ============================================================
       STATUS BADGE
    ============================================================ */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 0.6875rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-badge span {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: currentColor;
        opacity: 0.6;
        flex-shrink: 0;
    }

    .status-pending { background: #fef9c3; color: #a16207; }
    .status-shortlisted { background: #dbeafe; color: #1e40af; }
    .status-interview { background: #fce7f3; color: #be185d; }
    .status-interview_scheduled { background: #dcfce7; color: #15803d; }
    .status-rejected { background: #fee2e2; color: #b91c1c; }
    .status-hired { background: #dcfce7; color: #15803d; }

    /* ============================================================
       SKILL REVIEW CARD
    ============================================================ */
    .skill-review-card {
        background: #fff;
        border: 2px solid #e5e7eb;
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: all 0.2s;
    }

    .skill-review-card:hover {
        border-color: #d1d5db;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .skill-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f3f4f6;
    }

    .skill-header .card-title {
        margin: 0;
        padding: 0;
        border: none;
    }

    .match-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 0.6875rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .match-high { background: #dcfce7; color: #15803d; }
    .match-medium { background: #fef9c3; color: #a16207; }
    .match-low { background: #fee2e2; color: #b91c1c; }

    .skill-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 0.6875rem;
        font-weight: 500;
        white-space: nowrap;
    }

    .skill-tag svg {
        width: 10px;
        height: 10px;
        flex-shrink: 0;
    }

    .skill-matched {
        background: #dbeafe;
        color: #1e40af;
        border-left: 3px solid #3b82f6;
    }

    .skill-missing {
        background: #f3f4f6;
        color: #6b7280;
        border-left: 3px solid #9ca3af;
    }

    .progress-bar {
        background: #e5e7eb;
        border-radius: 20px;
        height: 8px;
        overflow: hidden;
        margin: 1rem 0 0.5rem;
    }

    .progress-fill {
        height: 100%;
        border-radius: 20px;
        transition: width 0.3s ease;
    }

    .skills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin: 1rem 0;
    }

    /* ============================================================
       FORM ELEMENTS
    ============================================================ */
    .form-select, .form-input, .form-textarea {
        width: 100%;
        padding: 0.5rem 0.875rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        font-size: 0.8rem;
        transition: all 0.2s;
        font-family: inherit;
    }

    .form-select:focus, .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-textarea {
        resize: vertical;
    }

    /* ============================================================
       RESUME ROW
    ============================================================ */
    .resume-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .file-name {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        word-break: break-word;
        flex: 1;
        min-width: 0;
    }

    .file-name span {
        font-size: 0.8rem;
        word-break: break-all;
    }

    /* ============================================================
       COVER LETTER
    ============================================================ */
    .cover-letter-content {
        background: #f9fafb;
        padding: 1rem;
        border-radius: 12px;
        line-height: 1.6;
        white-space: pre-wrap;
        font-size: 0.8rem;
        word-break: break-word;
    }

    /* ============================================================
       ALERTS
    ============================================================ */
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
        font-size: 0.8rem;
    }

    .alert-success svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    img, svg {
        max-width: 100%;
        height: auto;
    }

    /* ============================================================
       RESPONSIVE DESIGN
    ============================================================ */

    /* Tablet (900px and below) - Earlier grid change */
    @media (max-width: 900px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Tablet (768px and below) */
    @media (max-width: 768px) {
        .full-page-container {
            padding: 1rem 0;
        }

        .content-wrapper {
            padding: 0 1rem;
        }

        .page-title {
            font-size: 1.25rem;
        }

        .page-sub {
            font-size: 0.75rem;
        }

        .two-columns {
            gap: 1rem;
        }

        .card, .skill-review-card {
            padding: 1.25rem;
        }
    }

    /* Mobile (640px and below) - Card Layout */
    @media (max-width: 640px) {
        .full-page-container {
            padding: 0.75rem 0;
        }

        .content-wrapper {
            padding: 0 0.75rem;
        }

        /* Page Header */
        .page-header {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
            margin-bottom: 16px;
        }

        .page-header .btn-outline {
            width: 100%;
            justify-content: center;
        }

        .page-title {
            font-size: 1.125rem;
        }

        .page-sub {
            font-size: 0.7rem;
        }

        /* Two columns become single column */
        .two-columns {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .card, .skill-review-card {
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .card-title svg {
            width: 16px;
            height: 16px;
        }

        /* Info items */
        .info-item {
            padding: 0.6rem;
        }

        .info-label {
            font-size: 0.6rem;
        }

        .info-value {
            font-size: 0.8rem;
        }

        /* Status badge */
        .status-badge {
            font-size: 0.65rem;
            padding: 3px 10px;
            white-space: nowrap;
        }

        /* Skill header */
        .skill-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .skill-tag {
            font-size: 0.65rem;
            padding: 3px 8px;
            white-space: nowrap;
        }

        /* Resume row */
        .resume-row {
            flex-direction: column;
            align-items: stretch;
        }

        .file-name {
            justify-content: flex-start;
        }

        /* Buttons */
        .btn-primary, .btn-outline {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
            width: 100%;
        }

        .btn-primary svg, .btn-outline svg {
            width: 12px;
            height: 12px;
        }

        /* Form elements */
        .form-select, .form-input, .form-textarea {
            padding: 0.4rem 0.75rem;
            font-size: 0.75rem;
        }

        /* Alert */
        .alert-success {
            padding: 10px 14px;
            font-size: 0.7rem;
            margin-bottom: 1rem;
        }

        .alert-success svg {
            width: 14px;
            height: 14px;
        }

        /* Cover letter */
        .cover-letter-content {
            padding: 0.75rem;
            font-size: 0.7rem;
        }
    }

    /* Very Small Phones (480px and below) */
    @media (max-width: 480px) {
        .full-page-container {
            padding: 0.5rem 0;
        }

        .content-wrapper {
            padding: 0 0.5rem;
        }

        .page-title {
            font-size: 1rem;
        }

        .page-sub {
            font-size: 0.6rem;
        }

        .page-header .btn-outline {
            font-size: 0.7rem;
            padding: 7px 14px;
        }

        .page-header .btn-outline svg {
            width: 12px;
            height: 12px;
        }

        .card, .skill-review-card {
            padding: 0.875rem;
        }

        .card-title {
            font-size: 0.8rem;
        }

        .skill-tag {
            font-size: 0.6rem;
            padding: 2px 6px;
        }

        .match-badge {
            font-size: 0.65rem;
            padding: 3px 10px;
        }

        .progress-bar {
            height: 6px;
        }

        .btn-primary, .btn-outline {
            padding: 0.4rem 0.875rem;
            font-size: 0.7rem;
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
            <a href="{{ route('employer.applications.index') }}" class="btn-outline">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Applications
            </a>
        </div>

        <div class="two-columns">
            <!-- Left Column -->
            <div>
                <!-- Candidate Info Card -->
                <div class="card">
                    <div class="card-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Candidate Information
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Full Name</div>
                            <div class="info-value">{{ $application->user->name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value">
                                <a href="mailto:{{ $application->user->email }}">{{ $application->user->email }}</a>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Applied On</div>
                            <div class="info-value">{{ $application->created_at->format('M d, Y \a\t g:i A') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Current Status</div>
                            <div class="info-value">
                                @php
                                    $statusClass = match($application->status) {
                                        'pending' => 'status-pending',
                                        'shortlisted' => 'status-shortlisted',
                                        'interview' => 'status-interview',
                                        'interview_scheduled' => 'status-interview_scheduled',
                                        'rejected' => 'status-rejected',
                                        'hired' => 'status-hired',
                                        default => 'status-pending'
                                    };
                                    $statusLabel = match($application->status) {
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
                                    <span></span>
                                    {{ $statusLabel }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Job Info Card -->
                <div class="card">
                    <div class="card-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Position Details
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Job Title</div>
                            <div class="info-value">{{ $application->job->title }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Location</div>
                            <div class="info-value">{{ $application->job->location ?? 'Remote / Flexible' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Salary Range</div>
                            <div class="info-value">{{ $application->job->salary ? '$' . number_format($application->job->salary) . '/year' : 'Negotiable' }}</div>
                        </div>
                    </div>
                </div>
                
                <!-- Cover Letter Card -->
                @if($application->cover_letter)
                    <div class="card">
                        <div class="card-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Cover Letter
                        </div>
                        <div class="cover-letter-content">
                            {{ $application->cover_letter }}
                        </div>
                    </div>
                @endif
                
                <!-- Resume Card -->
                @if($application->resume)
                    <div class="card">
                        <div class="card-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Resume / CV
                        </div>
                        <div class="resume-row">
                            <div class="file-name">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #6b7280; flex-shrink: 0;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>{{ basename($application->resume) }}</span>
                            </div>
                            <a href="{{ $application->resume }}" target="_blank" class="btn-primary" style="background: #475569; width: auto;">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Right Column -->
            <div>
                <!-- Skill Assessment Card -->
                @php
                    $jobSkills = [];
                    if ($application->job->skills_required) {
                        if (is_string($application->job->skills_required)) {
                            $jobSkills = array_map('trim', explode(',', $application->job->skills_required));
                        } elseif (is_array($application->job->skills_required)) {
                            $jobSkills = $application->job->skills_required;
                        }
                    }
                    $jobSkills = array_filter($jobSkills);
                    
                    $candidateProfile = $application->user->jobseekerProfile;
                    $candidateSkills = [];
                    if ($candidateProfile && $candidateProfile->skills) {
                        if (is_string($candidateProfile->skills)) {
                            $candidateSkills = array_map('trim', explode(',', $candidateProfile->skills));
                        } elseif (is_array($candidateProfile->skills)) {
                            $candidateSkills = $candidateProfile->skills;
                        }
                    }
                    $candidateSkills = array_filter($candidateSkills);
                    
                    $jobSkillsLower = array_map('strtolower', $jobSkills);
                    $candidateSkillsLower = array_map('strtolower', $candidateSkills);
                    
                    $matchedSkills = [];
                    $missingSkills = [];
                    
                    foreach ($jobSkills as $index => $jobSkill) {
                        $jobSkillLower = $jobSkillsLower[$index];
                        if (in_array($jobSkillLower, $candidateSkillsLower)) {
                            $matchedSkills[] = $jobSkill;
                        } else {
                            $missingSkills[] = $jobSkill;
                        }
                    }
                    
                    $totalRequired = count($jobSkills);
                    $matchedCount = count($matchedSkills);
                    $matchPercentage = $totalRequired > 0 ? round(($matchedCount / $totalRequired) * 100) : 0;
                    $matchLevel = $matchPercentage >= 70 ? 'high' : ($matchPercentage >= 40 ? 'medium' : 'low');
                @endphp
                
                <div class="skill-review-card">
                    <div class="skill-header">
                        <div class="card-title" style="margin: 0; padding: 0; border: none;">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                            </svg>
                            Skills Assessment
                        </div>
                        @if($totalRequired > 0)
                            <div class="match-badge match-{{ $matchLevel }}">
                                {{ $matchPercentage }}% Match
                            </div>
                        @endif
                    </div>
                    
                    @if($totalRequired > 0)
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $matchPercentage }}%; background: {{ $matchLevel === 'high' ? '#10b981' : ($matchLevel === 'medium' ? '#f59e0b' : '#ef4444') }};"></div>
                        </div>
                        <div style="font-size: 0.7rem; color: #6b7280; text-align: right; margin-bottom: 1rem;">
                            {{ $matchedCount }} of {{ $totalRequired }} skills matched
                        </div>
                    @endif
                    
                    @if(!empty($candidateSkills))
                        <div style="margin-bottom: 1rem; padding: 0.75rem; background: #f0fdf4; border-radius: 10px;">
                            <div class="info-label" style="color: #15803d;">Candidate's Skills</div>
                            <div class="skills-container" style="margin: 0.5rem 0 0 0;">
                                @foreach($candidateSkills as $skill)
                                    <span style="background: #dcfce7; color: #15803d; padding: 0.2rem 0.7rem; border-radius: 6px; font-size: 0.65rem; font-weight: 500;">
                                        {{ ucfirst($skill) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    @if($totalRequired > 0)
                        <div class="skills-container">
                            @foreach($matchedSkills as $skill)
                                <span class="skill-tag skill-matched">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ ucfirst($skill) }}
                                </span>
                            @endforeach
                            @foreach($missingSkills as $skill)
                                <span class="skill-tag skill-missing">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    {{ ucfirst($skill) }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <div style="color: #6b7280; font-style: italic; padding: 1rem 0; font-size: 0.8rem;">
                            No specific skills defined for this position.
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('employer.applications.updateSkillReview', $application) }}">
                        @csrf
                        @method('PUT')
                        <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                            <label class="info-label" style="margin-bottom: 0.5rem;">Reviewer Notes</label>
                            <textarea name="skill_notes" rows="3" class="form-textarea" placeholder="Add your assessment notes about this candidate's skills...">{{ $application->skill_notes ?? '' }}</textarea>
                            <div style="margin-top: 0.75rem; text-align: right;">
                                <button type="submit" class="btn-primary" style="background: #475569; width: auto;">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Save Notes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Update Status Card -->
                <div class="card">
                    <div class="card-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Update Status
                    </div>
                    <form method="POST" action="{{ route('employer.applications.updateStatus', $application) }}">
                        @csrf
                        @method('PUT')
                        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                            <select name="status" class="form-select" style="flex: 1;">
                                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending Review</option>
                                <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                <option value="interview" {{ $application->status == 'interview' ? 'selected' : '' }}>Interview</option>
                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Not Selected</option>
                                <option value="hired" {{ $application->status == 'hired' ? 'selected' : '' }}>Hired</option>
                            </select>
                            <button type="submit" class="btn-primary btn-success" style="width: auto;">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Update Status
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Schedule Interview Card -->
                @if($application->status === 'shortlisted')
                    <div class="card">
                        <div class="card-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Schedule Interview
                        </div>
                        <form method="POST" action="{{ route('employer.interviews.schedule', $application) }}">
                            @csrf
                            <div style="margin-bottom: 1rem;">
                                <label class="info-label" style="margin-bottom: 0.5rem;">Interview Date & Time</label>
                                <input type="datetime-local" name="scheduled_at" class="form-input" required>
                            </div>
                            <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Schedule Interview
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection