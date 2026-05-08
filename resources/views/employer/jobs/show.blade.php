@extends('layouts.app')

@section('title', $job->title)

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
        color: #6b7280;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 9px 18px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        text-decoration: none;
        transition: background 0.15s;
    }
    .btn-outline:hover { background: #f9fafb; }

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
    .btn-back:hover { background: #eff6ff; }

    /* ===== JOB CARD ===== */
    .job-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .job-header {
        padding: 24px 28px;
        border-bottom: 1px solid #e5e7eb;
        background: linear-gradient(135deg, #f8fafc 0%, #fff 100%);
    }
    .job-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 12px;
        line-height: 1.3;
    }
    .job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .job-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.875rem;
        color: #6b7280;
    }
    .job-body {
        padding: 28px;
    }
    .job-section {
        margin-bottom: 28px;
    }
    .job-section:last-child {
        margin-bottom: 0;
    }
    .section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin: 0 0 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e5e7eb;
    }
    .section-content {
        font-size: 0.9375rem;
        color: #4b5563;
        line-height: 1.7;
        white-space: pre-line;
    }

    /* ===== SKILLS ===== */
    .skills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .skill-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 14px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 0.8125rem;
        font-weight: 500;
        border-radius: 999px;
        border: 1px solid #bfdbfe;
    }
    .empty-text {
        color: #9ca3af;
        font-size: 0.875rem;
    }

    /* ===== FOOTER ===== */
    .job-footer {
        padding: 16px 28px;
        background: #f9fafb;
        border-top: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }
    .job-date {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        color: #9ca3af;
    }

    /* ===== HEADER ACTIONS ===== */
    .header-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 640px) {
        .job-header {
            padding: 16px 20px;
        }
        .job-body {
            padding: 20px;
        }
        .job-footer {
            padding: 12px 20px;
            flex-direction: column;
            text-align: center;
        }
        .job-title {
            font-size: 1.35rem;
        }
        .job-meta {
            gap: 12px;
        }
    }
</style>

<div class="full-page-container">
    <div class="content-wrapper">
        <!-- Header Actions -->
        <div class="header-actions">
            <a href="{{ route('employer.jobs.index') }}" class="btn-back">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to My Jobs
            </a>
            <a href="{{ route('employer.jobs.edit', $job) }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Job
            </a>
        </div>

        <!-- Job Card -->
        <div class="job-card">
            <!-- Header -->
            <div class="job-header">
                <h1 class="job-title">{{ $job->title }}</h1>
                <div class="job-meta">
                    <span class="job-meta-item">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $job->location ?? 'Location not specified' }}
                    </span>
                    <span class="job-meta-item">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $job->salary ? '$' . number_format($job->salary) . '/year' : 'Salary negotiable' }}
                    </span>
                    <span class="job-meta-item">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        {{ ucfirst($job->experience_level ?? 'Any level') }}
                    </span>
                    <span class="job-meta-item">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Posted {{ $job->created_at?->diffForHumans() }}
                    </span>
                </div>
            </div>

            <!-- Body -->
            <div class="job-body">
                <!-- Skills Section -->
                <div class="job-section">
                    <h2 class="section-title">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Required Skills
                    </h2>
                    @if($job->skills_required && is_array($job->skills_required) && count($job->skills_required) > 0)
                        <div class="skills-container">
                            @foreach($job->skills_required as $skill)
                                <span class="skill-tag">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ trim($skill) }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="empty-text">No specific skills required.</p>
                    @endif
                </div>

                <!-- Description Section -->
                <div class="job-section">
                    <h2 class="section-title">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        Job Description
                    </h2>
                    <div class="section-content">
                        {{ $job->description }}
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="job-footer">
                <div class="job-date">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Created on {{ $job->created_at?->format('F j, Y') }}
                </div>
                <div class="job-date">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Status: <span class="font-semibold text-green-600">{{ ucfirst($job->status ?? 'Active') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection