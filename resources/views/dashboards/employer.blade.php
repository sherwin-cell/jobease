@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Employer Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500">
                Welcome back, <strong class="text-gray-900">{{ auth()->user()->name }}</strong>. Here's what's happening with your recruitment.
            </p>
        </div>
        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
            {{ now()->format('l, F j, Y') }}
        </div>
    </div>

    <!-- Quick Action Banner -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border border-blue-100 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-start gap-3">
                <div class="text-3xl">✨</div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Post your next role</h2>
                    <p class="text-sm text-gray-600 mt-1">Create a job post and start receiving qualified applications.</p>
                </div>
            </div>
            <a href="{{ route('employer.jobs.create') }}" 
                class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2.5 rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all shadow-md hover:shadow-lg">
                ✨ Create Job Posting
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-lg transition-all">
            <div class="flex items-center justify-between mb-3">
                <div class="text-4xl">💼</div>
                <div class="text-2xl font-bold text-blue-600">{{ $activeJobs ?? 0 }}</div>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">Active Jobs</h3>
            <p class="text-sm text-gray-500 mt-1">{{ $activeJobs ?? 0 }} active listings</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-lg transition-all">
            <div class="flex items-center justify-between mb-3">
                <div class="text-4xl">📋</div>
                <div class="text-2xl font-bold text-green-600">{{ $totalApplicants ?? 0 }}</div>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">Total Applicants</h3>
            <p class="text-sm text-gray-500 mt-1">+{{ $applicantsThisMonth ?? 0 }} this month</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-lg transition-all">
            <div class="flex items-center justify-between mb-3">
                <div class="text-4xl">⭐</div>
                <div class="text-2xl font-bold text-yellow-600">{{ $shortlisted ?? 0 }}</div>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">Shortlisted</h3>
            <p class="text-sm text-gray-500 mt-1">Across all jobs</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-lg transition-all">
            <div class="flex items-center justify-between mb-3">
                <div class="text-4xl">🎯</div>
                <div class="text-2xl font-bold text-purple-600">{{ $interviews ?? 0 }}</div>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">Interviews</h3>
            <p class="text-sm text-gray-500 mt-1">Scheduled</p>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <div class="border-b border-gray-200">
            <div class="flex">
                <button class="tab-btn active px-6 py-3 text-sm font-semibold transition-all" data-tab="jobs">
                    💼 Job Postings
                </button>
                <button class="tab-btn px-6 py-3 text-sm font-semibold transition-all" data-tab="applications">
                    📋 Applicants
                </button>
            </div>
        </div>

        <!-- Jobs Tab -->
        <div id="jobs-tab" class="tab-content active p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Your Job Postings</h2>
                    <p class="text-sm text-gray-500 mt-1">Manage and track your active job listings</p>
                </div>
                <div class="relative">
                    <input type="text" id="search-jobs" placeholder="Search jobs..." 
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="space-y-4" id="jobs-list">
                @forelse($jobs ?? [] as $job)
                <div class="job-card border border-gray-200 rounded-xl p-5 hover:shadow-lg transition-all">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2 flex-wrap">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $job->title }}</h3>
                                @php
                                    $statusColors = [
                                        'active' => 'bg-green-100 text-green-700',
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'rejected' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$job->status] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($job->status) }}
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                                <span>📍 {{ $job->location }}</span>
                                <span>🧭 {{ ucfirst($job->experience_level ?? 'Any') }}</span>
                                <span>📅 Posted {{ $job->created_at->diffForHumans() }}</span>
                                <span>👥 {{ $job->applications_count ?? 0 }} applicants</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('employer.jobs.show', $job) }}" 
                               class="px-4 py-2 text-sm font-medium text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                                View Details →
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">📭</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No job postings yet</h3>
                    <p class="text-gray-500 mb-4">Create your first job posting to start receiving applications</p>
                    <a href="{{ route('employer.jobs.create') }}" class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        ✨ Create Job Posting
                    </a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Applications Tab -->
        <div id="applications-tab" class="tab-content p-6">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900">Recent Applications</h2>
                <p class="text-sm text-gray-500 mt-1">Review and manage applications from candidates</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Candidate</th>
                            <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Job Title</th>
                            <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Applied On</th>
                            <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Status</th>
                            <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentApplications ?? [] as $application)
                        <tr class="hover:bg-gray-50 transition-all">
                            <td class="px-4 py-3">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $application->user->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">{{ $application->user->email ?? 'N/A' }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $application->job->title ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $application->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $appStatusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'reviewing' => 'bg-blue-100 text-blue-700',
                                        'shortlisted' => 'bg-purple-100 text-purple-700',
                                        'interview' => 'bg-indigo-100 text-indigo-700',
                                        'interview_scheduled' => 'bg-green-100 text-green-700',
                                        'rejected' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs rounded-full {{ $appStatusColors[$application->status] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('employer.applications.show', $application) }}" 
                                   class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                    Review →
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center text-gray-500">
                                <div class="text-6xl mb-4">📭</div>
                                <p>No applications yet</p>
                                <p class="text-sm mt-1">Applications will appear here once candidates start applying</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
</div>

<script>
    // Tab switching
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    function switchTab(tabId) {
        tabContents.forEach(content => content.classList.remove('active'));
        tabBtns.forEach(btn => btn.classList.remove('active'));
        
        document.getElementById(tabId + '-tab').classList.add('active');
        document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
    }
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => switchTab(btn.dataset.tab));
    });
    
    // Search functionality
    const searchInput = document.getElementById('search-jobs');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const jobCards = document.querySelectorAll('.job-card');
            
            jobCards.forEach(card => {
                const title = card.querySelector('h3')?.textContent.toLowerCase() || '';
                if (title.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
</script>

<style>
    .tab-btn {
        position: relative;
        color: #6b7280;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .tab-btn.active {
        color: #2563eb;
        background: #eff6ff;
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
    
    .tab-content {
        display: none;
    }
    
    .tab-content.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .job-card {
        transition: all 0.2s;
    }
    
    .job-card:hover {
        transform: translateY(-2px);
    }
</style>
@endsection