@extends('layouts.app')

@section('title', 'Live Skill Q&A Sessions')

@section('content')
    <div class="flex items-start justify-between gap-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Live Skill Q&amp;A</h1>
            <p class="mt-1 text-sm text-gray-500">Manage all scheduled Q&amp;A sessions across your job posts.</p>
        </div>
        <a href="{{ route('employer.jobs.create') }}"
            class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
            Create Job
        </a>
    </div>

    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-6">
        @if($jobs->isEmpty())
            <div class="text-gray-600">
                No Live Skill Q&amp;A sessions yet. Enable it on a job post first.
                <a class="text-blue-700 font-semibold hover:underline" href="{{ route('employer.jobs.index') }}">Go to My Jobs</a>.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-left text-sm text-gray-500 border-b">
                            <th class="py-3 pr-4">Job</th>
                            <th class="py-3 pr-4">Duration</th>
                            <th class="py-3 pr-4">Max candidates</th>
                            <th class="py-3 pr-4">Session type</th>
                            <th class="py-3 pr-4">Slots</th>
                            <th class="py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($jobs as $job)
                            <tr class="text-sm">
                                <td class="py-3 pr-4 font-semibold text-gray-900">
                                    {{ $job->title }}
                                </td>
                                <td class="py-3 pr-4 text-gray-700">
                                    {{ $job->liveSkillQa->duration_minutes ?? '—' }} min
                                </td>
                                <td class="py-3 pr-4 text-gray-700">
                                    {{ $job->liveSkillQa->max_candidates ?? '—' }}
                                </td>
                                <td class="py-3 pr-4 text-gray-700">
                                    @php
                                        $type = $job->liveSkillQa->session_type ?? null;
                                        $label = match ($type) {
                                            'video_audio' => 'Video + Audio',
                                            'audio_only' => 'Audio only',
                                            'screen_share' => 'Screen sharing allowed',
                                            default => '—',
                                        };
                                    @endphp
                                    {{ $label }}
                                </td>
                                <td class="py-3 pr-4 text-gray-700">
                                    {{ is_array($job->liveSkillQa->slots ?? null) ? count($job->liveSkillQa->slots) : 0 }}
                                </td>
                                <td class="py-3">
                                    <a href="{{ route('employer.live-skill-qa.show', $job) }}"
                                        class="text-blue-700 font-semibold hover:underline">
                                        View
                                    </a>
                                    <span class="text-gray-300 mx-2">|</span>
                                    <a href="{{ route('employer.jobs.edit', $job) }}"
                                        class="text-gray-700 font-semibold hover:underline">
                                        Edit settings
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

