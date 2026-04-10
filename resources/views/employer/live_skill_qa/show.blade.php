@extends('layouts.app')

@section('title', 'Live Skill Q&A - ' . $job->title)

@section('content')
    @php $qa = $job->liveSkillQa; @endphp

    <div class="flex items-start justify-between gap-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Live Skill Q&amp;A</h1>
            <p class="mt-1 text-sm text-gray-500">
                Job: <span class="font-semibold text-gray-900">{{ $job->title }}</span>
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('employer.jobs.edit', $job) }}"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
                Edit settings
            </a>
            <a href="{{ route('employer.live-skill-qa.index') }}"
                class="inline-flex items-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-gray-800 border border-gray-200 hover:bg-gray-50 transition">
                Back
            </a>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 lg:col-span-1">
            <h2 class="text-sm font-semibold text-gray-900">Session settings</h2>
            <dl class="mt-4 space-y-3 text-sm">
                <div class="flex items-center justify-between gap-4">
                    <dt class="text-gray-500">Enabled</dt>
                    <dd class="font-semibold text-gray-900">{{ ($qa->enabled ?? false) ? 'Yes' : 'No' }}</dd>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <dt class="text-gray-500">Duration</dt>
                    <dd class="font-semibold text-gray-900">{{ $qa->duration_minutes ?? '—' }} min</dd>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <dt class="text-gray-500">Max candidates</dt>
                    <dd class="font-semibold text-gray-900">{{ $qa->max_candidates ?? '—' }}</dd>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <dt class="text-gray-500">Session type</dt>
                    @php
                        $type = $qa->session_type ?? null;
                        $label = match ($type) {
                            'video_audio' => 'Video + Audio',
                            'audio_only' => 'Audio only',
                            'screen_share' => 'Screen sharing allowed',
                            default => '—',
                        };
                    @endphp
                    <dd class="font-semibold text-gray-900">{{ $label }}</dd>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <dt class="text-gray-500">Screen sharing</dt>
                    <dd class="font-semibold text-gray-900">{{ ($qa->screen_sharing_allowed ?? false) ? 'Allowed' : 'Not allowed' }}</dd>
                </div>
            </dl>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 lg:col-span-2">
            <h2 class="text-sm font-semibold text-gray-900">Scheduled slots</h2>
            <div class="mt-4 space-y-2 text-sm">
                @php $slots = is_array($qa->slots ?? null) ? $qa->slots : []; @endphp
                @if(empty($slots))
                    <div class="text-gray-600">No slots set yet. Add them in the job edit page.</div>
                @else
                    @foreach($slots as $i => $slot)
                        <div class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 flex items-center justify-between gap-4">
                            <div class="text-gray-900 font-semibold">
                                {{ \Illuminate\Support\Carbon::parse($slot['start_at'])->format('M j, Y g:i A') }}
                                <span class="text-gray-400 font-normal">→</span>
                                {{ \Illuminate\Support\Carbon::parse($slot['end_at'])->format('g:i A') }}
                            </div>
                            <form method="POST" action="{{ route('employer.live-skill-qa.start', $job) }}">
                                @csrf
                                <input type="hidden" name="slot_index" value="{{ $i }}">
                                <button type="submit"
                                    class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
                                    Start session
                                </button>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>

            <h2 class="text-sm font-semibold text-gray-900 mt-8">Questions</h2>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                    <div class="font-semibold text-gray-900 mb-2">Categories</div>
                    @php $cats = is_array($qa->question_categories ?? null) ? $qa->question_categories : []; @endphp
                    @if(empty($cats))
                        <div class="text-gray-600">None</div>
                    @else
                        <ul class="list-disc pl-5 space-y-1 text-gray-700">
                            @foreach($cats as $c)
                                <li>{{ $c }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                    <div class="font-semibold text-gray-900 mb-2">Specific questions</div>
                    @php $qs = is_array($qa->questions ?? null) ? $qa->questions : []; @endphp
                    @if(empty($qs))
                        <div class="text-gray-600">None</div>
                    @else
                        <ul class="list-disc pl-5 space-y-1 text-gray-700">
                            @foreach($qs as $q)
                                <li>{{ $q['question'] ?? '' }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

