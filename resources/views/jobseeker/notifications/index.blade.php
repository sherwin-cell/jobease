{{-- resources/views/jobseeker/notifications/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Notifications</h1>

    @forelse(auth()->user()->notifications as $notification)
        <div class="border p-3 mb-2 rounded {{ $notification->read_at ? 'bg-gray-100' : 'bg-green-100' }}">
            {{ $notification->data['message'] }}
            <span class="text-sm text-gray-500 block">
                Job ID: {{ $notification->data['job_id'] }}
            </span>

            <!-- Mark as Read button -->
            @if(!$notification->read_at)
                <form method="POST" action="{{ route('job_seeker.notifications.read', $notification->id) }}">
                    @csrf
                    <button class="text-blue-600 text-sm mt-1">Mark as Read</button>
                </form>
            @endif
        </div>
    @empty
        <p>No notifications yet.</p>
    @endforelse
</div>
@endsection