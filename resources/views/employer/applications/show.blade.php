@extends('layouts.app')

@section('title', 'Application Details - ' . $application->job->title)

@section('content')
<style>
    .employer-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #f5f7fa 0%, #e9edf2 100%);
        padding: 2rem 0;
    }
    
    .content-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    
    @media (max-width: 768px) {
        .content-wrapper { padding: 0 1rem; }
        .employer-container { padding: 1rem 0; }
    }
    
    /* Card Styles */
    .card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: all 0.2s;
    }
    
    .card-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    /* Two Column Layout */
    .two-columns {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .two-columns { grid-template-columns: 1fr; }
    }
    
    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }
    
    .info-item {
        padding: 0.75rem;
        background: #f8fafc;
        border-radius: 12px;
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
        font-size: 0.9rem;
        font-weight: 600;
        color: #0f172a;
    }
    
    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 1rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-shortlisted { background: #dbeafe; color: #1e40af; }
    .status-interview { background: #fce7f3; color: #be185d; }
    .status-interview_scheduled { background: #dcfce7; color: #166534; }
    .status-rejected { background: #fee2e2; color: #991b1b; }
    .status-hired { background: #dcfce7; color: #166534; }
    
    /* Skill Review Card */
    .skill-review-card {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 20px;
        padding: 1.5rem;
        transition: all 0.2s;
    }
    
    .skill-review-card:hover {
        border-color: #cbd5e1;
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
        border-bottom: 2px solid #f1f5f9;
    }
    
    .match-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.875rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    
    .match-high { background: #dcfce7; color: #166534; }
    .match-medium { background: #fef9c3; color: #854d0e; }
    .match-low { background: #fee2e2; color: #991b1b; }
    
    .skill-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.875rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .skill-matched {
        background: #dbeafe;
        color: #1e40af;
        border-left: 3px solid #3b82f6;
    }
    
    .skill-missing {
        background: #f1f5f9;
        color: #64748b;
        border-left: 3px solid #cbd5e1;
    }
    
    .progress-bar {
        background: #e2e8f0;
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
    
    /* Buttons */
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        background: #3b82f6;
        color: white;
        font-weight: 600;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }
    
    .btn-primary:hover { background: #2563eb; transform: translateY(-1px); }
    
    .btn-success {
        background: #10b981;
    }
    
    .btn-success:hover { background: #059669; }
    
    .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        background: white;
        color: #64748b;
        font-weight: 600;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .btn-outline:hover { background: #f8fafc; border-color: #cbd5e1; }
    
    .form-select, .form-input {
        width: 100%;
        padding: 0.625rem 1rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.875rem;
        transition: all 0.2s;
    }
    
    .form-select:focus, .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
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
    }
    
    .skills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin: 1rem 0;
    }
    
    .candidate-info-text {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }
</style>

<div class="employer-container">
    <div class="content-wrapper">
        <!-- Header -->
        <div class="card" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); color: white;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h1 style="font-size: 1.5rem; font-weight: 700; margin: 0 0 0.25rem;">Application Details</h1>
                    <p style="opacity: 0.9; margin: 0;">Review candidate information and manage application status</p>
                </div>
                <a href="{{ route('employer.applications.index') }}" class="btn-outline" style="background: rgba(255,255,255,0.2); color: white; border-color: rgba(255,255,255,0.3);">
                    ← Back to Applications
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="two-columns">
            <!-- Left Column -->
            <div>
                <!-- Candidate Info -->
                <div class="card">
                    <div class="card-title">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <a href="mailto:{{ $application->user->email }}" style="color: #3b82f6; text-decoration: none;">{{ $application->user->email }}</a>
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
                                <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Job Info -->
                <div class="card">
                    <div class="card-title">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Position Details
                    </div>
                    <div class="info-item" style="margin-bottom: 0.5rem;">
                        <div class="info-label">Job Title</div>
                        <div class="info-value" style="font-size: 1rem;">{{ $application->job->title }}</div>
                    </div>
                    <div class="info-item" style="margin-bottom: 0.5rem;">
                        <div class="info-label">Location</div>
                        <div class="info-value">{{ $application->job->location ?? 'Remote / Flexible' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Salary Range</div>
                        <div class="info-value">{{ $application->job->salary ? '$' . number_format($application->job->salary) . '/year' : 'Negotiable' }}</div>
                    </div>
                </div>
                
                <!-- Cover Letter -->
                @if($application->cover_letter)
                    <div class="card">
                        <div class="card-title">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Cover Letter
                        </div>
                        <div style="background: #f8fafc; padding: 1rem; border-radius: 12px; line-height: 1.6; white-space: pre-wrap;">
                            {{ $application->cover_letter }}
                        </div>
                    </div>
                @endif
                
                <!-- Resume -->
                @if($application->resume)
                    <div class="card">
                        <div class="card-title">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Resume / CV
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>{{ basename($application->resume) }}</span>
                            </div>
                            <a href="{{ asset('storage/' . $application->resume) }}" target="_blank" class="btn-primary" style="background: #475569; padding: 0.375rem 1rem;">
                                Download Resume
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Right Column -->
            <div>
                <!-- Skill Assessment -->
                @php
                    // Get job skills - handle both array and string formats
                    $jobSkills = [];
                    if ($application->job->skills_required) {
                        if (is_string($application->job->skills_required)) {
                            $jobSkills = array_map('trim', explode(',', $application->job->skills_required));
                        } elseif (is_array($application->job->skills_required)) {
                            $jobSkills = $application->job->skills_required;
                        }
                    }
                    
                    // Filter out empty values
                    $jobSkills = array_filter($jobSkills);
                    
                    // Get candidate skills from profile - handle both array and string
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
                    
                    // Normalize to lowercase for comparison
                    $jobSkillsLower = array_map('strtolower', $jobSkills);
                    $candidateSkillsLower = array_map('strtolower', $candidateSkills);
                    
                    // Calculate matched and missing skills
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
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                            </svg>
                            Skills Assessment
                        </div>
                        <div class="match-badge match-{{ $matchLevel }}">
                            {{ $matchPercentage }}% Match
                        </div>
                    </div>
                    
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $matchPercentage }}%; background: {{ $matchLevel === 'high' ? '#10b981' : ($matchLevel === 'medium' ? '#f59e0b' : '#ef4444') }};"></div>
                    </div>
                    <div style="font-size: 0.75rem; color: #64748b; text-align: right; margin-bottom: 1rem;">
                        {{ $matchedCount }} of {{ $totalRequired }} skills matched
                    </div>
                    
                    {{-- Candidate's Skills Section --}}
                    @if(!empty($candidateSkills))
                        <div style="margin-bottom: 1rem; padding: 0.75rem; background: #f0fdf4; border-radius: 10px;">
                            <div class="info-label" style="color: #166534;">Candidate's Skills</div>
                            <div class="skills-container" style="margin: 0.5rem 0 0 0;">
                                @foreach($candidateSkills as $skill)
                                    <span style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.7rem; font-weight: 500;">
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
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ ucfirst($skill) }}
                                </span>
                            @endforeach
                            @foreach($missingSkills as $skill)
                                <span class="skill-tag skill-missing">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    {{ ucfirst($skill) }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <div style="color: #64748b; font-style: italic; padding: 1rem 0;">
                            No specific skills defined for this position. Add skills to the job posting to enable skill matching.
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('employer.applications.updateSkillReview', $application) }}">
                        @csrf
                        @method('PUT')
                        <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e2e8f0;">
                            <label class="info-label" style="margin-bottom: 0.5rem;">Reviewer Notes</label>
                            <textarea name="skill_notes" rows="3" class="form-input" placeholder="Add your assessment notes about this candidate's skills..." style="font-family: inherit;">{{ $application->skill_notes ?? '' }}</textarea>
                            <div style="margin-top: 0.75rem; text-align: right;">
                                <button type="submit" class="btn-primary" style="background: #475569;">
                                    Save Notes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Update Status -->
                <div class="card">
                    <div class="card-title">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <button type="submit" class="btn-primary btn-success">Update Status</button>
                        </div>
                    </form>
                </div>
                
                <!-- Schedule Interview -->
                @if($application->status === 'shortlisted')
                    <div class="card">
                        <div class="card-title">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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