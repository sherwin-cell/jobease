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
            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Clean Up Orphaned Logs
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="p-4 border-b border-gray-200 bg-gray-50">
            <h2 class="font-semibold text-gray-900">Activity Timeline</h2>
        </div>
        
        <div class="divide-y divide-gray-100">
            @forelse ($logs as $log)
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                @if($log->action == 'User Login')
                                    <span class="text-blue-600">🔐</span>
                                @elseif($log->action == 'User Registered' || $log->action == 'New Account Created')
                                    <span class="text-green-600">✨</span>
                                @elseif($log->action == 'User Banned')
                                    <span class="text-red-600">⚠️</span>
                                @else
                                    <span class="text-gray-400">📋</span>
                                @endif
                                <p class="text-sm font-medium text-gray-900">{{ $log->action }}</p>
                            </div>
                            @if($log->description)
                                <p class="text-sm text-gray-600 mt-1">{{ $log->description }}</p>
                            @endif
                            <div class="flex items-center gap-2 mt-2">
                                <p class="text-xs text-gray-400">
                                    By
                                    @if($log->user)
                                        <span class="font-medium text-gray-600">{{ $log->user->name }}</span>
                                        @if($log->user->isEmployer() && $log->user->employerProfile)
                                            <span class="text-gray-400">({{ $log->user->employerProfile->company_name }})</span>
                                        @endif
                                    @else
                                        <span class="text-red-400">Deleted User</span>
                                    @endif
                                </p>
                                <span class="text-gray-300">•</span>
                                <p class="text-xs text-gray-400">{{ $log->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-xs text-gray-400">{{ $log->created_at->format('M d, h:i A') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="text-5xl mb-3">📭</div>
                    <p class="text-gray-500 text-sm">No activity logs found</p>
                    <p class="text-xs text-gray-400 mt-1">Activities will appear here as users interact with the system</p>
                </div>
            @endforelse
        </div>
        
        @if(method_exists($logs, 'links'))
            <div class="p-4 border-t border-gray-200">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection