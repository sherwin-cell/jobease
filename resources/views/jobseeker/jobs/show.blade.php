@extends('layouts.app')

@section('title', $job->title)

@section('content')

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
            gap: 4px;
            font-size: 0.8125rem;
            font-weight: 500;
            color: #6b7280;
            text-decoration: none;
            margin-bottom: 20px;
            transition: color 0.15s;
        }

        .back-link:hover {
            color: #2563eb;
        }

        /* ===== CARD ===== */
        .job-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.05);
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
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ===== APPLY BUTTON ===== */
        .apply-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
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

        .apply-btn:active {
            transform: translateY(0);
        }

        /* ===== MATCH CARD ===== */
        .match-card {
            background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
            border-radius: 16px;
            padding: 20px;
            margin: 24px 0;
        }

        .match-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 16px;
        }

        .match-score {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .match-percentage {
            font-size: 2.5rem;
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
            gap: 8px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .match-high {
            background: #dcfce7;
            color: #15803d;
        }

        .match-mid {
            background: #fef9c3;
            color: #a16207;
        }

        .match-low {
            background: #fee2e2;
            color: #b91c1c;
        }

        .match-message {
            font-size: 0.875rem;
            line-height: 1.6;
            color: #1e3a8a;
            margin: 0;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .matched-skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .matched-skill {
            background: #fff;
            color: #1e40af;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: 999px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

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
            gap: 12px;
            background: #f9fafb;
            border: 1px solid #f3f4f6;
            border-radius: 12px;
            padding: 14px;
        }

        .meta-icon {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            color: #6b7280;
        }

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
        .job-section {
            margin-bottom: 24px;
        }

        .job-section:last-of-type {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 0.9375rem;
            font-weight: 700;
            color: #374151;
            margin: 0 0 12px;
            letter-spacing: -0.01em;
            display: flex;
            align-items: center;
            gap: 8px;
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
            gap: 4px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 0.8125rem;
            font-weight: 500;
            padding: 5px 12px;
            border-radius: 999px;
            border: 1px solid #bfdbfe;
        }

        .skill-tag.matched {
            background: #16a34a;
            color: #fff;
            border-color: #16a34a;
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

        /* ===== WARNING MESSAGE ===== */
        .warning-message {
            background: #fef3c7;
            border: 1px solid #fde68a;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .warning-text {
            font-size: 0.875rem;
            color: #92400e;
            margin: 0;
            flex: 1;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .job-meta-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

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

            .job-title {
                font-size: 1.25rem;
            }

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

            .match-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div class="job-detail-wrapper">
        {{-- Back link --}}
        <a href="{{ route('jobseeker.jobs.index') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6" />
            </svg>
            Back to Jobs
        </a>

        <div class="job-card">
            {{-- Header --}}
            <div class="job-header">
                <div class="job-header-text">
                    <h1 class="job-title">{{ $job->title }}</h1>
                    @if($job->location)
                        <p class="job-location">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            {{ $job->location }}
                        </p>
                    @endif
                </div>
                <a href="{{ route('jobseeker.jobs.apply.form', $job) }}" class="apply-btn">
                    Apply Now
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="divider"></div>

            {{-- Match Analysis Card --}}
            @php
                $candidate = auth()->user()->jobseekerProfile;
                
                // Clean and normalize candidate skills
                $candidateSkills = collect();
                if ($candidate && $candidate->skills) {
                    $candidateSkills = collect($candidate->skills)
                        ->map(fn($s) => strtolower(trim(is_string($s) ? $s : '')))
                        ->filter()
                        ->unique();
                }
                
                // Clean and normalize job required skills
                $jobSkills = collect();
                if ($job->skills_required) {
                    if (is_string($job->skills_required)) {
                        $jobSkills = collect(explode(',', $job->skills_required))
                            ->map(fn($s) => strtolower(trim($s)))
                            ->filter();
                    } else {
                        $jobSkills = collect($job->skills_required)
                            ->map(fn($s) => strtolower(trim(is_string($s) ? $s : '')))
                            ->filter();
                    }
                }
                
                // Calculate matched skills
                $matchedSkills = $jobSkills->filter(function($jobSkill) use ($candidateSkills) {
                    return $candidateSkills->contains($jobSkill);
                });
                
                $matched = $matchedSkills->count();
                $totalNeeded = $jobSkills->count();
                $match = $totalNeeded > 0 ? round(($matched / $totalNeeded) * 100, 2) : 0;
                $matchColorClass = $match >= 70 ? 'match-high' : ($match >= 40 ? 'match-mid' : 'match-low');
                
                // Generate personalized message with Lucide icons
                if ($match >= 80) {
                    $matchMessage = "Excellent match! Your skills align perfectly with this role. You're a top candidate!";
                    $matchIcon = "🏆";
                } elseif ($match >= 60) {
                    $matchMessage = "Good match! You have most of the required skills. Strong chance of getting shortlisted.";
                    $matchIcon = "✨";
                } elseif ($match >= 40) {
                    $matchMessage = "Decent match! You have some relevant skills. Consider highlighting transferable skills in your application.";
                    $matchIcon = "📊";
                } elseif ($match >= 20) {
                    $matchMessage = "Opportunity to grow! This role could help you develop new skills. Emphasize your learning ability.";
                    $matchIcon = "🌱";
                } else {
                    $matchMessage = "Potential fit! While your skills differ, your background may still bring value. Tailor your application to highlight relevant experience.";
                    $matchIcon = "💡";
                }
                
                // Add specific skill insights
                $missingSkills = $jobSkills->diff($candidateSkills);
                $hasProfile = $candidate && $candidateSkills->count() > 0;
            @endphp

            @if(!$hasProfile)
                <div class="warning-message">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#92400e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" x2="12" y1="8" y2="12" />
                        <line x1="12" x2="12.01" y1="16" y2="16" />
                    </svg>
                    <p class="warning-text">
                        <strong>Profile incomplete!</strong> Add your skills to see how well you match with this job.
                        <a href="{{ route('jobseeker.profile.edit') }}" style="color: #92400e; text-decoration: underline;">Update your profile</a>
                    </p>
                </div>
            @elseif($totalNeeded === 0)
                <div class="match-card" style="background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%);">
                    <div class="match-header">
                        <div class="match-score">
                            <span class="match-percentage" style="color: #6b21a5;">N/A</span>
                            <span class="match-label" style="color: #6b21a5;">Match Score</span>
                        </div>
                        <span class="match-badge" style="background: #f3e8ff; color: #6b21a5;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" x2="12" y1="8" y2="12" />
                                <line x1="12" x2="12.01" y1="16" y2="16" />
                            </svg>
                            No skills required
                        </span>
                    </div>
                    <div class="match-message">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6b21a5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                            <polyline points="7 10 12 15 17 10" />
                            <line x1="12" x2="12" y1="15" y2="3" />
                        </svg>
                        <span>This job doesn't specify any required skills. Your application will be evaluated based on your overall profile and experience.</span>
                    </div>
                </div>
            @else
                <div class="match-card">
                    <div class="match-header">
                        <div class="match-score">
                            <span class="match-percentage">{{ $match }}%</span>
                            <span class="match-label">Match Score</span>
                        </div>
                        <span class="match-badge {{ $matchColorClass }}">
                            @if($match >= 70)
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            @elseif($match >= 40)
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" x2="12" y1="8" y2="12" />
                                    <line x1="12" x2="12.01" y1="16" y2="16" />
                                </svg>
                            @else
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" x2="12" y1="8" y2="12" />
                                    <line x1="12" x2="12.01" y1="16" y2="16" />
                                </svg>
                            @endif
                            @if($match >= 70) Strong Match
                            @elseif($match >= 40) Partial Match
                            @else Low Match
                            @endif
                        </span>
                    </div>
                    <div class="match-message">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                        <span>{{ $matchMessage }}</span>
                    </div>
                    
                    @if($matchedSkills->count() > 0)
                        <div style="margin-top: 16px;">
                            <p style="font-size: 0.75rem; font-weight: 600; color: #1e3a8a; margin-bottom: 8px; display: flex; align-items: center; gap: 4px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                                Your matched skills:
                            </p>
                            <div class="matched-skills-list">
                                @foreach($matchedSkills as $skill)
                                    <span class="matched-skill">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        {{ ucfirst($skill) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    @if($missingSkills->count() > 0 && $match < 100)
                        <div style="margin-top: 12px;">
                            <p style="font-size: 0.75rem; font-weight: 600; color: #78350f; margin-bottom: 8px; display: flex; align-items: center; gap: 4px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 8v4m0 4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                                </svg>
                                Skills to develop:
                            </p>
                            <div class="matched-skills-list">
                                @foreach($missingSkills->take(5) as $skill)
                                    <span style="background: #fffbeb; color: #92400e; padding: 4px 12px; border-radius: 999px; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 4px;">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="12" x2="12" y1="8" y2="12" />
                                            <line x1="12" x2="12.01" y1="16" y2="16" />
                                        </svg>
                                        {{ ucfirst($skill) }}
                                    </span>
                                @endforeach
                                @if($missingSkills->count() > 5)
                                    <span style="background: #fffbeb; color: #92400e; padding: 4px 12px; border-radius: 999px; font-size: 0.75rem;">+{{ $missingSkills->count() - 5 }} more</span>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    @if($match == 100 && $totalNeeded > 0)
                        <div style="margin-top: 12px; padding: 8px 12px; background: #dcfce7; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <polyline points="22 4 12 14.01 9 11.01" />
                            </svg>
                            <p style="font-size: 0.75rem; color: #15803d; margin: 0;">Perfect match! You have all the required skills. Apply now for the best chance!</p>
                        </div>
                    @endif
                </div>
            @endif

            {{-- Details grid --}}
            <div class="job-meta-grid">
                <div class="meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="#2c2a2a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 10h.01" />
                        <path d="M12 14h.01" />
                        <path d="M12 6h.01" />
                        <path d="M16 10h.01" />
                        <path d="M16 14h.01" />
                        <path d="M16 6h.01" />
                        <path d="M8 10h.01" />
                        <path d="M8 14h.01" />
                        <path d="M8 6h.01" />
                        <path d="M9 22v-3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                        <rect x="4" y="2" width="16" height="20" rx="2" />
                    </svg>
                    <div>
                        <p class="meta-label">Experience Level</p>
                        <p class="meta-value">{{ $job->experience_level ?? 'Any level' }}</p>
                    </div>
                </div>

                <div class="meta-item">
                    <svg class="meta-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 6v6l4 2" />
                    </svg>
                    <div>
                        <p class="meta-label">Salary</p>
                        <p class="meta-value">
                            {{ $job->salary ? '$' . number_format($job->salary) . '/year' : 'Negotiable' }}</p>
                    </div>
                </div>

                <div class="meta-item">
                    <svg class="meta-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    <div>
                        <p class="meta-label">Location</p>
                        <p class="meta-value">{{ $job->location ?? 'Not specified' }}</p>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            {{-- Description --}}
            <div class="job-section">
                <h2 class="section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16" />
                        <path d="M4 12h16" />
                        <path d="M4 18h16" />
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                    </svg>
                    Job Description
                </h2>
                <p class="job-description">{{ $job->description }}</p>
            </div>

            {{-- Skills --}}
            <div class="job-section">
                <h2 class="section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Skills Required
                </h2>
                @if($jobSkills->count() > 0)
                    <div class="skills-list">
                        @foreach($jobSkills as $skill)
                            @php
                                $isMatched = $candidateSkills->contains($skill);
                            @endphp
                            <span class="skill-tag {{ $isMatched ? 'matched' : '' }}">
                                @if($isMatched)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                    </svg>
                                @endif
                                {{ ucfirst($skill) }}
                            </span>
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
                    Apply for this Job
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

@endsection