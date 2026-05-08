@extends('layouts.app')

@section('title', 'Job Seeker Dashboard')

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

        .btn-outline:hover {
            background: #eff6ff;
        }

        /* ===== STATS CARDS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
            transition: box-shadow 0.15s, border-color 0.15s;
        }

        .stat-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
            border-color: #d1d5db;
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
        }

        .stat-title {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }

        .stat-sub {
            font-size: 0.75rem;
            color: #6b7280;
        }

        /* ===== TAB CONTROLLER ===== */
        .tab-controller {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            overflow: hidden;
        }

        .tab-headers {
            display: flex;
            border-bottom: 1px solid #e5e7eb;
            background: #fff;
            padding: 0 20px;
        }

        .tab-btn {
            padding: 14px 20px;
            font-size: 0.875rem;
            font-weight: 600;
            color: #6b7280;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .tab-btn.active {
            color: #2563eb;
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background: #2563eb;
            border-radius: 2px;
        }

        .tab-btn:hover:not(.active) {
            color: #374151;
            background: #f9fafb;
        }

        .tab-content {
            display: none;
            padding: 24px;
        }

        .tab-content.active {
            display: block;
        }

        /* ===== SEARCH CARD ===== */
        .search-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
        }

        .search-form {
            display: flex;
            gap: 12px;
        }

        .search-input-wrapper {
            flex: 1;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 10px 16px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.15s;
        }

        .search-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
        }

        /* ===== JOB CARD ===== */
        .job-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 12px;
            transition: box-shadow 0.15s, border-color 0.15s;
        }

        .job-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
            border-color: #d1d5db;
        }

        .job-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .job-title {
            font-size: 1.0625rem;
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

        .job-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: 999px;
            background: #f3f4f6;
            color: #374151;
        }

        .skills-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 12px;
        }

        .skill-tag {
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #374151;
        }

        /* ===== APPLICATIONS TABLE ===== */
        .table-wrapper {
            overflow-x: auto;
        }

        .applications-table {
            width: 100%;
            border-collapse: collapse;
        }

        .applications-table th {
            text-align: left;
            padding: 12px 16px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .applications-table td {
            padding: 16px;
            font-size: 0.875rem;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
        }

        .applications-table tr:hover td {
            background: #f9fafb;
        }

        .status-badge {
            display: inline-flex;
            padding: 4px 10px;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: 999px;
        }

        .status-pending {
            background: #fef9c3;
            color: #a16207;
        }

        .status-reviewing {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-interview {
            background: #f3e8ff;
            color: #6b21a5;
        }

        .status-offered {
            background: #dcfce7;
            color: #15803d;
        }

        .status-rejected {
            background: #fee2e2;
            color: #b91c1c;
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
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .stats-grid {
                gap: 12px;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .tab-headers {
                padding: 0 12px;
            }

            .tab-btn {
                padding: 12px 16px;
                font-size: 0.813rem;
            }

            .tab-content {
                padding: 16px;
            }

            .search-form {
                flex-direction: column;
            }

            .job-top {
                flex-direction: column;
            }
        }
    </style>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="page-sub">Find your dream job and track your applications</p>
            </div>
            <a href="{{ route('jobseeker.profile.show') }}" class="btn-outline">
                👤 My Profile
            </a>
        </div>

        <!-- Profile Completion Banner -->
        @if($profileCompletion < 100)
            <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-2xl border border-purple-100 p-5">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div class="text-2xl">⭐</div>
                        <div>
                            <h2 class="font-semibold text-gray-900">Complete your profile</h2>
                            <p class="text-sm text-gray-600 mt-0.5">
                                Your profile is {{ $profileCompletion }}% complete. A complete profile increases your chances of
                                getting hired by 40%
                            </p>
                            <div class="w-64 mt-2 bg-gray-200 rounded-full h-1.5">
                                <div class="bg-purple-600 h-1.5 rounded-full" style="width: {{ $profileCompletion }}%"></div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('jobseeker.profile.show') }}" class="btn-primary">
                        Complete Profile →
                    </a>
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <lord-icon src="https://cdn.lordicon.com/lbcxnxti.json" trigger="loop" stroke="bold" state="loop-cycle"
                        colors="primary:#110a5c,secondary:#3080e8" style="width:40px;height:40px">
                    </lord-icon>
                    <span class="stat-value text-black">{{ $applicationsCount }}</span>
                </div>
                <div class="stat-title">Applied Jobs</div>
                <div class="stat-sub font-bold text-black ">{{ $applicationsCount > 0 ? '+' . min(3, $applicationsCount) : '0' }} this week</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <lord-icon src="https://cdn.lordicon.com/warimioc.json" trigger="hover" stroke="bold"
                        colors="primary:#110a5c,secondary:#3080e8" style="width:40px;height:40px">
                    </lord-icon>
                    <span class="stat-value text-black">{{ $underReviewCount }}</span>
                </div>
                <div class="stat-title">Under Review</div>
                <div class="stat-sub font-bold text-black ">Awaiting response</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <lord-icon src="https://cdn.lordicon.com/weqkkuwt.json" trigger="hover" stroke="bold"
                        state="hover-enlarge" colors="primary:#110a5c,secondary:#3080e8" style="width:40px;height:40px">
                    </lord-icon>
                    <span class="stat-value text-black">{{ $interviewsCount }}</span>
                </div>
                <div class="stat-title">Interviews</div>
                <div class="stat-sub font-bold text-black ">Scheduled</div>
            </div>
        </div>

        <!-- Tab Controller -->
        <div class="tab-controller">
            <div class="tab-headers">
                <button class="tab-btn active inline-flex items-center gap-2" onclick="switchTab('find-jobs')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 12h.01" />
                        <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                        <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                        <rect width="20" height="14" x="2" y="6" rx="2" />
                    </svg>
                    <span>Find Jobs</span>
                </button>
                <button class="tab-btn" onclick="switchTab('my-applications')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        style="display: inline-block; vertical-align: middle;">
                        <path d="M15 12h-5" />
                        <path d="M15 8h-5" />
                        <path d="M19 17V5a2 2 0 0 0-2-2H4" />
                        <path
                            d="M8 21h12a2 2 0 0 0 2-2v-1a1 1 0 0 0-1-1H11a1 1 0 0 0-1 1v1a2 2 0 1 1-4 0V5a2 2 0 1 0-4 0v2a1 1 0 0 0 1 1h3" />
                    </svg>
                    <span>My Applications</span>
                </button>
            </div>

            <!-- Find Jobs Tab -->
            <div id="find-jobs-tab" class="tab-content active">
                <!-- Search Card -->
                <div class="search-card">
                    <form method="GET" action="{{ route('jobseeker.jobs.index') }}" class="search-form">
                        <div class="search-input-wrapper">
                            <input type="text" name="search" placeholder="Search by job title, skills, or keywords..."
                                class="search-input" value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="btn-primary">Search Jobs</button>
                    </form>
                </div>

                <!-- Jobs List -->
                @forelse($recommendedJobs as $job)
                    <div class="job-card">
                        <div class="job-top">
                            <div class="flex-1">
                                <h3 class="job-title">
                                    <a href="{{ route('jobseeker.jobs.show', $job) }}">{{ $job->title }}</a>
                                </h3>
                                <p class="job-desc">{{ Str::limit($job->description ?? 'No description available', 120) }}</p>
                            </div>
                            <div>
                                <a href="{{ route('jobseeker.jobs.apply.form', $job) }}" class="btn-primary">Apply Now →</a>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <!-- Location Badge - Blue -->
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                <span>{{ $job->location ?? 'N/A' }}</span>
                            </span>

                            <!-- Experience Level Badge - Purple -->
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
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
                                <span>{{ ucfirst($job->experience_level ?? 'Any') }}</span>
                            </span>

                            <!-- Salary Badge - Green (only if salary exists) -->
                            @if($job->salary)
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium ">
                                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-black">${{ number_format($job->salary) }}/year</span>
                                </span>
                            @endif

                            <!-- Posted Date Badge - Gray -->
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium">
                                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $job->created_at->diffForHumans() }}</span>
                            </span>

                            <!-- Remote Badge (optional - if job is remote) -->
                            @if($job->is_remote ?? false)
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-teal-50 text-teal-700">
                                    <svg class="w-3.5 h-3.5 text-teal-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.66 0 3-4 3-9s-1.34-9-3-9m0 18c-1.66 0-3-4-3-9s1.34-9 3-9" />
                                    </svg>
                                    <span>Remote</span>
                                </span>
                            @endif
                        </div>
                        @if($job->skills_required && count($job->skills_required) > 0)
                            <div class="skills-wrap">
                                @foreach($job->skills_required as $skill)
                                    <span class="skill-tag">{{ $skill }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">🔍</div>
                        <div class="empty-title">No jobs found</div>
                        <p class="empty-sub">Try adjusting your search or check back later for new opportunities</p>
                        <a href="{{ route('jobseeker.profile.show') }}" class="btn-outline mt-4">Update your profile</a>
                    </div>
                @endforelse
            </div>

            <!-- My Applications Tab -->
            <div id="my-applications-tab" class="tab-content">
                <div class="table-wrapper">
                    <table class="applications-table">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Company</th>
                                <th>Applied On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentApplications as $application)
                                <tr>
                                    <td>
                                        <a href="{{ route('jobseeker.jobs.show', $application->job) }}"
                                            class="font-medium text-gray-900 hover:text-blue-600">
                                            {{ $application->job->title }}
                                        </a>
                                    </td>
                                    <td>{{ $application->job->employer->employerProfile->company_name ?? 'N/A' }}</td>
                                    <td>{{ $application->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($application->status) {
                                                'pending' => 'status-pending',
                                                'reviewing' => 'status-reviewing',
                                                'interview', 'interview_scheduled' => 'status-interview',
                                                'offered' => 'status-offered',
                                                'rejected' => 'status-rejected',
                                                default => 'status-pending'
                                            };
                                        @endphp
                                        <span class="status-badge {{ $statusClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if(in_array($application->status, ['interview_scheduled', 'interview']))
                                            <a href="{{ route('jobseeker.interviews.join', $application->interview_session_id ?? '#') }}"
                                                class="text-blue-600 text-sm font-medium">Join Interview →</a>
                                        @elseif($application->status == 'offered')
                                            <a href="{{ route('jobseeker.applications.show', $application) }}"
                                                class="text-green-600 text-sm font-medium">View Offer →</a>
                                        @else
                                            <a href="{{ route('jobseeker.applications.show', $application) }}"
                                                class="text-gray-500 text-sm font-medium hover:text-blue-600">View Details →</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-12 text-gray-500">No applications yet. Start browsing
                                        jobs!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if(count($recentApplications) > 0)
                    <div class="mt-4 pt-4 border-t border-gray-100 text-center">
                        <a href="{{ route('jobseeker.applications.index') }}" class="btn-ghost">View All Applications →</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script>
        function switchTab(tabName) {
            const findTab = document.getElementById('find-jobs-tab');
            const appsTab = document.getElementById('my-applications-tab');
            const buttons = document.querySelectorAll('.tab-btn');

            findTab.classList.remove('active');
            appsTab.classList.remove('active');
            buttons.forEach(btn => btn.classList.remove('active'));

            if (tabName === 'find-jobs') {
                findTab.classList.add('active');
                buttons[0].classList.add('active');
            } else {
                appsTab.classList.add('active');
                buttons[1].classList.add('active');
            }

            localStorage.setItem('activeDashboardTab', tabName);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const savedTab = localStorage.getItem('activeDashboardTab');
            if (savedTab === 'my-applications') switchTab('my-applications');
        });
    </script>
@endsection