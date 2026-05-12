@extends('layouts.app')

@section('title', 'Browse Jobs')

@section('content')
    <style>
        /* ===== FULL PAGE CONTAINER ===== */
        .full-page-container {
            min-height: 100vh;
            background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
            padding: 1.5rem;
        }

        .content-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0;
        }

        @media (max-width: 640px) {
            .full-page-container {
                padding: 1rem;
            }
        }

        /* ===== PAGE HEADER ===== */
        /* ===== PAGE HEADER ===== */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: nowrap;
            margin-bottom: 24px;
        }

        .page-header>div:first-child {
            flex: 1;
            min-width: 0;
        }

        .page-header .profile-dropdown {
            flex-shrink: 0;
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

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

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

        .btn-ghost:hover {
            background: #f9fafb;
        }

        /* ===== PROFILE DROPDOWN ===== */
        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 40px;
            padding: 6px 6px 6px 16px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .profile-btn:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            transform: translateY(-1px);
        }

        .profile-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .profile-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
        }

        .profile-chevron {
            width: 16px;
            height: 16px;
            color: #9ca3af;
            transition: transform 0.2s;
        }

        .profile-dropdown.active .profile-chevron {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 260px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s;
            z-index: 100;
        }

        .profile-dropdown.active .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-header {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
        }

        .dropdown-user-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 2px;
        }

        .dropdown-user-email {
            font-size: 0.75rem;
            color: #6b7280;
        }

        .dropdown-divider {
            height: 1px;
            background: #f3f4f6;
            margin: 8px 0;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            color: #374151;
            text-decoration: none;
            font-size: 0.875rem;
            transition: background 0.15s;
            cursor: pointer;
            width: 100%;
            background: none;
            border: none;
            text-align: left;
        }

        .dropdown-item:hover {
            background: #f9fafb;
        }

        .dropdown-item svg {
            width: 18px;
            height: 18px;
            color: #9ca3af;
        }

        .dropdown-item.danger {
            color: #ef4444;
        }

        .dropdown-item.danger svg {
            color: #ef4444;
        }

        .dropdown-item.danger:hover {
            background: #fef2f2;
        }

        /* ===== LOGOUT CONFIRMATION MODAL ===== */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-container {
            background: #fff;
            border-radius: 20px;
            width: 90%;
            max-width: 420px;
            transform: scale(0.9);
            transition: transform 0.3s ease;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .modal-overlay.active .modal-container {
            transform: scale(1);
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-header svg {
            width: 28px;
            height: 28px;
            color: #ef4444;
        }

        .modal-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }

        .modal-body {
            padding: 20px 24px;
        }

        .modal-body p {
            color: #6b7280;
            font-size: 0.9375rem;
            line-height: 1.5;
            margin: 0;
        }

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #f3f4f6;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .modal-btn {
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s;
            border: none;
        }

        .modal-btn-cancel {
            background: #f3f4f6;
            color: #374151;
        }

        .modal-btn-cancel:hover {
            background: #e5e7eb;
        }

        .modal-btn-confirm {
            background: #ef4444;
            color: #fff;
        }

        .modal-btn-confirm:hover {
            background: #dc2626;
        }

        /* ===== FILTER CARD ===== */
        .filter-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
        }

        .filter-form {
            display: flex;
            align-items: flex-end;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
            min-width: 200px;
            flex: 1;
        }

        .field-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
        }

        .field-select {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 0.875rem;
            color: #374151;
            background: #fff;
            outline: none;
            transition: all 0.15s;
        }

        .field-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
        }

        .filter-actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* ===== JOB CARD ===== */
        .job-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 12px;
            transition: all 0.2s;
        }

        .job-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
            border-color: #d1d5db;
            transform: translateY(-2px);
        }

        .job-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .job-title-wrap {
            flex: 1;
            min-width: 0;
        }

        .job-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 6px;
        }

        .job-title a {
            color: inherit;
            text-decoration: none;
        }

        .job-title a:hover {
            color: #2563eb;
        }

        .job-desc {
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0;
            line-height: 1.5;
        }

        .job-actions {
            display: flex;
            gap: 8px;
            flex-shrink: 0;
            align-items: center;
        }

        .job-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: 999px;
        }

        .badge-gray {
            background: #f3f4f6;
            color: #374151;
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

        /* Match progress bar */
        .match-bar-wrap {
            margin-bottom: 12px;
        }

        .match-bar-track {
            height: 4px;
            background: #f3f4f6;
            border-radius: 999px;
            overflow: hidden;
        }

        .match-bar-fill {
            height: 100%;
            border-radius: 999px;
            transition: width 0.4s ease;
        }

        .match-bar-fill.match-high {
            background: #22c55e;
        }

        .match-bar-fill.match-mid {
            background: #eab308;
        }

        .match-bar-fill.match-low {
            background: #ef4444;
        }

        /* Skills */
        .job-skills {
            margin-top: 12px;
        }

        .skills-label {
            font-size: 0.6875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #9ca3af;
            margin: 0 0 8px;
        }

        .skills-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .skill-tag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #374151;
        }

        .skill-matched {
            background: #eff6ff;
            border-color: #bfdbfe;
            color: #1d4ed8;
            font-weight: 500;
        }

        .no-skills {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 48px 24px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 12px;
        }

        .empty-title {
            font-size: 1rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }

        .empty-sub {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 20px;
        }

        /* ===== PAGINATION STYLES ===== */
        .pagination-wrap {
            margin-top: 24px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: inline-flex;
            gap: 6px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination a,
        .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s;
        }

        .pagination a {
            color: #374151;
            background: #fff;
            border: 1px solid #e5e7eb;
        }

        .pagination a:hover {
            background: #eff6ff;
            border-color: #2563eb;
            color: #2563eb;
        }

        .pagination .active span {
            background: #2563eb;
            color: #fff;
            border: 1px solid #2563eb;
        }

        .pagination .disabled span {
            color: #d1d5db;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            cursor: not-allowed;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {

            /* ===== PAGE HEADER - STACK ON MOBILE ===== */
            .page-header {
                display: flex;
                flex-direction: column;
                align-items: stretch;
                gap: 16px;
                margin-bottom: 20px;
            }

            .page-header>div:first-child {
                flex: none;
            }

            .page-header .profile-dropdown {
                align-self: flex-end;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .page-sub {
                font-size: 0.75rem;
            }

            /* ===== FILTERS ===== */
            .filter-form {
                flex-direction: column;
            }

            .filter-field {
                min-width: 100%;
            }

            .filter-actions {
                width: 100%;
            }

            .filter-actions .btn-primary,
            .filter-actions .btn-ghost {
                flex: 1;
                justify-content: center;
            }

            /* ===== JOB CARDS ===== */
            .job-card {
                padding: 16px;
            }

            .job-top {
                flex-direction: column;
            }

            .job-title {
                font-size: 1rem;
            }

            .job-desc {
                font-size: 0.75rem;
            }

            .job-actions {
                width: 100%;
            }

            .job-actions .btn-ghost,
            .job-actions .btn-primary {
                flex: 1;
                justify-content: center;
                padding: 8px 12px;
                font-size: 0.75rem;
            }

            /* ===== JOB META BADGES ===== */
            .job-meta {
                gap: 6px;
            }

            .badge {
                font-size: 0.65rem;
                padding: 3px 8px;
            }

            .badge svg {
                width: 12px;
                height: 12px;
            }

            /* ===== SKILL TAGS ===== */
            .skills-wrap {
                gap: 4px;
            }

            .skill-tag {
                font-size: 0.65rem;
                padding: 2px 8px;
            }

            /* ===== PAGINATION ===== */
            .pagination a,
            .pagination span {
                min-width: 32px;
                height: 32px;
                font-size: 0.7rem;
            }

            .pagination svg {
                width: 14px !important;
                height: 14px !important;
            }

            /* ===== PROFILE DROPDOWN ===== */
            .profile-btn .profile-name {
                display: none;
            }

            .profile-btn {
                padding: 6px;
            }

            .dropdown-menu {
                width: 240px;
                right: -10px;
            }

            /* ===== MODAL ===== */
            .modal-container {
                width: 95%;
            }

            /* ===== EMPTY STATE ===== */
            .empty-icon svg {
                width: 40px;
                height: 40px;
            }

            .empty-title {
                font-size: 0.875rem;
            }

            .empty-sub {
                font-size: 0.75rem;
            }
        }

        /* ===== VERY SMALL PHONES (480px AND BELOW) ===== */
        @media (max-width: 480px) {

            /* Page Header */
            .page-title {
                font-size: 1.125rem;
            }

            .page-sub {
                font-size: 0.7rem;
            }

            /* Badges */
            .badge {
                font-size: 0.6rem;
                padding: 2px 6px;
            }

            .badge svg {
                width: 10px;
                height: 10px;
            }

            /* Skill Tags */
            .skill-tag {
                font-size: 0.6rem;
                padding: 2px 6px;
            }

            /* Job Actions Buttons */
            .job-actions .btn-ghost,
            .job-actions .btn-primary {
                padding: 6px 10px;
                font-size: 0.7rem;
            }

            /* Empty State */
            .empty-icon svg {
                width: 32px;
                height: 32px;
            }

            /* Profile Dropdown */
            .dropdown-menu {
                width: 220px;
                right: -5px;
            }

            .dropdown-item {
                padding: 8px 12px;
                font-size: 0.75rem;
            }

            .dropdown-item svg {
                width: 16px;
                height: 16px;
            }
        }
    </style>

    <div class="full-page-container">
        <div class="content-wrapper">
            <!-- Page Header with Profile Dropdown -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Browse Jobs</h1>
                    <p class="page-sub">Filter jobs by experience and quickly see your skill match</p>
                </div>

                <!-- Profile Dropdown -->
                <div class="profile-dropdown" id="profileDropdown">
                    <button class="profile-btn" id="profileBtn">
                        <div class="profile-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="profile-name">{{ auth()->user()->name }}</span>
                        <svg class="profile-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="dropdown-menu">
                        <div class="dropdown-header">
                            <div class="dropdown-user-name">{{ auth()->user()->name }}</div>
                            <div class="dropdown-user-email">{{ auth()->user()->email }}</div>
                        </div>
                        <div class="dropdown-divider"></div>

                        <!-- Profile Link -->
                        <a href="{{ route('jobseeker.profile.show') }}" class="dropdown-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            My Profile
                        </a>

                        <!-- Settings Link -->
                        <a href="{{ route('jobseeker.profile.edit') }}" class="dropdown-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Edit Profile
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- Logout Button (triggers modal) -->
                        <button type="button" class="dropdown-item danger" id="logoutBtn">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </div>
                </div>
            </div>

            <!-- Logout Confirmation Modal -->
            <div class="modal-overlay" id="logoutModal">
                <div class="modal-container">
                    <div class="modal-header">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <h3>Confirm Logout</h3>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to log out? You will need to sign in again to access your account.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="modal-btn modal-btn-cancel" id="cancelLogoutBtn">Cancel</button>
                        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                            @csrf
                            <button type="submit" class="modal-btn modal-btn-confirm">Yes, Logout</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <!-- Filters -->
            <div class="filter-card">
                <form method="GET" action="{{ route('jobseeker.jobs.index') }}" class="filter-form">
                    <div class="filter-field">
                        <label class="field-label">Experience Level</label>
                        <select name="experience_level" class="field-select">
                            <option value="">Any experience</option>
                            <option value="entry" @if(request('experience_level') == 'entry') selected @endif>Entry Level
                            </option>
                            <option value="mid" @if(request('experience_level') == 'mid') selected @endif>Mid Level</option>
                            <option value="senior" @if(request('experience_level') == 'senior') selected @endif>Senior Level
                            </option>
                        </select>
                    </div>
                    <div class="filter-actions">
                        <button type="submit" class="btn-primary">Apply Filters</button>
                        <a href="{{ route('jobseeker.jobs.index') }}" class="btn-ghost">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Job Listings -->
            <div class="jobs-list">
                @forelse($jobs as $job)
                    @php
                        // FIXED: Use the correct relationship name 'jobseekerProfile' instead of 'profile'
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
                            // Handle if skills_required is a string
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

                        // Calculate match using intersection (more efficient)
                        $matched = $jobSkills->intersect($candidateSkills)->count();
                        $totalNeeded = $jobSkills->count();

                        // Calculate percentage
                        $match = $totalNeeded > 0 ? round(($matched / $totalNeeded) * 100, 2) : 0;

                        // Determine match color class
                        $matchColor = $match >= 70 ? 'match-high' : ($match >= 40 ? 'match-mid' : 'match-low');
                        $matchBarClass = $match >= 70 ? 'match-high' : ($match >= 40 ? 'match-mid' : 'match-low');
                    @endphp

                    <div class="job-card">
                        <div class="job-top">
                            <div class="job-title-wrap">
                                <h2 class="job-title">
                                    <a href="{{ route('jobseeker.jobs.show', $job) }}">{{ $job->title }}</a>
                                </h2>
                                <p class="job-desc">{{ Str::limit($job->description, 120) }}</p>
                            </div>
                            <div class="job-actions">
                                <a href="{{ route('jobseeker.jobs.show', $job) }}" class="btn-ghost">View</a>
                                <a href="{{ route('jobseeker.jobs.apply.form', $job) }}" class="btn-primary">Apply</a>
                            </div>
                        </div>

                        <div class="job-meta">
                            <span class="badge badge-gray">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                {{ $job->location ?? 'N/A' }}
                            </span>
                            <span class="badge badge-gray">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 12h4" />
                                    <path d="M10 8h4" />
                                    <path d="M14 21v-3a2 2 0 0 0-4 0v3" />
                                    <path d="M6 10H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2" />
                                    <path d="M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16" />
                                </svg>
                                @php
                                    $expLevel = $job->experience_level ?? '';
                                    $displayLevel = match ($expLevel) {
                                        'entry' => 'Entry Level',
                                        'mid' => 'Mid Level',
                                        'senior' => 'Senior Level',
                                        default => 'Any Experience',
                                    };
                                @endphp
                                {{ $displayLevel }}
                            </span>
                            <span class="badge {{ $matchColor }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="19" x2="5" y1="5" y2="19" />
                                    <circle cx="6.5" cy="6.5" r="2.5" />
                                    <circle cx="17.5" cy="17.5" r="2.5" />
                                </svg>
                                Match: {{ $match }}%
                            </span>
                        </div>

                        <div class="match-bar-wrap">
                            <div class="match-bar-track">
                                <div class="match-bar-fill {{ $matchBarClass }}" style="width: {{ $match }}%"></div>
                            </div>
                        </div>

                        <div class="job-skills">
                            <p class="skills-label">Skills Required</p>
                            <div class="skills-wrap">
                                @if($jobSkills->count() > 0)
                                    @foreach($jobSkills->take(5) as $skill)
                                        @php
                                            $isMatch = $candidateSkills->contains($skill);
                                        @endphp
                                        <span class="skill-tag {{ $isMatch ? 'skill-matched' : '' }}">
                                            {{ $isMatch ? '✓' : '' }} {{ ucfirst($skill) }}
                                        </span>
                                    @endforeach
                                    @if($jobSkills->count() > 5)
                                        <span class="skill-tag">+{{ $jobSkills->count() - 5 }} more</span>
                                    @endif
                                @else
                                    <span class="no-skills">No specific skills required</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                        </div>
                        <div class="empty-title">No jobs found</div>
                        <p class="empty-sub">Try adjusting your filters or check back later for new opportunities</p>
                        <a href="{{ route('jobseeker.jobs.index') }}" class="btn-primary">Clear Filters</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($jobs->hasPages())
                <div class="pagination-wrap">
                    {{ $jobs->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Profile Dropdown Toggle
        const profileDropdown = document.getElementById('profileDropdown');
        const profileBtn = document.getElementById('profileBtn');

        if (profileBtn && profileDropdown) {
            profileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('active');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!profileDropdown.contains(e.target)) {
                    profileDropdown.classList.remove('active');
                }
            });
        }

        // Logout Modal
        const logoutBtn = document.getElementById('logoutBtn');
        const logoutModal = document.getElementById('logoutModal');
        const cancelLogoutBtn = document.getElementById('cancelLogoutBtn');

        if (logoutBtn) {
            logoutBtn.addEventListener('click', () => {
                logoutModal.classList.add('active');
                profileDropdown.classList.remove('active');
            });
        }

        if (cancelLogoutBtn) {
            cancelLogoutBtn.addEventListener('click', () => {
                logoutModal.classList.remove('active');
            });
        }

        // Close modal when clicking outside
        if (logoutModal) {
            logoutModal.addEventListener('click', (e) => {
                if (e.target === logoutModal) {
                    logoutModal.classList.remove('active');
                }
            });
        }
    </script>
@endsection