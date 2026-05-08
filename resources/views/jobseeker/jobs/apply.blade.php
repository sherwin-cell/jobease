@extends('layouts.app')

@section('title', 'Apply for ' . $job->title)

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
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background 0.15s, transform 0.1s;
        white-space: nowrap;
        gap: 8px;
    }
    .btn-primary:hover { background: #1d4ed8; transform: translateY(-1px); }

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
    .btn-secondary:hover { background: #4b5563; }

    .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fff;
        color: #6b7280;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        text-decoration: none;
        transition: background 0.15s;
    }
    .btn-outline:hover { background: #f9fafb; }

    /* ===== JOB SUMMARY CARD ===== */
    .job-summary {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 24px;
    }
    .job-summary-title {
        font-size: 1rem;
        font-weight: 600;
        color: #0f172a;
        margin: 0 0 12px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e2e8f0;
    }
    .job-summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
    }
    .job-summary-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .job-summary-label {
        font-size: 0.75rem;
        font-weight: 500;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .job-summary-value {
        font-size: 0.875rem;
        font-weight: 600;
        color: #0f172a;
    }
    .skills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 8px;
    }
    .skill-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        background: #e0f2fe;
        color: #0369a1;
        font-size: 0.75rem;
        font-weight: 500;
        border-radius: 999px;
        border: 1px solid #bae6fd;
    }

    /* ===== FORM STYLES ===== */
    .form-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        padding: 24px;
    }
    .form-group {
        margin-bottom: 20px;
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
    .file-input {
        width: 100%;
        padding: 8px;
        border: 1px dashed #d1d5db;
        border-radius: 10px;
        font-size: 0.875rem;
        background: #f9fafb;
        cursor: pointer;
        transition: all 0.15s;
    }
    .file-input:hover {
        border-color: #2563eb;
        background: #eff6ff;
    }

    /* ===== QUESTION CARD ===== */
    .question-card {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 16px;
        margin-bottom: 16px;
        transition: all 0.2s;
    }
    .question-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .question-title {
        font-size: 0.9375rem;
        font-weight: 600;
        color: #111827;
        margin: 0 0 4px;
    }
    .question-desc {
        font-size: 0.8125rem;
        color: #6b7280;
        margin: 0 0 12px;
    }

    /* ===== ACTION BUTTONS ===== */
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 16px;
        margin-top: 24px;
        padding-top: 16px;
        border-top: 1px solid #e5e7eb;
    }

    /* ===== RESPONSIVE ===== */
    /* Main content wrapper to handle sidebar */
    .apply-container {
        min-height: 100vh;
        background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
    }
    .apply-content {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1rem;
        transition: all 0.3s ease;
    }
    
    /* When sidebar is open on mobile, adjust content */
    body.sidebar-open .apply-content {
        opacity: 0.5;
        pointer-events: none;
    }
    
    @media (max-width: 640px) {
        .job-summary-grid {
            grid-template-columns: 1fr;
        }
        .action-buttons {
            flex-direction: column;
        }
        .action-buttons .btn-primary,
        .action-buttons .btn-outline {
            justify-content: center;
        }
        .form-card {
            padding: 16px;
        }
        .apply-content {
            padding: 1rem;
        }
        .page-header {
            flex-direction: column;
        }
        .page-header .btn-outline {
            width: 100%;
            justify-content: center;
        }
    }
    
    @media (min-width: 1024px) {
        .apply-content {
            padding: 2rem;
        }
    }
</style>

