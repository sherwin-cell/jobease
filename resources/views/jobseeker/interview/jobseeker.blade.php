@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold">My Interviews</h2>

@foreach($sessions as $session)
    <div class="border p-4 mt-3 rounded">
        <p><b>Time:</b> {{ $session->scheduled_at }}</p>

        @if(now()->gte(\Carbon\Carbon::parse($session->scheduled_at)))
            <a href="{{ route('interviews.call', $session->id) }}" class="bg-green-500 text-white px-3 py-1 rounded">
                Join Interview
            </a>
        @else
            <button disabled class="bg-gray-400 text-white px-3 py-1 rounded">
                Interview Not Started
            </button>
        @endif
    </div>
@endforeach

@endsection