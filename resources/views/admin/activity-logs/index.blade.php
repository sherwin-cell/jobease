@extends('layouts.app')

@section('title', 'Activity Logs - JobEase')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Activity Logs</h1>
                <p class="text-sm text-gray-500 mt-1">View all system activities and user actions</p>
            </div>

            <form action="{{ route('admin.activity-logs.cleanup') }}" method="POST"
                onsubmit="return confirm('⚠️ Warning: This will permanently delete orphaned activity logs. This action cannot be undone!')">
                @csrf
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Clean Up Orphaned Logs
                </button>
            </form>
        </div>

        <!-- Activity Logs Cards Grid - 3 columns for 6 cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($logs as $log)
                <div class="bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                    <div class="p-5 flex-1">
                        <!-- Header with action badge -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-2">
                                @if($log->action == 'CREATE')
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                @elseif($log->action == 'UPDATE')
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                @elseif($log->action == 'DELETE')
                                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                @elseif($log->action == 'LOGIN')
                                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                    </div>
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($log->action == 'CREATE') bg-green-100 text-green-800
                                        @elseif($log->action == 'UPDATE') bg-blue-100 text-blue-800
                                        @elseif($log->action == 'DELETE') bg-red-100 text-red-800
                                        @elseif($log->action == 'LOGIN') bg-purple-100 text-purple-800
                                        @elseif($log->action == 'LOGOUT') bg-gray-100 text-gray-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ $log->action }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="text-right flex-shrink-0">
                                <p class="text-xs text-gray-500">{{ $log->created_at ? $log->created_at->format('M d, Y') : 'N/A' }}</p>
                                <p class="text-xs text-gray-400">{{ $log->created_at ? $log->created_at->format('h:i A') : '' }}</p>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-700 line-clamp-3">
                                {{ $log->description }}
                            </p>
                        </div>
                        
                        <!-- User Info -->
                        <div class="border-t border-gray-100 pt-4 mb-3">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                @if ($log->user)
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $log->user->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ $log->user->email }}</p>
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500">System / Deleted User</p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Footer with IP and User Agent -->
                        <div class="border-t border-gray-100 pt-3">
                            <div class="flex items-start gap-2 text-xs text-gray-500">
                                <svg class="w-3 h-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="truncate">{{ $log->ip_address ?? 'N/A' }}</span>
                            </div>
                            @if($log->user_agent)
                                <div class="flex items-start gap-2 mt-1 text-xs text-gray-400">
                                    <svg class="w-3 h-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 7h14M5 10h14M5 13h14M5 16h14M5 19h14" />
                                    </svg>
                                    <span class="truncate">{{ Str::limit($log->user_agent, 50) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3">
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-12 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-gray-500 font-medium">No activity logs found</p>
                            <p class="text-sm text-gray-400">Activities will appear here as users interact with the system</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination with Icons -->
        <div class="flex justify-center items-center gap-3 mt-8">
            <!-- First Page -->
            @if ($logs->onFirstPage())
                <span class="p-2 text-gray-300 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                    </svg>
                </span>
            @else
                <a href="{{ $logs->url(1) }}" class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                    </svg>
                </a>
            @endif

            <!-- Previous Page -->
            @if ($logs->onFirstPage())
                <span class="p-2 text-gray-300 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </span>
            @else
                <a href="{{ $logs->previousPageUrl() }}" class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            @endif

            <!-- Page Numbers -->
            <div class="flex gap-1">
                @php
                    $currentPage = $logs->currentPage();
                    $lastPage = $logs->lastPage();
                    $start = max(1, $currentPage - 2);
                    $end = min($lastPage, $currentPage + 2);
                @endphp

                @if($start > 1)
                    <a href="{{ $logs->url(1) }}" class="px-3 py-1 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">1</a>
                    @if($start > 2)
                        <span class="px-2 py-1 text-gray-400">...</span>
                    @endif
                @endif

                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $logs->currentPage())
                        <span class="px-3 py-1 text-white bg-blue-500 rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $logs->url($page) }}" class="px-3 py-1 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">
                            {{ $page }}
                        </a>
                    @endif
                @endfor

                @if($end < $lastPage)
                    @if($end < $lastPage - 1)
                        <span class="px-2 py-1 text-gray-400">...</span>
                    @endif
                    <a href="{{ $logs->url($lastPage) }}" class="px-3 py-1 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">{{ $lastPage }}</a>
                @endif
            </div>

            <!-- Next Page -->
            @if ($logs->hasMorePages())
                <a href="{{ $logs->nextPageUrl() }}" class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @else
                <span class="p-2 text-gray-300 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif

            <!-- Last Page -->
            @if ($logs->hasMorePages())
                <a href="{{ $logs->url($logs->lastPage()) }}" class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                </a>
            @else
                <span class="p-2 text-gray-300 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                </span>
            @endif
        </div>
        
        <!-- Results info -->
        <div class="text-center text-sm text-gray-500">
            Showing {{ $logs->firstItem() ?? 0 }} to {{ $logs->lastItem() ?? 0 }} of {{ $logs->total() }} results
        </div>
    </div>
@endsection