@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">
    Schedule Interview for {{ $application->user->name }}
</h2>

<form method="POST" action="{{ route('employer.interviews.schedule', $application->id) }}">
    @csrf

    <label class="block mb-2">Interview Date & Time</label>

    <input type="datetime-local"
           name="scheduled_at"
           class="border p-2 w-full mb-4"
           required>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Schedule Interview
    </button>
</form>

@endsection