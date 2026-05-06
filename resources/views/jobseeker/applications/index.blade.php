@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Section --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">My Applications</h1>
                    <p class="mt-1 text-sm text-gray-500">Track and manage all your job applications in one place</p>
                </div>
                <a href="{{ route('jobseeker.jobs.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md hover:from-indigo-700 hover:to-purple-700 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Browse Jobs
                </a>
            </div>

            {{-- Stats Summary --}}
            @if(!$applications->isEmpty())
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-xs uppercase tracking-wide">Total</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $applications->count() }}</p>
                            </div>
                            <div class="h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-xs uppercase tracking-wide">Pending</p>
                                <p class="text-2xl font-bold text-yellow-600">{{ $applications->where('status', 'pending')->count() }}</p>
                            </div>
                            <div class="h-10 w-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-xs uppercase tracking-wide">Accepted</p>
                                <p class="text-2xl font-bold text-green-600">{{ $applications->where('status', 'accepted')->count() }}</p>
                            </div>
                            <div class="h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-xs uppercase tracking-wide">Rejected</p>
                                <p class="text-2xl font-bold text-red-600">{{ $applications->where('status', 'rejected')->count() }}</p>
                            </div>
                            <div class="h-10 w-10 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Applications List / Empty State --}}
            @if($applications->isEmpty())
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-12 text-center">
                    <div class="max-w-sm mx-auto">
                        <div class="w-20 h-20 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-5">
                            <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No applications yet</h3>
                        <p class="text-gray-500 text-sm mb-6">When you apply for jobs, they’ll show up here. Start your job search today!</p>
                        <a href="{{ route('jobseeker.jobs.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-2.5 text-sm font-semibold text-white shadow-md hover:from-indigo-700 hover:to-purple-700 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Browse Available Jobs
                        </a>
                    </div>
                </div>
            @else
                {{-- Applications Cards --}}
                <div class="space-y-4">
                    @foreach($applications as $application)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200 overflow-hidden">
                            <div class="p-5">
                                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                    {{-- Left: Job Info --}}
                                    <div class="flex-1">
                                        <div class="flex items-start gap-4">
                                            {{-- Job Icon --}}
                                            <div class="hidden sm:flex w-12 h-12 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                                <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            </div>

                                            {{-- Job Details --}}
                                            <div>
                                                <a href="{{ route('jobseeker.jobs.show', $application->job) }}"
                                                    class="text-lg font-semibold text-gray-900 hover:text-indigo-600 transition-colors">
                                                    {{ $application->job->title }}
                                                </a>
                                                <div class="flex flex-wrap items-center gap-3 mt-2">
                                                    <span class="inline-flex items-center gap-1 text-xs text-gray-500">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                        {{ $application->job->location ?? 'Remote / Flexible' }}
                                                    </span>
                                                    <span class="inline-flex items-center gap-1 text-xs text-gray-500">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        Applied {{ $application->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Right: Status & Action --}}
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                                        {{-- Status Badge --}}
                                        @php
                                            $statusConfig = [
                                                'pending' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-800', 'dot' => 'bg-yellow-500', 'label' => 'Pending Review'],
                                                'accepted' => ['bg' => 'bg-green-50', 'text' => 'text-green-800', 'dot' => 'bg-green-500', 'label' => 'Accepted'],
                                                'rejected' => ['bg' => 'bg-red-50', 'text' => 'text-red-800', 'dot' => 'bg-red-500', 'label' => 'Not Selected'],
                                                'reviewing' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-800', 'dot' => 'bg-blue-500', 'label' => 'In Review'],
                                            ];
                                            $config = $statusConfig[$application->status] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-800', 'dot' => 'bg-gray-500', 'label' => ucfirst($application->status)];
                                        @endphp
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium {{ $config['bg'] }} {{ $config['text'] }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $config['dot'] }}"></span>
                                            {{ $config['label'] }}
                                        </span>

                                        {{-- View Details Button --}}
                                        <a href="{{ route('jobseeker.applications.show', $application) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                                            View Application
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                {{-- Additional Info for Accepted/Rejected --}}
                                @if($application->status === 'accepted' && $application->feedback)
                                    <div class="mt-4 pt-4 border-t border-gray-100">
                                        <div class="flex items-start gap-2 text-sm">
                                            <svg class="w-4 h-4 text-green-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-gray-600">{{ $application->feedback }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if(method_exists($applications, 'links') && $applications->hasPages())
                    <div class="mt-8">
                        {{ $applications->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection