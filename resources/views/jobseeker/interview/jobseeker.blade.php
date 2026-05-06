@extends('layouts.app')

@section('title', 'My Interviews')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header Section --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">My Interviews</h1>
                    <p class="text-sm text-gray-500 mt-0.5">Manage and join your scheduled interviews</p>
                </div>
            </div>
        </div>

        @php
            // Filter sessions to show only relevant ones based on time
            $now = \Carbon\Carbon::now();
            
            $filteredSessions = $sessions->filter(function($session) use ($now) {
                $scheduledTime = \Carbon\Carbon::parse($session->scheduled_at);
                $hoursPast = $now->diffInHours($scheduledTime, false);
                
                // Show interviews that are:
                // 1. Not completed yet AND
                // 2. Either: 
                //    a) Scheduled within the next 12 hours, OR
                //    b) Already started but less than 1 hour past (grace period)
                $isWithin12Hours = $hoursPast <= 12;
                $isWithinGracePeriod = $hoursPast <= 0 && abs($hoursPast) <= 1; // Less than 1 hour past
                
                return !($session->completed ?? false) && ($isWithin12Hours || $isWithinGracePeriod);
            });
            
            // Separate completed/past interviews for display below
            $pastInterviews = $sessions->filter(function($session) use ($now) {
                $scheduledTime = \Carbon\Carbon::parse($session->scheduled_at);
                $hoursPast = $now->diffInHours($scheduledTime, false);
                $gracePeriod = $hoursPast < 0 && abs($hoursPast) > 1; // More than 1 hour past
                
                return ($session->completed ?? false) || $gracePeriod;
            });
        @endphp

        {{-- UPCOMING / ACTIVE INTERVIEWS SECTION --}}
        @if($filteredSessions->isNotEmpty())
            <div class="mb-8">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-1 h-6 bg-green-500 rounded-full"></div>
                    <h2 class="text-lg font-semibold text-gray-900">Active & Upcoming Interviews</h2>
                    <span class="text-xs text-gray-400">(Next 12 hours)</span>
                </div>
                
                <div class="space-y-4">
                    @foreach($filteredSessions as $session)
                        @php
                            $scheduledTime = \Carbon\Carbon::parse($session->scheduled_at);
                            $isAvailable = $now->gte($scheduledTime);
                            $isPastGrace = $now->diffInHours($scheduledTime, false) < 0 && abs($now->diffInHours($scheduledTime, false)) <= 1;
                            $isToday = $scheduledTime->isToday();
                            $isTomorrow = $scheduledTime->isTomorrow();
                            $hoursUntil = $now->diffInHours($scheduledTime, false);
                            $minutesUntil = $now->diffInMinutes($scheduledTime, false);
                            $isWithinHour = $hoursUntil <= 1 && $hoursUntil > 0;
                            $isWithin12Hours = $hoursUntil <= 12 && $hoursUntil > 0;
                            
                            $dayLabel = $isToday ? 'Today' : ($isTomorrow ? 'Tomorrow' : $scheduledTime->format('l, M d'));
                            
                            // Determine if interview is too late to join (past by more than 1 hour)
                            $isExpired = $isAvailable && abs($now->diffInMinutes($scheduledTime)) > 60;
                        @endphp
                        
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-200 overflow-hidden">
                            <div class="p-5">
                                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                    {{-- Left Section --}}
                                    <div class="flex items-start gap-4 flex-1">
                                        {{-- Date/Time Badge --}}
                                        <div class="hidden sm:block w-20 text-center">
                                            <div class="text-2xl font-bold {{ $isAvailable && !$isExpired ? 'text-green-600' : 'text-indigo-600' }}">
                                                {{ $scheduledTime->format('d') }}
                                            </div>
                                            <div class="text-xs text-gray-500 uppercase">{{ $scheduledTime->format('M') }}</div>
                                            <div class="text-xs font-medium text-gray-700 mt-1">{{ $scheduledTime->format('g:i A') }}</div>
                                        </div>

                                        {{-- Interview Details --}}
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1 flex-wrap">
                                                <h3 class="font-semibold text-gray-900">
                                                    Interview Session
                                                </h3>
                                                @if($isAvailable && !$isExpired)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                        Ready Now
                                                    </span>
                                                @elseif($isWithinHour)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-700 animate-pulse">
                                                        Starting Soon
                                                    </span>
                                                @elseif($isToday)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                                        Today
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 mt-1">
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ $scheduledTime->format('l, F j, Y') }}
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ $scheduledTime->format('g:i A') }}
                                                    @if(!$isAvailable && $isWithin12Hours)
                                                        <span class="text-gray-400">(in {{ $scheduledTime->diffForHumans() }})</span>
                                                    @endif
                                                </span>
                                            </div>

                                            {{-- Expired Interview Message --}}
                                            @if($isExpired)
                                                <div class="mt-3 p-3 bg-red-50 rounded-lg border border-red-200">
                                                    <div class="flex items-start gap-2 text-sm">
                                                        <svg class="w-4 h-4 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <div>
                                                            <span class="text-red-800 font-medium">Interview window has closed</span>
                                                            <p class="text-red-700 text-xs mt-1">
                                                                This interview started at {{ $scheduledTime->format('g:i A') }} and is no longer available to join.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Preparation Reminder for interviews within 12 hours but not started --}}
                                            @if(!$isAvailable && $isWithin12Hours && !$isWithinHour && !$isExpired)
                                                <div class="mt-3 p-3 bg-blue-50 rounded-lg border border-blue-100">
                                                    <div class="flex items-start gap-2 text-sm">
                                                        <svg class="w-4 h-4 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <div>
                                                            <span class="text-blue-800 font-medium">Get ready for your interview!</span>
                                                            <p class="text-blue-700 text-xs mt-1">
                                                                Your interview is in {{ $hoursUntil }} hours. Make sure your camera, microphone, and internet connection are working properly.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Urgent reminder for within 1 hour --}}
                                            @if(!$isAvailable && $isWithinHour && $minutesUntil > 0 && !$isExpired)
                                                <div class="mt-3 p-3 bg-orange-50 rounded-lg border border-orange-200">
                                                    <div class="flex items-start gap-2 text-sm">
                                                        <svg class="w-4 h-4 text-orange-500 mt-0.5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <div>
                                                            <span class="text-orange-800 font-medium">Interview starting soon!</span>
                                                            <p class="text-orange-700 text-xs mt-1">
                                                                Your interview begins in {{ $minutesUntil }} minutes. Please be ready and join at {{ $scheduledTime->format('g:i A') }} sharp.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Right Section - Action Button --}}
                                    <div class="flex-shrink-0">
                                        @if($isAvailable && !$isExpired && !($session->completed ?? false))
                                            <a href="{{ route('interviews.call', $session->id) }}"
                                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-sm group">
                                                <svg class="w-4 h-4 group-hover:scale-105 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                </svg>
                                                Join Interview
                                            </a>
                                        @elseif($isExpired)
                                            <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-100 text-red-600 text-sm font-medium rounded-xl">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Interview Ended
                                            </div>
                                        @else
                                            <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-600 text-sm font-medium rounded-xl">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $scheduledTime->format('g:i A') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Preparation Checklist for upcoming interviews --}}
                                @if(!$isAvailable && $isWithin12Hours && !($session->completed ?? false) && !$isExpired)
                                    <div class="mt-4 pt-4 border-t border-gray-100">
                                        <div class="flex flex-wrap items-center gap-4 text-xs">
                                            <span class="text-gray-500 font-medium">Preparation Checklist:</span>
                                            <label class="flex items-center gap-1.5 text-gray-600">
                                                <input type="checkbox" class="rounded border-gray-300 text-green-500 focus:ring-green-500">
                                                <span>Test Camera</span>
                                            </label>
                                            <label class="flex items-center gap-1.5 text-gray-600">
                                                <input type="checkbox" class="rounded border-gray-300 text-green-500 focus:ring-green-500">
                                                <span>Test Microphone</span>
                                            </label>
                                            <label class="flex items-center gap-1.5 text-gray-600">
                                                <input type="checkbox" class="rounded border-gray-300 text-green-500 focus:ring-green-500">
                                                <span>Stable Internet</span>
                                            </label>
                                            <label class="flex items-center gap-1.5 text-gray-600">
                                                <input type="checkbox" class="rounded border-gray-300 text-green-500 focus:ring-green-500">
                                                <span>Quiet Environment</span>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- EMPTY STATE --}}
        @if($filteredSessions->isEmpty() && $pastInterviews->isEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="max-w-md mx-auto py-12 px-4 text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">No interviews scheduled</h3>
                    <p class="text-gray-500 text-sm mb-6">When employers schedule interviews with you, they'll appear here.</p>
                    <a href="{{ route('jobseeker.jobs.index') }}" 
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Browse Jobs
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient-to-br {
        background-size: cover;
    }
    
    @keyframes pulse {
        0%, 100% { 
            opacity: 1;
            transform: scale(1);
        }
        50% { 
            opacity: 0.7;
            transform: scale(1.05);
        }
    }
    
    .animate-pulse {
        animation: pulse 1.5s ease-in-out infinite;
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .space-y-4 > div,
    .space-y-3 > div {
        animation: slideIn 0.3s ease-out forwards;
    }
    
    input[type="checkbox"] {
        width: 14px;
        height: 14px;
        cursor: pointer;
    }
    
    input[type="checkbox"]:checked {
        background-color: #10b981;
        border-color: #10b981;
    }
</style>
@endpush