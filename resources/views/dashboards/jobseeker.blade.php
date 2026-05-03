@extends('layouts.app')

@section('title', 'Job Seeker Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Find your dream job and track your applications
                </p>
            </div>
            <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>

        <!-- Profile Completion Banner -->
        @if($profileCompletion < 100)
            <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-2xl border border-purple-100 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div class="text-3xl">⭐</div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Complete your profile</h2>
                            <p class="text-sm text-gray-600 mt-1">
                                Your profile is {{ $profileCompletion }}% complete.
                                A complete profile increases your chances of getting hired by 40%
                            </p>
                            <div class="w-full max-w-md mt-2 bg-gray-200 rounded-full h-2">
                                <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $profileCompletion }}%"></div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('jobseeker.profile.show') }}"
                        class="inline-flex items-center justify-center bg-purple-600 text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-purple-700 transition-all shadow-md hover:shadow-lg">
                        Complete Profile →
                    </a>
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-lg transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-4xl">📊</div>
                    <div class="text-2xl font-bold text-blue-600">{{ $applicationsCount }}</div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Applied Jobs</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $applicationsCount > 0 ? '+' . min(3, $applicationsCount) : '0' }}
                    this week</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-lg transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-4xl">⏳</div>
                    <div class="text-2xl font-bold text-yellow-600">{{ $underReviewCount }}</div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Under Review</h3>
                <p class="text-sm text-gray-500 mt-1">Awaiting response</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-lg transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-4xl">🎯</div>
                    <div class="text-2xl font-bold text-green-600">{{ $interviewsCount }}</div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Interviews</h3>
                <p class="text-sm text-gray-500 mt-1">Scheduled</p>
            </div>
        </div>

        <!-- Tab Controller -->
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <!-- Tab Headers -->
            <div class="border-b border-gray-200">
                <div class="flex">
                    <button class="tab-btn active px-6 py-4 text-sm font-semibold transition-all"
                        onclick="switchTab('find-jobs')">
                        💼 Find Jobs
                    </button>
                    <button class="tab-btn px-6 py-4 text-sm font-semibold transition-all"
                        onclick="switchTab('my-applications')">
                        📋 My Applications
                    </button>
                </div>
            </div>

            <!-- FIND JOBS TAB -->
            <div id="find-jobs-tab" class="tab-content active">
                <!-- Search Bar -->
                <div class="p-6 border-b border-gray-200">
                    <form method="GET" action="{{ route('jobseeker.jobs.index') }}" class="flex gap-2">
                        <div class="flex-1 relative">
                            <input type="text" name="search" placeholder="Search by job title, skills, or keywords..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ request('search') }}">
                        </div>
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-all">
                            Search Jobs
                        </button>
                    </form>
                </div>

                <!-- Recommended Jobs List -->
                <div class="divide-y divide-gray-200">
                    @forelse($recommendedJobs as $job)
                        <div class="p-6 hover:bg-gray-50 transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <h4 class="text-lg font-semibold text-gray-900">
                                            <a href="{{ route('jobseeker.jobs.show', $job) }}" class="hover:text-blue-600">
                                                {{ $job->title }}
                                            </a>
                                        </h4>
                                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">
                                            {{ ucfirst($job->employment_type ?? 'Full-time') }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">
                                        {{ $job->employer->employerProfile->company_name ?? 'Company' }}
                                    </p>
                                    <div class="flex flex-wrap gap-3 mb-2">
                                        <span class="text-xs text-gray-500">📍 {{ $job->location }}</span>
                                        <span class="text-xs text-gray-500">🧭
                                            {{ ucfirst($job->experience_level ?? 'Any') }}</span>
                                        @if($job->salary)
                                            <span class="text-xs text-gray-500">💰 ${{ number_format($job->salary) }}</span>
                                        @endif
                                        <span class="text-xs text-gray-500">📅 {{ $job->created_at->diffForHumans() }}</span>
                                    </div>
                                    @if($job->skills_required && count($job->skills_required) > 0)
                                        <div class="flex flex-wrap gap-1 mt-2">
                                            @foreach(array_slice($job->skills_required, 0, 3) as $skill)
                                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">{{ $skill }}</span>
                                            @endforeach
                                            @if(count($job->skills_required) > 3)
                                                <span class="text-xs text-gray-500">+{{ count($job->skills_required) - 3 }} more</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route('jobseeker.jobs.apply.form', $job) }}"
                                        class="inline-flex items-center bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-all">
                                        Apply Now →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <div class="text-6xl mb-4">🔍</div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">No jobs found</h4>
                            <p class="text-gray-500">Try adjusting your search or check back later for new opportunities</p>
                            <a href="{{ route('jobseeker.profile.show') }}"
                                class="inline-block mt-4 text-blue-600 hover:text-blue-700">
                                Update your profile for better matches →
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- MY APPLICATIONS TAB -->
            <div id="my-applications-tab" class="tab-content">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Job Title</th>
                                <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Company</th>
                                <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Applied On</th>
                                <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Status</th>
                                <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($recentApplications as $application)
                                <tr class="hover:bg-gray-50 transition-all">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('jobseeker.jobs.show', $application->job) }}"
                                            class="font-medium text-gray-900 hover:text-blue-600">
                                            {{ $application->job->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $application->job->employer->employerProfile->company_name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $application->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'reviewing' => 'bg-blue-100 text-blue-800',
                                                'interview' => 'bg-purple-100 text-purple-800',
                                                'interview_scheduled' => 'bg-green-100 text-green-800',
                                                'offered' => 'bg-green-100 text-green-800',
                                                'rejected' => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span
                                            class="px-2 py-1 text-xs rounded-full {{ $statusColors[$application->status] ?? 'bg-gray-100 text-gray-600' }}">
                                            {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($application->status == 'interview_scheduled' || $application->status == 'interview')
                                            <div class="space-y-1">
                                                <span class="text-purple-600 text-xs font-semibold block">Interview Scheduled</span>
                                                <a href="{{ route('jobseeker.interviews.join', $application->interview_session_id ?? '#') }}"
                                                    class="text-blue-600 hover:text-blue-700 text-xs font-semibold inline-flex items-center gap-1">
                                                    Join Interview →
                                                </a>
                                            </div>
                                        @elseif($application->status == 'offered')
                                            <div class="space-y-1">
                                                <span class="text-green-600 text-xs font-semibold block">🎉 Offer Received</span>
                                                <a href="{{ route('jobseeker.applications.show', $application) }}"
                                                    class="text-green-600 hover:text-green-700 text-xs">
                                                    View Offer Details →
                                                </a>
                                            </div>
                                        @elseif($application->status == 'rejected')
                                            <div class="space-y-1">
                                                <span class="text-red-600 text-xs font-semibold block">Not Selected</span>
                                                <a href="{{ route('jobseeker.applications.show', $application) }}"
                                                    class="text-red-600 hover:text-red-700 text-xs">
                                                    View Feedback →
                                                </a>
                                            </div>
                                        @elseif($application->status == 'pending')
                                            <div class="space-y-1">
                                                <span class="text-yellow-600 text-xs font-semibold block">Under Review</span>
                                                <span class="text-gray-400 text-xs">Awaiting response</span>
                                            </div>
                                        @elseif($application->status == 'reviewing')
                                            <div class="space-y-1">
                                                <span class="text-blue-600 text-xs font-semibold block">In Review</span>
                                                <span class="text-gray-400 text-xs">HR is reviewing your application</span>
                                            </div>
                                        @else
                                            <div class="space-y-1">
                                                <span class="text-gray-400 text-xs">Application Submitted</span>
                                                <span class="text-gray-400 text-xs">In progress</span>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <div class="text-4xl mb-2">📭</div>
                                        <p>No applications yet</p>
                                        <a href="{{ route('jobseeker.jobs.index') }}"
                                            class="inline-block mt-2 text-blue-600 hover:text-blue-700">
                                            Browse jobs to get started →
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if(count($recentApplications) > 0)
                        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                            <a href="{{ route('jobseeker.applications.index') }}"
                                class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                                View All Applications →
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Tab Switching -->
    <script>
        // Add ripple effect to tab buttons
        function addRippleEffect(event, element) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');

            const rect = element.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = event.clientX - rect.left - size / 2;
            const y = event.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = `${size}px`;
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;

            element.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        }

        // Enhanced switchTab function with animation
        function switchTab(tabName) {
            const findJobsTab = document.getElementById('find-jobs-tab');
            const myApplicationsTab = document.getElementById('my-applications-tab');
            const buttons = document.querySelectorAll('.tab-btn');

            // Add exit animation to current active tab
            const activeContent = document.querySelector('.tab-content.active');
            if (activeContent) {
                activeContent.style.animation = 'fadeOutSlide 0.2s ease forwards';
                setTimeout(() => {
                    activeContent.classList.remove('active');
                    activeContent.style.animation = '';
                }, 150);
            }

            // Remove active class from buttons
            buttons.forEach(btn => {
                btn.classList.remove('active');
            });

            // Show the selected tab with delay for smooth transition
            setTimeout(() => {
                if (tabName === 'find-jobs') {
                    if (findJobsTab) {
                        findJobsTab.classList.add('active');
                        findJobsTab.style.animation = 'fadeInSlide 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards';
                    }
                    buttons[0].classList.add('active');
                } else if (tabName === 'my-applications') {
                    if (myApplicationsTab) {
                        myApplicationsTab.classList.add('active');
                        myApplicationsTab.style.animation = 'fadeInSlide 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards';
                    }
                    buttons[1].classList.add('active');
                }
            }, 150);

            // Save to localStorage
            localStorage.setItem('activeDashboardTab', tabName);
        }

        // Attach ripple effect to tab buttons
        document.addEventListener('DOMContentLoaded', function () {
            const tabBtns = document.querySelectorAll('.tab-btn');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    addRippleEffect(e, this);
                });
            });

            const savedTab = localStorage.getItem('activeDashboardTab');
            if (savedTab === 'find-jobs' || savedTab === 'my-applications') {
                switchTab(savedTab);
            }
        });
    </script>

    <style>
        .tab-btn {
            position: relative;
            color: #6b7280;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .tab-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.1) 0%, transparent 70%);
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.3s ease, transform 0.3s ease;
            border-radius: 8px;
        }

        .tab-btn:hover::before {
            opacity: 1;
            transform: scale(1);
        }

        .tab-btn.active {
            color: #2563eb;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #2563eb, #60a5fa, #2563eb);
            border-radius: 3px;
            animation: slideIn 0.4s ease-out;
        }

        .tab-btn:active {
            transform: scale(0.95);
            transition: transform 0.1s;
        }

        .tab-content {
            display: none;
            opacity: 0;
            transform: translateX(20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .tab-content.active {
            display: block;
            animation: fadeInSlide 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes fadeInSlide {
            0% {
                opacity: 0;
                transform: translateX(20px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideIn {
            0% {
                width: 0;
                left: 50%;
                right: 50%;
            }

            100% {
                width: 100%;
                left: 0;
                right: 0;
            }
        }

        /* Optional: Add ripple effect on click */
        .tab-btn {
            position: relative;
            overflow: hidden;
        }

        .tab-btn .ripple {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(37, 99, 235, 0.3);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Hover glow effect */
        .tab-btn:hover {
            filter: brightness(1.02);
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.1);
        }

        /* Active tab pulse effect */
        .tab-btn.active {
            animation: gentlePulse 0.5s ease-out;
        }

        @keyframes gentlePulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Content exit animation (when switching) */
        .tab-content {
            animation: fadeOutSlide 0.2s ease forwards;
        }

        .tab-content.active {
            animation: fadeInSlide 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes fadeOutSlide {
            0% {
                opacity: 1;
                transform: translateX(0);
            }

            100% {
                opacity: 0;
                transform: translateX(-20px);
                display: none;
            }
        }
    </style>
@endsection