<div class="apply-container">
    <div class="apply-content">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Apply for {{ $job->title }}</h1>
                <p class="page-sub">Complete the form below to submit your application</p>
            </div>
            <a href="{{ route('jobseeker.jobs.show', $job) }}" class="btn-outline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Job
            </a>
        </div>

        <!-- Job Summary Card -->
        <div class="job-summary">
            <h2 class="job-summary-title">Position Overview</h2>
            <div class="job-summary-grid">
                <div class="job-summary-item">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <div>
                        <div class="job-summary-label">Job Title</div>
                        <div class="job-summary-value">{{ $job->title }}</div>
                    </div>
                </div>
                <div class="job-summary-item">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <div>
                        <div class="job-summary-label">Location</div>
                        <div class="job-summary-value">{{ $job->location ?? 'Remote / Flexible' }}</div>
                    </div>
                </div>
                <div class="job-summary-item">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <div class="job-summary-label">Salary</div>
                        <div class="job-summary-value">{{ $job->salary ? '$' . number_format($job->salary) . '/year' : 'Negotiable' }}</div>
                    </div>
                </div>
                <div class="job-summary-item">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <div>
                        <div class="job-summary-label">Experience Level</div>
                        <div class="job-summary-value">{{ ucfirst($job->experience_level ?? 'Any') }}</div>
                    </div>
                </div>
            </div>
            
            @if(!empty($skills) && count($skills) > 0)
            <div class="mt-3 pt-3 border-t border-gray-200">
                <div class="job-summary-label mb-2">Skills Required</div>
                <div class="skills-container">
                    @foreach($skills as $skill)
                    <span class="skill-badge">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Application Form -->
        <div class="form-card">
            <form method="POST" action="{{ route('jobseeker.jobs.apply.submit', $job) }}" enctype="multipart/form-data">
                @csrf

                <!-- Cover Letter -->
                <div class="form-group">
                    <label class="form-label">Cover Letter <span>(Optional)</span></label>
                    <textarea name="cover_letter" rows="6"
                        class="form-textarea @error('cover_letter') error @enderror"
                        placeholder="Tell the employer why you're a great fit for this position...">{{ old('cover_letter') }}</textarea>
                    @error('cover_letter')
                        <p class="form-error">{{ $message }}</p>
                    @else
                        <p class="form-hint">Share your motivation, relevant experience, and what makes you unique.</p>
                    @enderror
                </div>

                <!-- Resume Upload -->
                <div class="form-group">
                    <label class="form-label">Upload Resume <span>*</span></label>
                    <input type="file" name="resume"
                        class="file-input @error('resume') error @enderror"
                        accept=".pdf,.doc,.docx">
                    <p class="form-hint">Accepted formats: PDF, DOC, DOCX (Max 5MB)</p>
                    @error('resume')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Q&A Section -->
                @if(!empty($questions) && count($questions) > 0)
                <div class="form-group">
                    <label class="form-label">Additional Questions</label>
                    <div class="mt-2">
                        @foreach($questions as $question)
                        <div class="question-card">
                            <div class="question-title">{{ $question->title }}</div>
                            @if($question->description)
                            <div class="question-desc">{{ $question->description }}</div>
                            @endif
                            <textarea name="answers[{{ $question->id }}]" rows="3"
                                class="form-textarea @error('answers.' . $question->id) error @enderror"
                                placeholder="Your answer...">{{ old('answers.' . $question->id) }}</textarea>
                            @error('answers.' . $question->id)
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="submit" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Submit Application
                    </button>
                    <a href="{{ route('jobseeker.jobs.show', $job) }}" class="btn-outline">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Handle sidebar state to adjust content when hamburger menu is open
    document.addEventListener('DOMContentLoaded', function() {
        // Listen for sidebar toggle events
        const sidebar = document.getElementById('mobileSidebar');
        const menuBtn = document.getElementById('mobileMenuBtn');
        
        if (menuBtn && sidebar) {
            menuBtn.addEventListener('click', function() {
                document.body.classList.toggle('sidebar-open');
            });
            
            // Close sidebar when clicking outside (optional)
            const overlay = document.getElementById('sidebarOverlay');
            if (overlay) {
                overlay.addEventListener('click', function() {
                    document.body.classList.remove('sidebar-open');
                });
            }
        }
        
        // Adjust layout when window resizes
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                document.body.classList.remove('sidebar-open');
            }
        });
    });
</script>
@endsection