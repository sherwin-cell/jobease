@extends('layouts.app')

@section('title', 'Schedule Interview')

@section('content')
<style>
    /* ===== PAGE CONTAINER ===== */
    .full-page-container {
        min-height: 100vh;
        background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
        padding: 2rem 0;
    }
    .content-wrapper {
        max-width: 800px;
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
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background 0.15s, transform 0.1s;
        white-space: nowrap;
        gap: 8px;
    }
    .btn-primary:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }

    .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #6b7280;
        color: #fff;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background 0.15s;
        white-space: nowrap;
        gap: 8px;
    }
    .btn-secondary:hover {
        background: #4b5563;
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
        margin-bottom: 20px;
    }
    .btn-back:hover {
        background: #eff6ff;
    }

    /* ===== FORM CARD ===== */
    .form-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e5e7eb;
        background: linear-gradient(135deg, #f8fafc 0%, #fff 100%);
    }
    .card-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .card-body {
        padding: 28px;
    }
    .card-footer {
        padding: 20px 28px;
        background: #f9fafb;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    /* ===== FORM STYLES ===== */
    .form-group {
        margin-bottom: 24px;
    }
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }
    .form-label span {
        color: #ef4444;
        margin-left: 2px;
    }
    .form-input, .form-textarea, .form-select {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 0.875rem;
        color: #374151;
        transition: all 0.15s;
        background: #fff;
    }
    .form-input:focus, .form-textarea:focus, .form-select:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    .form-input.error, .form-textarea.error, .form-select.error {
        border-color: #ef4444;
    }
    .form-error {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 4px;
    }
    .form-hint {
        color: #9ca3af;
        font-size: 0.75rem;
        margin-top: 4px;
    }

    /* ===== INFO BOX ===== */
    .info-box {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .info-icon {
        width: 40px;
        height: 40px;
        background: #eff6ff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .info-content {
        flex: 1;
    }
    .info-title {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
        margin-bottom: 2px;
    }
    .info-value {
        font-size: 0.9375rem;
        font-weight: 600;
        color: #111827;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 640px) {
        .card-header, .card-body, .card-footer {
            padding: 16px;
        }
        .card-footer {
            flex-direction: column;
        }
        .card-footer .btn-primary,
        .card-footer .btn-secondary {
            justify-content: center;
        }
    }
</style>

<div class="full-page-container">
    <div class="content-wrapper">
        <!-- Back Button -->
        <a href="{{ route('employer.applications.show', $application) }}" class="btn-back">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Application
        </a>

        <!-- Form Card -->
        <div class="form-card">
            <div class="card-header">
                <h2 class="card-title">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Schedule Interview
                </h2>
                <p class="text-sm text-gray-500 mt-1">Set up an interview time with the candidate</p>
            </div>

            <form method="POST" action="{{ route('employer.interviews.schedule', $application->id) }}">
                @csrf

                <div class="card-body">
                    <!-- Candidate Info Box -->
                    <div class="info-box">
                        <div class="info-icon">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="info-content">
                            <div class="info-title">Candidate</div>
                            <div class="info-value">{{ $application->user->name }}</div>
                        </div>
                    </div>

                    <!-- Job Info Box -->
                    <div class="info-box">
                        <div class="info-icon">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="info-content">
                            <div class="info-title">Job Position</div>
                            <div class="info-value">{{ $application->job->title }}</div>
                        </div>
                    </div>

                    <!-- Interview Date & Time -->
                    <div class="form-group">
                        <label class="form-label">Interview Date & Time <span>*</span></label>
                        <input type="datetime-local" name="scheduled_at" class="form-input" required>
                        <p class="form-hint">Select a date and time that works for both parties</p>
                        @error('scheduled_at')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('employer.applications.show', $application) }}" class="btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Schedule Interview
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection