@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    @php
        use Carbon\Carbon;

        // Ensure all variables are arrays to prevent count() errors
        $experience = $profile->experience ?? [];
        $education = $profile->education ?? [];
        $skills = $profile->skills ?? [];
        $certifications = $profile->certifications ?? [];
        $interests = $profile->interests ?? [];

        $formatDate = function ($date) {
            if (empty($date))
                return null;
            try {
                return Carbon::parse($date)->format('M Y');
            } catch (\Exception $e) {
                return $date;
            }
        };
    @endphp

    <style>
        /* ===== FULL PAGE CONTAINER ===== */
        .full-page-container {
            min-height: 100vh;
            background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
            padding: 2rem 1.5rem;
        }

        .content-wrapper {
            max-width: 1400px;
            margin: 0 auto;
        }

        @media (max-width: 640px) {
            .full-page-container {
                padding: 1rem;
            }
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 0.25rem;
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
            padding: 0.5rem 1.125rem;
            border-radius: 0.625rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.15s;
            white-space: nowrap;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #fff;
            color: #2563eb;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.5rem 1.125rem;
            border-radius: 0.625rem;
            border: 1.5px solid #2563eb;
            text-decoration: none;
            transition: all 0.15s;
            white-space: nowrap;
        }

        .btn-outline:hover {
            background: #eff6ff;
        }

        /* ===== PROFILE CARD ===== */
        .profile-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 1.25rem;
            overflow: hidden;
        }

        .cover-image {
            height: 120px;
            background: linear-gradient(135deg, #2563eb 0%, #7c3aed 50%, #db2777 100%);
            position: relative;
        }

        .profile-content {
            padding: 0 1.5rem 1.5rem;
        }

        .profile-header {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 768px) {
            .profile-header {
                flex-direction: row;
                align-items: flex-end;
                justify-content: space-between;
            }
        }

        .profile-avatar-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            margin-top: -48px;
        }

        @media (min-width: 768px) {
            .profile-avatar-section {
                flex-direction: row;
                align-items: flex-end;
                gap: 1.25rem;
            }
        }

        .avatar {
            position: relative;
            width: 96px;
            height: 96px;
            border-radius: 50%;
            border: 4px solid #fff;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .edit-avatar-btn {
            position: absolute;
            bottom: 4px;
            right: 4px;
            width: 32px;
            height: 32px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.2s;
        }

        .edit-avatar-btn:hover {
            background: #f9fafb;
            transform: scale(1.05);
        }

        .profile-info {
            text-align: center;
        }

        @media (min-width: 768px) {
            .profile-info {
                text-align: left;
            }
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 0.25rem;
        }

        .profile-headline {
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0;
        }

        .profile-meta {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        @media (min-width: 768px) {
            .profile-meta {
                justify-content: flex-start;
            }
        }

        .meta-item {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.75rem;
            color: #6b7280;
        }

        .resume-btn {
            margin-top: 0.75rem;
        }

        @media (min-width: 768px) {
            .resume-btn {
                margin-top: 0;
            }
        }

        /* ===== BIO SECTION ===== */
        .bio-section {
            background: #f9fafb;
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            gap: 0.75rem;
        }

        .bio-icon {
            width: 20px;
            height: 20px;
            color: #9ca3af;
            flex-shrink: 0;
        }

        .bio-text {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.5;
            margin: 0;
        }

        /* ===== CONTACT GRID ===== */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .contact-card {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: #f9fafb;
            border-radius: 0.75rem;
        }

        .contact-icon {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .contact-icon.phone {
            background: #dcfce7;
        }

        .contact-icon.phone svg {
            color: #15803d;
        }

        .contact-icon.location {
            background: #fef3c7;
        }

        .contact-icon.location svg {
            color: #b45309;
        }

        .contact-icon.website {
            background: #f3e8ff;
        }

        .contact-icon.website svg {
            color: #6b21a5;
        }

        .contact-icon.member {
            background: #e0e7ff;
        }

        .contact-icon.member svg {
            color: #4338ca;
        }

        .contact-label {
            font-size: 0.6875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #9ca3af;
            margin: 0 0 2px;
        }

        .contact-value {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin: 0;
        }

        .contact-link {
            color: #2563eb;
            text-decoration: none;
        }

        .contact-link:hover {
            text-decoration: underline;
        }

        /* ===== SECTION STYLES ===== */
        .section {
            margin-bottom: 1.75rem;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .section-count {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        .skills-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .skill-tag {
            padding: 0.375rem 0.875rem;
            background: #f0f9ff;
            color: #0369a1;
            font-size: 0.8125rem;
            font-weight: 500;
            border-radius: 999px;
            border: 1px solid #bae6fd;
        }

        .empty-state-small {
            padding: 1.5rem;
            background: #f9fafb;
            border-radius: 0.75rem;
            text-align: center;
            color: #9ca3af;
            font-size: 0.875rem;
        }

        .timeline-item {
            padding: 1rem;
            background: #f9fafb;
            border-radius: 0.75rem;
            margin-bottom: 0.75rem;
            transition: box-shadow 0.2s;
        }

        .timeline-item:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 0.25rem;
        }

        .timeline-title {
            font-size: 0.9375rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .timeline-date {
            font-size: 0.6875rem;
            color: #9ca3af;
            background: #fff;
            padding: 2px 8px;
            border-radius: 999px;
        }

        .timeline-subtitle {
            font-size: 0.8125rem;
            color: #6b7280;
            margin: 0 0 0.5rem;
        }

        .timeline-description {
            font-size: 0.75rem;
            color: #6b7280;
            line-height: 1.4;
            margin: 0.5rem 0 0;
        }

        /* ===== TWO COLUMN GRID ===== */
        .two-column {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 1024px) {
            .two-column {
                grid-template-columns: 1fr 1fr;
            }
        }

        /* ===== INTERESTS & CERTIFICATIONS ===== */
        .interests-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #f3f4f6;
        }

        @media (min-width: 768px) {
            .interests-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>

    <div class="full-page-container">
        <div class="content-wrapper">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">My Profile</h1>
                    <p class="page-sub">Manage your professional identity and work preferences</p>
                </div>
            </div>

            <!-- Profile Card -->
            <div class="profile-card">
                <!-- Cover Image -->
                <div class="cover-image"></div>

                <!-- Profile Content -->
                <div class="profile-content">
                    <!-- Header Section -->
                    <div class="profile-header">
                        <div class="profile-avatar-section">
                            <div class="avatar">
                                {{ strtoupper(substr($profile->user->name, 0, 1)) }}
                                <a href="{{ route('jobseeker.profile.edit') }}" class="edit-avatar-btn">
                                    <svg class="w-3.5 h-3.5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            </div>
                            <div class="profile-info">
                                <h1 class="profile-name">{{ $profile->user->name }}</h1>
                                <p class="profile-headline">{{ $profile->headline ?? 'Professional Profile' }}</p>
                                <div class="profile-meta">
                                    @if($profile->location)
                                        <span class="meta-item">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $profile->location }}
                                        </span>
                                    @endif
                                    <span class="meta-item">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        {{ $profile->user->email }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Resume Download -->
                        @if($profile->resume_path)
                            <div class="resume-btn">
                                <a href="{{ Storage::url($profile->resume_path) }}" target="_blank" class="btn-primary">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download Resume
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Bio Section -->
                    @if($profile->bio)
                        <div class="bio-section">
                            <svg class="bio-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            <p class="bio-text">{{ $profile->bio }}</p>
                        </div>
                    @endif

                    <!-- Contact Info Grid -->
                    <div class="contact-grid">
                        @if($profile->phone)
                            <div class="contact-card">
                                <div class="contact-icon phone">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="contact-label">Phone</p>
                                    <p class="contact-value">{{ $profile->phone }}</p>
                                </div>
                            </div>
                        @endif

                        @if($profile->location)
                            <div class="contact-card">
                                <div class="contact-icon location">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="contact-label">Location</p>
                                    <p class="contact-value">{{ $profile->location }}</p>
                                </div>
                            </div>
                        @endif

                        @if($profile->website)
                            <div class="contact-card">
                                <div class="contact-icon website">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.66 0 3-4 3-9s-1.34-9-3-9m0 18c-1.66 0-3-4-3-9s1.34-9 3-9" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="contact-label">Website</p>
                                    <a href="{{ $profile->website }}" target="_blank" class="contact-value contact-link">
                                        {{ Str::limit($profile->website, 30) }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="contact-card">
                            <div class="contact-icon member">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="contact-label">Member Since</p>
                                <p class="contact-value">{{ $profile->user->created_at->format('F Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Skills Section -->
                    <div class="section">
                        <div class="section-header">
                            <h2 class="section-title">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Core Skills
                            </h2>
                            @if(!empty($skills) && count($skills) > 0)
                                <span class="section-count">{{ count($skills) }} skills</span>
                            @endif
                        </div>
                        <div class="skills-wrap">
                            @forelse($skills as $skill)
                                <span class="skill-tag">{{ $skill }}</span>
                            @empty
                                <div class="empty-state-small">No skills added yet. Add skills to help employers find you.</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Experience & Education Grid -->
                    <div class="two-column">
                        <!-- Experience Column -->
                        <div>
                            <div class="section-header">
                                <h2 class="section-title">
                                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Work Experience
                                </h2>
                            </div>
                            @forelse($experience as $exp)
                                <div class="timeline-item">
                                    <div class="timeline-header">
                                        <h3 class="timeline-title">{{ $exp['title'] ?? 'Position' }}</h3>
                                        <span class="timeline-date">
                                            {{ $formatDate($exp['start_date'] ?? null) ?? 'Start' }} -
                                            {{ $formatDate($exp['end_date'] ?? null) ?? 'Present' }}
                                        </span>
                                    </div>
                                    <p class="timeline-subtitle">{{ $exp['company'] ?? 'Company' }}</p>
                                    @if(!empty($exp['description']))
                                        <p class="timeline-description">{{ $exp['description'] }}</p>
                                    @endif
                                </div>
                            @empty
                                <div class="empty-state-small">No work experience added yet.</div>
                            @endforelse
                        </div>

                        <!-- Education Column -->
                        <!-- Education Column -->
                        <div>
                            <div class="section-header">
                                <h2 class="section-title">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    </svg>
                                    Education
                                </h2>
                            </div>
                            @forelse($education as $edu)
                                <div class="timeline-item">
                                    <div class="timeline-header">
                                        <h3 class="timeline-title">{{ $edu['degree'] ?? 'Degree' }}</h3>
                                        <span class="timeline-date">
                                            {{ $formatDate($edu['start_date'] ?? null) ?? 'Start' }} -
                                            {{ $formatDate($edu['end_date'] ?? null) ?? 'Present' }}
                                        </span>
                                    </div>
                                    <p class="timeline-subtitle">{{ $edu['institution'] ?? 'Institution' }}</p>
                                    @if(!empty($edu['field_of_study']))
                                        <p class="timeline-description">Field: {{ $edu['field_of_study'] }}</p>
                                    @endif
                                    @if(!empty($edu['description']))
                                        <p class="timeline-description" style="margin-top: 0.5rem;">{{ $edu['description'] }}</p>
                                    @endif
                                </div>
                            @empty
                                <div class="empty-state-small">No education added yet.</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Certifications & Interests -->
                    @if((!empty($certifications) && count($certifications) > 0) || (!empty($interests) && count($interests) > 0))
                        <div class="interests-grid">
                            @if(!empty($certifications) && count($certifications) > 0)
                                <div>
                                    <div class="section-header">
                                        <h2 class="section-title">
                                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                            Certifications
                                        </h2>
                                    </div>
                                    <div class="skills-wrap">
                                        @foreach($certifications as $cert)
                                            <span class="skill-tag"
                                                style="background:#fef3c7; color:#b45309; border-color:#fde68a;">{{ $cert }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if(!empty($interests) && count($interests) > 0)
                                <div>
                                    <div class="section-header">
                                        <h2 class="section-title">
                                            <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            Professional Interests
                                        </h2>
                                    </div>
                                    <div class="skills-wrap">
                                        @foreach($interests as $interest)
                                            <span class="skill-tag"
                                                style="background:#fdf2f8; color:#be185d; border-color:#fbcfe8;">{{ $interest }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection