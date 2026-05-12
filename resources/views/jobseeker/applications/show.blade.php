@extends('layouts.app')

@section('title', 'Application Details - ' . $application->job->title)

@section('content')
<style>
    /* ============================================================
       GLOBAL VARIABLES & RESET
    ============================================================ */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* ============================================================
       CONTAINER
    ============================================================ */
    .details-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #f5f7fa 0%, #e9edf2 100%);
        padding: 2rem;
    }
    
    .details-content {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* ============================================================
       CARD STYLES
    ============================================================ */
    .card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 1.75rem;
        margin-bottom: 1.5rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }
    
    .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .card-title svg {
        width: 1.25rem;
        height: 1.25rem;
        color: #3b82f6;
        flex-shrink: 0;
    }
    
    /* Header Card */
    .header-card {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        color: white;
    }
    
    .header-card a {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.5rem 1rem;
        border-radius: 10px;
        transition: all 0.2s;
        text-decoration: none;
        color: white;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
    }
    
    .header-card a:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-1px);
    }
    
    .header-card svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }
    
    .header-card > div {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    /* ============================================================
       INFO GRID
    ============================================================ */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }
    
    .info-item {
        padding: 0.75rem;
        background: #f8fafc;
        border-radius: 12px;
        transition: background 0.2s;
    }
    
    .info-item:hover {
        background: #f1f5f9;
    }
    
    .info-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 600;
        color: #64748b;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }
    
    .info-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #0f172a;
        word-break: break-word;
    }

    /* ============================================================
       STATUS BADGES
    ============================================================ */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.25rem;
        border-radius: 999px;
        font-size: 0.875rem;
        font-weight: 600;
        flex-wrap: wrap;
    }
    
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-accepted { background: #dcfce7; color: #166534; }
    .status-rejected { background: #fee2e2; color: #991b1b; }
    .status-interview { background: #dbeafe; color: #1e40af; }
    .status-interview_scheduled { background: #dbeafe; color: #1e40af; }
    .status-shortlisted { background: #fef3c7; color: #92400e; }

    /* ============================================================
       CONTENT BOX
    ============================================================ */
    .content-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.25rem;
        border: 1px solid #e2e8f0;
        line-height: 1.6;
        white-space: pre-wrap;
        word-break: break-word;
    }

    /* ============================================================
       RESUME CARD
    ============================================================ */
    .resume-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }
    
    .resume-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
        min-width: 0;
    }
    
    .resume-info svg {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
    }
    
    .resume-info div {
        min-width: 0;
    }
    
    .resume-info p {
        word-break: break-all;
    }

    /* ============================================================
       BUTTONS
    ============================================================ */
    .btn-primary, .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.5rem;
        font-weight: 600;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        font-size: 0.875rem;
    }
    
    .btn-primary {
        background: #3b82f6;
        color: white;
        border: none;
    }
    
    .btn-primary:hover {
        background: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    .btn-primary svg {
        width: 18px;
        height: 18px;
    }
    
    .btn-outline {
        background: white;
        color: #3b82f6;
        border: 2px solid #e2e8f0;
    }
    
    .btn-outline:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }
    
    .btn-outline svg {
        width: 18px;
        height: 18px;
    }
    
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }

    /* ============================================================
       ALERT
    ============================================================ */
    .alert-success {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #15803d;
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .alert-success svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    /* ============================================================
       META TEXT
    ============================================================ */
    .meta-text {
        font-size: 0.75rem;
        color: #64748b;
        margin-top: 0.5rem;
    }

    /* ============================================================
       SKILLS TAGS
    ============================================================ */
    .skills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .skill-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.875rem;
        background: #e0e7ff;
        color: #1e3a8a;
        font-size: 0.75rem;
        font-weight: 500;
        border-radius: 999px;
    }
    
    .skill-tag svg {
        width: 12px;
        height: 12px;
        flex-shrink: 0;
    }
    
    .skill-tag.matched {
        background: #16a34a;
        color: white;
    }
    
    .skill-tag.missing {
        background: #fee2e2;
        color: #991b1b;
    }

    /* ============================================================
       MATCH CARD
    ============================================================ */
    .match-card {
        background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
        border-radius: 16px;
        padding: 1.5rem;
        margin-top: 1rem;
    }
    
    .match-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .match-score {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    
    .match-percentage {
        font-size: 2rem;
        font-weight: 800;
        color: #1e40af;
    }
    
    .match-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1e3a8a;
    }
    
    .match-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.25rem 0.875rem;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    
    .match-high { background: #dcfce7; color: #15803d; }
    .match-medium { background: #fef9c3; color: #a16207; }
    .match-low { background: #fee2e2; color: #b91c1c; }
    
    .progress-bar {
        background: #e2e8f0;
        border-radius: 20px;
        height: 6px;
        overflow: hidden;
        margin: 0.75rem 0;
    }
    
    .progress-fill {
        height: 100%;
        border-radius: 20px;
        transition: width 0.3s ease;
    }

    /* ============================================================
       RESPONSIVE DESIGN
    ============================================================ */
    
    /* Tablet (768px and below) */
    @media (max-width: 768px) {
        .details-container {
            padding: 1rem;
        }
        
        .card {
            padding: 1.25rem;
        }
        
        .card-title {
            font-size: 1.125rem;
            margin-bottom: 1rem;
        }
        
        .card-title svg {
            width: 1.125rem;
            height: 1.125rem;
        }
        
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }
        
        .match-percentage {
            font-size: 1.75rem;
        }
        
        .header-card a {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
        }
        
        .header-card a svg {
            width: 14px;
            height: 14px;
        }
        
        .header-card h1 {
            font-size: 1.25rem !important;
        }
        
        .header-card p {
            font-size: 0.75rem !important;
        }
    }
    
    /* Mobile (640px and below) */
    @media (max-width: 640px) {
        .details-container {
            padding: 0.5rem;
        }
        
        .card {
            padding: 1rem;
            border-radius: 14px;
            margin-bottom: 1rem;
        }
        
        .card-title {
            font-size: 1rem;
            margin-bottom: 0.875rem;
            padding-bottom: 0.5rem;
        }
        
        .card-title svg {
            width: 1rem;
            height: 1rem;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
            gap: 0.5rem;
        }
        
        .info-item {
            padding: 0.5rem;
        }
        
        .info-label {
            font-size: 0.65rem;
        }
        
        .info-value {
            font-size: 0.8125rem;
        }
        
        h2[style*="font-size: 1.5rem"] {
            font-size: 1.125rem !important;
            margin-bottom: 0.75rem !important;
        }
        
        .status-badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.875rem;
        }
        
        .status-badge svg {
            width: 12px;
            height: 12px;
        }
        
        .match-card {
            padding: 1rem;
        }
        
        .match-percentage {
            font-size: 1.5rem;
        }
        
        .match-label {
            font-size: 0.75rem;
        }
        
        .match-badge {
            font-size: 0.6rem;
            padding: 0.2rem 0.625rem;
        }
        
        .match-message {
            font-size: 0.7rem;
        }
        
        .progress-bar {
            height: 4px;
        }
        
        .skills-container {
            gap: 0.375rem;
        }
        
        .skill-tag {
            font-size: 0.65rem;
            padding: 0.25rem 0.625rem;
        }
        
        .skill-tag svg {
            width: 9px;
            height: 9px;
        }
        
        .resume-card {
            flex-direction: column;
            align-items: stretch;
            gap: 0.75rem;
        }
        
        .resume-info svg {
            width: 18px;
            height: 18px;
        }
        
        .resume-info p {
            font-size: 0.75rem;
        }
        
        .btn-primary, .btn-outline {
            padding: 0.5rem 1rem;
            font-size: 0.7rem;
            justify-content: center;
        }
        
        .btn-primary svg, .btn-outline svg {
            width: 14px;
            height: 14px;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 0.625rem;
        }
        
        .action-buttons a {
            width: 100%;
            justify-content: center;
        }
        
        .content-box {
            padding: 0.75rem;
            font-size: 0.8125rem;
        }
        
        .content-box h3 {
            font-size: 0.875rem !important;
        }
        
        .alert-success {
            padding: 0.625rem;
            font-size: 0.7rem;
        }
        
        .alert-success svg {
            width: 14px;
            height: 14px;
        }
        
        .meta-text {
            font-size: 0.65rem;
        }
        
        .match-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .header-card > div {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .header-card .btn-primary {
            background: rgba(255, 255, 255, 0.2);
            width: auto;
        }
        
        [style*="background: #fffbeb"] {
            padding: 0.625rem !important;
        }
        
        [style*="background: #fffbeb"] span {
            font-size: 0.65rem !important;
            padding: 0.2rem 0.5rem !important;
        }
    }
    
    /* Very Small Phones (480px and below) */
    @media (max-width: 480px) {
        .details-container {
            padding: 0.375rem;
        }
        
        .card {
            padding: 0.75rem;
            border-radius: 12px;
        }
        
        .card-title {
            font-size: 0.875rem;
        }
        
        .card-title svg {
            width: 0.875rem;
            height: 0.875rem;
        }
        
        .header-card h1 {
            font-size: 1rem !important;
        }
        
        .header-card p {
            font-size: 0.65rem !important;
        }
        
        .info-item {
            padding: 0.375rem;
        }
        
        .info-label {
            font-size: 0.6rem;
        }
        
        .info-value {
            font-size: 0.75rem;
        }
        
        h2[style*="font-size: 1.5rem"] {
            font-size: 1rem !important;
        }
        
        .skill-tag {
            font-size: 0.6rem;
            padding: 0.2rem 0.5rem;
        }
        
        .match-percentage {
            font-size: 1.125rem;
        }
        
        .btn-primary, .btn-outline {
            padding: 0.375rem 0.75rem;
            font-size: 0.65rem;
        }
        
        .btn-primary svg, .btn-outline svg {
            width: 12px;
            height: 12px;
        }
        
        .status-badge {
            font-size: 0.6rem;
            padding: 0.2rem 0.6875rem;
        }
    }
</style>

<div class="details-container">
    <div class="details-content">
        <!-- Header Card -->
        <div class="card header-card">
            <div>
                <div>
                    <h1 style="font-size: 1.5rem; font-weight: 700; margin: 0 0 0.25rem;">Application Details</h1>
                    <p style="opacity: 0.9; margin: 0;">Track your application status and review your submission</p>
                </div>
                <a href="{{ route('jobseeker.applications.index') }}">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Applications
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Job Information Card -->
        <div class="card">
            <div class="card-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Position Details
            </div>
            
            <h2 style="font-size: 1.5rem; font-weight: 700; color: #0f172a; margin-bottom: 1rem;">{{ $application->job->title }}</h2>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Location</div>
                    <div class="info-value">{{ $application->job->location ?? 'Remote / Flexible' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Salary Range</div>
                    <div class="info-value">{{ $application->job->salary ? '$' . number_format($application->job->salary) . '/year' : 'Negotiable' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Job Type</div>
                    <div class="info-value">{{ ucfirst($application->job->job_type ?? 'Full-time') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Experience Level</div>
                    <div class="info-value">{{ ucfirst($application->job->experience_level ?? 'Entry Level') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Applied Date</div>
                    <div class="info-value">{{ $application->created_at->format('F j, Y') }}</div>
                    <div class="meta-text">at {{ $application->created_at->format('g:i A') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Application ID</div>
                    <div class="info-value">#{{ $application->id }}</div>
                </div>
            </div>
        </div>

        <!-- Skills Match Analysis Card -->
        @php
            $jobSkillsList = [];
            if ($application->job->skills_required) {
                if (is_string($application->job->skills_required)) {
                    $jobSkillsList = array_map('trim', explode(',', $application->job->skills_required));
                } elseif (is_array($application->job->skills_required)) {
                    $jobSkillsList = $application->job->skills_required;
                }
            }
            $jobSkillsList = array_filter($jobSkillsList);
            
            $candidateProfile = auth()->user()->jobseekerProfile;
            $candidateSkillsList = [];
            if ($candidateProfile && $candidateProfile->skills) {
                if (is_string($candidateProfile->skills)) {
                    $candidateSkillsList = array_map('trim', explode(',', $candidateProfile->skills));
                } elseif (is_array($candidateProfile->skills)) {
                    $candidateSkillsList = $candidateProfile->skills;
                }
            }
            $candidateSkillsList = array_filter($candidateSkillsList);
            
            $jobSkillsLower = array_map('strtolower', $jobSkillsList);
            $candidateSkillsLower = array_map('strtolower', $candidateSkillsList);
            
            $matchedSkillsList = [];
            $missingSkillsList = [];
            
            foreach ($jobSkillsList as $index => $jobSkill) {
                $jobSkillLower = $jobSkillsLower[$index];
                if (in_array($jobSkillLower, $candidateSkillsLower)) {
                    $matchedSkillsList[] = $jobSkill;
                } else {
                    $missingSkillsList[] = $jobSkill;
                }
            }
            
            $totalRequired = count($jobSkillsList);
            $matchedCount = count($matchedSkillsList);
            $matchPercentage = $totalRequired > 0 ? round(($matchedCount / $totalRequired) * 100) : 0;
            $matchLevel = $matchPercentage >= 70 ? 'high' : ($matchPercentage >= 40 ? 'medium' : 'low');
            
            if ($matchPercentage >= 80) {
                $matchMessage = "Excellent match! Your skills align perfectly with this role.";
            } elseif ($matchPercentage >= 60) {
                $matchMessage = "Good match! You have most of the required skills.";
            } elseif ($matchPercentage >= 40) {
                $matchMessage = "Decent match! You have some relevant skills.";
            } elseif ($matchPercentage >= 20) {
                $matchMessage = "Opportunity to grow! This role could help you develop new skills.";
            } else {
                $matchMessage = "Consider highlighting transferable skills in your application.";
            }
        @endphp

        @if($totalRequired > 0)
        <div class="card">
            <div class="card-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Skills Match Analysis
            </div>
            
            <div class="match-card">
                <div class="match-header">
                    <div class="match-score">
                        <span class="match-percentage">{{ $matchPercentage }}%</span>
                        <span class="match-label">Match Score</span>
                    </div>
                    <span class="match-badge match-{{ $matchLevel }}">
                        @if($matchPercentage >= 70) Strong Match
                        @elseif($matchPercentage >= 40) Partial Match
                        @else Low Match
                        @endif
                    </span>
                </div>
                
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $matchPercentage }}%; background: {{ $matchLevel === 'high' ? '#10b981' : ($matchLevel === 'medium' ? '#f59e0b' : '#ef4444') }};"></div>
                </div>
                
                <p style="font-size: 0.875rem; color: #1e3a8a; margin: 0.5rem 0 0;">{{ $matchMessage }}</p>
            </div>
            
            <div style="margin-top: 1rem;">
                <div class="info-label" style="margin-bottom: 0.5rem;">Required Skills ({{ $totalRequired }})</div>
                <div class="skills-container">
                    @foreach($jobSkillsList as $skill)
                        @php $isMatched = in_array(strtolower($skill), $candidateSkillsLower); @endphp
                        <span class="skill-tag {{ $isMatched ? 'matched' : 'missing' }}">
                            @if($isMatched)
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            @else
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            @endif
                            {{ ucfirst($skill) }}
                        </span>
                    @endforeach
                </div>
            </div>
            
            @if(!empty($candidateSkillsList))
            <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e2e8f0;">
                <div class="info-label" style="margin-bottom: 0.5rem;">Your Skills ({{ count($candidateSkillsList) }})</div>
                <div class="skills-container">
                    @foreach($candidateSkillsList as $skill)
                        <span class="skill-tag" style="background: #dcfce7; color: #166534;">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ ucfirst($skill) }}
                        </span>
                    @endforeach
                </div>
                <p class="meta-text" style="margin-top: 0.5rem;">
                    <a href="{{ route('jobseeker.profile.edit') }}" style="color: #3b82f6; text-decoration: none;">
                        Update your skills in profile →
                    </a>
                </p>
            </div>
            @endif
            
            @if($missingSkillsList && count($missingSkillsList) > 0)
            <div style="margin-top: 1rem; padding: 0.75rem; background: #fffbeb; border-radius: 12px;">
                <div class="info-label" style="color: #92400e; margin-bottom: 0.25rem;">Skills to Develop</div>
                <div class="skills-container">
                    @foreach($missingSkillsList as $skill)
                        <span style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.7rem;">
                            {{ ucfirst($skill) }}
                        </span>
                    @endforeach
                </div>
                <p class="meta-text" style="color: #92400e; margin-top: 0.5rem;">
                    Consider learning these skills to improve your chances for similar roles.
                </p>
            </div>
            @endif
        </div>
        @endif

        <!-- Application Status Card -->
        <div class="card">
            <div class="card-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Application Status
            </div>
            
            <div style="text-align: center; padding: 1rem 0;">
                @php
                    $statusClass = match($application->status) {
                        'pending' => 'status-pending',
                        'accepted' => 'status-accepted',
                        'rejected' => 'status-rejected',
                        'interview' => 'status-interview',
                        'interview_scheduled' => 'status-interview_scheduled',
                        'shortlisted' => 'status-shortlisted',
                        default => 'status-pending'
                    };
                    $statusIcon = match($application->status) {
                        'pending' => '⏳',
                        'accepted' => '✓',
                        'rejected' => '✗',
                        'interview' => '📅',
                        'interview_scheduled' => '📅',
                        'shortlisted' => '⭐',
                        default => '📋'
                    };
                    $statusMessage = match($application->status) {
                        'pending' => 'Your application is under review. You\'ll be notified once the employer responds.',
                        'accepted' => 'Congratulations! Your application has been accepted. The employer will contact you soon.',
                        'rejected' => 'Unfortunately, your application was not selected at this time. Keep applying to other opportunities!',
                        'interview' => 'Great news! You have been selected for an interview. Check your email for details.',
                        'interview_scheduled' => 'Your interview has been scheduled. Check your email for the meeting link and details.',
                        'shortlisted' => 'You have been shortlisted! The employer will contact you shortly for the next steps.',
                        default => 'Your application status will be updated here.'
                    };
                @endphp
                
                <span class="status-badge {{ $statusClass }}">
                    <span>{{ $statusIcon }}</span>
                    <span>{{ ucfirst(str_replace('_', ' ', $application->status)) }}</span>
                </span>
                <p style="color: #64748b; font-size: 0.875rem; margin-top: 0.75rem;">{{ $statusMessage }}</p>
            </div>
        </div>

        <!-- Cover Letter Card -->
        @if($application->cover_letter)
        <div class="card">
            <div class="card-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Your Cover Letter
            </div>
            <div class="content-box">
                <p>{{ $application->cover_letter }}</p>
            </div>
        </div>
        @endif

        <!-- Resume Card -->
        <div class="card">
            <div class="card-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Your Resume
            </div>
            
            @if($application->resume)
                <div class="resume-card">
                    <div class="resume-info">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #3b82f6;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <div>
                            <p style="font-weight: 600; color: #0f172a; margin: 0;">{{ basename($application->resume) }}</p>
                            <p style="font-size: 0.7rem; color: #64748b; margin: 0;">Uploaded on {{ $application->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $application->resume) }}" target="_blank" class="btn-primary" style="background: #475569;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download
                    </a>
                </div>
            @else
                <div class="content-box" style="text-align: center; color: #64748b;">
                    <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin: 0 auto 0.5rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p>No resume uploaded with this application.</p>
                </div>
            @endif
        </div>

        <!-- Job Description Card -->
        <div class="card">
            <div class="card-title">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Full Job Description
            </div>
            <div class="content-box">
                <div>
                    <h3 style="font-weight: 600; color: #0f172a; margin-bottom: 0.5rem;">About the Role</h3>
                    <p>{{ $application->job->description ?? 'No description available.' }}</p>
                </div>
                
                @if($application->job->requirements)
                <div style="margin-top: 1rem;">
                    <h3 style="font-weight: 600; color: #0f172a; margin-bottom: 0.5rem;">Requirements</h3>
                    <p>{{ $application->job->requirements }}</p>
                </div>
                @endif
                
                @if($application->job->benefits)
                <div style="margin-top: 1rem;">
                    <h3 style="font-weight: 600; color: #0f172a; margin-bottom: 0.5rem;">Benefits</h3>
                    <p>{{ $application->job->benefits }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('jobseeker.jobs.show', $application->job) }}" class="btn-primary">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                View Job
            </a>
            <a href="{{ route('jobseeker.applications.index') }}" class="btn-outline">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                All Applications
            </a>
        </div>
        
        <!-- Help Text -->
        <div style="text-align: center; margin-top: 1.5rem; padding: 1rem;">
            <p style="font-size: 0.75rem; color: #94a3b8;">
                Need help? <a href="#" style="color: #3b82f6; text-decoration: none;">Contact Support</a>
            </p>
        </div>
    </div>
</div>
@endsection