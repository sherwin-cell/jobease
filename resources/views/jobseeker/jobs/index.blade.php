@extends('layouts.app')

@section('content')

{{-- Page Header --}}
<div class="page-header">
    <div>
        <h1 class="page-title">Browse Jobs</h1>
        <p class="page-sub">Filter jobs by experience and quickly see your skill match.</p>
    </div>
    <a href="{{ route('jobseeker.profile.show') }}" class="btn-outline">
        👤 My Profile
    </a>
</div>

{{-- Filters --}}
<div class="filter-card">
    <form method="GET" action="{{ route('jobseeker.jobs.index') }}" class="filter-form">
        <div class="filter-field">
            <label class="field-label">Experience Level</label>
            <select name="experience_level" class="field-select">
                <option value="">Any experience</option>
                <option value="Junior"  @if(request('experience_level') == 'Junior')  selected @endif>Junior</option>
                <option value="Mid"     @if(request('experience_level') == 'Mid')     selected @endif>Mid</option>
                <option value="Senior"  @if(request('experience_level') == 'Senior')  selected @endif>Senior</option>
            </select>
        </div>
        <div class="filter-actions">
            <button type="submit" class="btn-primary">Apply Filters</button>
            <a href="{{ route('jobseeker.jobs.index') }}" class="btn-ghost">Reset</a>
        </div>
    </form>
</div>

{{-- Job Listings --}}
<div class="jobs-list">
    @forelse($jobs as $job)
        @php
            $candidate      = auth()->user()->profile;
            $candidateSkills = $candidate && $candidate->skills ? collect($candidate->skills) : collect();
            $jobSkills       = collect($job->skills_required ?? []);
            $matched         = $jobSkills->filter(fn($s) => $candidateSkills->contains(fn($cs) => strtolower(trim($cs)) === strtolower(trim($s))))->count();
            $match           = $jobSkills->count() ? round(($matched / $jobSkills->count()) * 100, 2) : 0;
            $matchColor      = $match >= 70 ? 'match-high' : ($match >= 40 ? 'match-mid' : 'match-low');
        @endphp

        <div class="job-card">

            {{-- Top row: title + actions --}}
            <div class="job-top">
                <div class="job-title-wrap">
                    <h2 class="job-title">
                        <a href="{{ route('jobseeker.jobs.show', $job) }}">{{ $job->title }}</a>
                    </h2>
                    <p class="job-desc">{{ Str::limit($job->description, 170) }}</p>
                </div>
                <div class="job-actions">
                    <a href="{{ route('jobseeker.jobs.show', $job) }}" class="btn-ghost">View</a>
                    <a href="{{ route('jobseeker.jobs.apply.form', $job) }}" class="btn-primary">Apply</a>
                </div>
            </div>

            {{-- Meta badges --}}
            <div class="job-meta">
                <span class="badge badge-gray">📍 {{ $job->location ?? 'N/A' }}</span>
                <span class="badge badge-gray">🧭 {{ $job->experience_level ?? 'Any' }}</span>
                <span class="badge {{ $matchColor }}">🎯 Match: {{ $match }}%</span>
            </div>

            {{-- Match bar --}}
            <div class="match-bar-wrap">
                <div class="match-bar-track">
                    <div class="match-bar-fill {{ $matchColor }}" style="width: {{ $match }}%"></div>
                </div>
            </div>

            {{-- Skills --}}
            <div class="job-skills">
                <p class="skills-label">Skills Required</p>
                <div class="skills-wrap">
                    @if($job->skills_required && count($job->skills_required) > 0)
                        @foreach($job->skills_required as $skill)
                            @php
                                $isMatch = $candidateSkills->contains(fn($cs) => strtolower(trim($cs)) === strtolower(trim($skill)));
                            @endphp
                            <span class="skill-tag {{ $isMatch ? 'skill-matched' : '' }}">
                                {{ $isMatch ? '✓' : '' }} {{ trim($skill) }}
                            </span>
                        @endforeach
                    @else
                        <span class="no-skills">No specific skills required</span>
                    @endif
                </div>
            </div>

        </div>
    @empty
        <div class="empty-state">
            <div class="empty-icon">🔍</div>
            <div class="empty-title">No jobs found</div>
            <p class="empty-sub">Try resetting the filters or check back later.</p>
            <a href="{{ route('jobseeker.jobs.index') }}" class="btn-primary">Clear Filters</a>
        </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="pagination-wrap">
    {{ $jobs->links() }}
</div>

