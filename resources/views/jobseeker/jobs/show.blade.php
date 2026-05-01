@extends('layouts.app')

@section('title', $job->title)

@section('content')

<div class="job-detail-wrapper">

    {{-- Back link --}}
    <a href="{{ route('jobseeker.jobs.index') }}" class="back-link">
        ← Back to Jobs
    </a>

    <div class="job-card">

        {{-- Header --}}
        <div class="job-header">
            <div class="job-header-text">
                <h1 class="job-title">{{ $job->title }}</h1>
                @if($job->location)
                    <p class="job-location">📍 {{ $job->location }}</p>
                @endif
            </div>
            <a href="{{ route('jobseeker.jobs.apply.form', $job) }}" class="apply-btn">
                Apply Now
            </a>
        </div>

        <div class="divider"></div>

        {{-- Details grid --}}
        <div class="job-meta-grid">

            <div class="meta-item">
                <span class="meta-icon">🎓</span>
                <div>
                    <p class="meta-label">Experience Level</p>
                    <p class="meta-value">{{ $job->experience_level ?? 'Any level' }}</p>
                </div>
            </div>

            <div class="meta-item">
                <span class="meta-icon">💰</span>
                <div>
                    <p class="meta-label">Salary</p>
                    <p class="meta-value">{{ $job->salary ?? 'Negotiable' }}</p>
                </div>
            </div>

            <div class="meta-item">
                <span class="meta-icon">📍</span>
                <div>
                    <p class="meta-label">Location</p>
                    <p class="meta-value">{{ $job->location ?? 'Not specified' }}</p>
                </div>
            </div>

        </div>

        <div class="divider"></div>

        {{-- Description --}}
        <div class="job-section">
            <h2 class="section-title">Job Description</h2>
            <p class="job-description">{{ $job->description }}</p>
        </div>

        {{-- Skills --}}
        <div class="job-section">
            <h2 class="section-title">Skills Required</h2>
            @if($job->skills_required && count($job->skills_required) > 0)
                <div class="skills-list">
                    @foreach($job->skills_required as $skill)
                        <span class="skill-tag">{{ $skill }}</span>
                    @endforeach
                </div>
            @else
                <p class="meta-value">No specific skills listed.</p>
            @endif
        </div>

        <div class="divider"></div>

        {{-- Apply CTA --}}
        <div class="apply-footer">
            <p class="apply-note">Ready to take the next step?</p>
            <a href="{{ route('jobseeker.jobs.apply.form', $job) }}" class="apply-btn apply-btn-lg">
                Apply for this Job →
            </a>
        </div>

    </div>
</div>

<style>
    /* ===== WRAPPER ===== */
    .job-detail-wrapper {
        width: 100%;
        max-width: 760px;
        margin: 0 auto;
        padding: 0 0 40px;
    }

    /* ===== BACK LINK ===== */
    .back-link {
        display: inline-flex;
        align-items: center;
        font-size: 0.8125rem;
        font-weight: 500;
        color: #6b7280;
        text-decoration: none;
        margin-bottom: 20px;
        transition: color 0.15s;
    }
    .back-link:hover { color: #2563eb; }

    /* ===== CARD ===== */
    .job-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 32px;
        box-shadow: 0 1px 6px rgba(0,0,0,0.05);
    }

    /* ===== HEADER ===== */
    .job-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }
    .job-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 6px;
        line-height: 1.25;
    }
    .job-location {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0;
    }

    /* ===== APPLY BUTTON ===== */
    .apply-btn {
        display: inline-flex;
        align-items: center;
        background: #16a34a;
        color: #fff;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 10px 22px;
        border-radius: 10px;
        text-decoration: none;
        white-space: nowrap;
        flex-shrink: 0;
        transition: background 0.15s, transform 0.1s;
    }
    .apply-btn:hover {
        background: #15803d;
        transform: translateY(-1px);
    }
    .apply-btn:active { transform: translateY(0); }

    /* ===== DIVIDER ===== */
    .divider {
        border: none;
        border-top: 1px solid #f3f4f6;
        margin: 24px 0;
    }

    /* ===== META GRID ===== */
    .job-meta-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
    .meta-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: #f9fafb;
        border: 1px solid #f3f4f6;
        border-radius: 12px;
        padding: 14px;
    }
    .meta-icon { font-size: 20px; flex-shrink: 0; margin-top: 1px; }
    .meta-label {
        font-size: 0.75rem;
        color: #9ca3af;
        margin: 0 0 3px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .meta-value {
        font-size: 0.9rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    /* ===== SECTIONS ===== */
    .job-section { margin-bottom: 24px; }
    .job-section:last-of-type { margin-bottom: 0; }

    .section-title {
        font-size: 0.9375rem;
        font-weight: 700;
        color: #374151;
        margin: 0 0 12px;
        letter-spacing: -0.01em;
    }
    .job-description {
        font-size: 0.9rem;
        color: #4b5563;
        line-height: 1.75;
        margin: 0;
        white-space: pre-line;
    }

    /* ===== SKILLS ===== */
    .skills-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .skill-tag {
        display: inline-flex;
        align-items: center;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 0.8125rem;
        font-weight: 500;
        padding: 5px 12px;
        border-radius: 999px;
        border: 1px solid #bfdbfe;
    }

    /* ===== APPLY FOOTER ===== */
    .apply-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }
    .apply-note {
        font-size: 0.9rem;
        color: #6b7280;
        margin: 0;
        font-weight: 500;
    }
    .apply-btn-lg {
        padding: 12px 28px;
        font-size: 0.9375rem;
        border-radius: 12px;
    }

    /* ===== RESPONSIVE: TABLET (≤ 900px) ===== */
    @media (max-width: 900px) {
        .job-meta-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* ===== RESPONSIVE: MOBILE (≤ 600px) ===== */
    @media (max-width: 600px) {
        .job-card {
            padding: 20px 16px;
            border-radius: 14px;
        }

        .job-header {
            flex-direction: column;
            gap: 14px;
        }

        .apply-btn {
            width: 100%;
            justify-content: center;
        }

        .job-title { font-size: 1.25rem; }

        .job-meta-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .apply-footer {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }

        .apply-btn-lg {
            width: 100%;
            justify-content: center;
        }
    }
</style>

@endsection