<style>
    /* ===== PAGE HEADER ===== */
    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 20px;
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
    }
    .btn-primary:hover { background: #1d4ed8; transform: translateY(-1px); }

    .btn-ghost {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        color: #374151;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 9px 18px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.15s;
        white-space: nowrap;
    }
    .btn-ghost:hover { background: #f9fafb; }

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
        flex-shrink: 0;
    }
    .btn-outline:hover { background: #eff6ff; }

    /* ===== FILTER CARD ===== */
    .filter-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 18px 20px;
        margin-bottom: 20px;
    }
    .filter-form {
        display: flex;
        align-items: flex-end;
        gap: 12px;
        flex-wrap: wrap;
    }
    .filter-field { display: flex; flex-direction: column; gap: 6px; min-width: 180px; flex: 1; }
    .field-label { font-size: 0.8125rem; font-weight: 600; color: #374151; }
    .field-select {
        width: 100%;
        padding: 9px 12px;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        font-size: 0.875rem;
        color: #374151;
        background: #fff;
        outline: none;
        transition: border-color 0.15s;
    }
    .field-select:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.08); }
    .filter-actions { display: flex; gap: 8px; align-items: center; padding-bottom: 1px; flex-wrap: wrap; }

    /* ===== JOB LIST ===== */
    .jobs-list { display: flex; flex-direction: column; gap: 14px; }

    /* ===== JOB CARD ===== */
    .job-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 22px 24px;
        transition: box-shadow 0.15s, border-color 0.15s;
    }
    .job-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.07);
        border-color: #d1d5db;
    }

    /* Top row */
    .job-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }
    .job-title-wrap { flex: 1; min-width: 0; }
    .job-title {
        font-size: 1.0625rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 6px;
    }
    .job-title a { color: inherit; text-decoration: none; }
    .job-title a:hover { color: #2563eb; }
    .job-desc { font-size: 0.875rem; color: #6b7280; margin: 0; line-height: 1.6; }

    .job-actions {
        display: flex;
        gap: 8px;
        flex-shrink: 0;
        align-items: center;
    }

    /* Meta badges */
    .job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 14px;
    }
    .badge {
        display: inline-flex;
        align-items: center;
        font-size: 0.8125rem;
        font-weight: 500;
        padding: 4px 12px;
        border-radius: 999px;
    }
    .badge-gray { background: #f3f4f6; color: #374151; }

    /* Match color variants */
    .match-high { background: #dcfce7; color: #15803d; }
    .match-mid  { background: #fef9c3; color: #a16207; }
    .match-low  { background: #fee2e2; color: #b91c1c; }

    /* Match progress bar */
    .match-bar-wrap { margin-top: 10px; }
    .match-bar-track {
        height: 5px;
        background: #f3f4f6;
        border-radius: 999px;
        overflow: hidden;
    }
    .match-bar-fill {
        height: 100%;
        border-radius: 999px;
        transition: width 0.4s ease;
    }
    .match-bar-fill.match-high { background: #22c55e; }
    .match-bar-fill.match-mid  { background: #eab308; }
    .match-bar-fill.match-low  { background: #ef4444; }

    /* Skills */
    .job-skills { margin-top: 16px; }
    .skills-label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #9ca3af;
        margin: 0 0 8px;
    }
    .skills-wrap { display: flex; flex-wrap: wrap; gap: 7px; }
    .skill-tag {
        display: inline-flex;
        align-items: center;
        font-size: 0.8125rem;
        padding: 4px 12px;
        border-radius: 999px;
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #374151;
        gap: 4px;
    }
    .skill-matched {
        background: #eff6ff;
        border-color: #bfdbfe;
        color: #1d4ed8;
        font-weight: 600;
    }
    .no-skills { font-size: 0.875rem; color: #9ca3af; }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 48px 24px;
        text-align: center;
    }
    .empty-icon { font-size: 2.5rem; margin-bottom: 12px; }
    .empty-title { font-size: 1.0625rem; font-weight: 700; color: #111827; margin-bottom: 6px; }
    .empty-sub { font-size: 0.875rem; color: #6b7280; margin: 0 0 20px; }

    /* ===== PAGINATION ===== */
    .pagination-wrap { margin-top: 24px; }

    /* ===== RESPONSIVE: MOBILE (≤ 600px) ===== */
    @media (max-width: 600px) {
        .page-header { flex-direction: column; gap: 12px; }
        .btn-outline { width: 100%; justify-content: center; }

        .filter-form { flex-direction: column; }
        .filter-field { min-width: 100%; }
        .filter-actions { width: 100%; }
        .filter-actions .btn-primary,
        .filter-actions .btn-ghost { flex: 1; }

        .job-card { padding: 16px; }

        .job-top { flex-direction: column; gap: 12px; }
        .job-actions { width: 100%; }
        .job-actions .btn-ghost,
        .job-actions .btn-primary { flex: 1; }
    }
</style>

@endsection