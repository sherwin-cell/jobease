{{-- resources/views/jobseeker/profile/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="flex items-start justify-between gap-6">
        <div class="min-w-0">
            <h1 class="truncate text-2xl font-bold text-gray-900">
                {{ $profile->headline ?? 'My Profile' }}
            </h1>
            <p class="mt-1 text-sm text-gray-500">Manage your information employers can see.</p>
        </div>
        <a href="{{ route('jobseeker.profile.create') }}"
            class="inline-flex shrink-0 items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
            Edit Profile
        </a>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Bio</div>
                <p class="mt-2 text-sm text-gray-700">
                    {{ $profile->bio ?? 'No bio available.' }}
                </p>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Experience</div>
                <div class="mt-3 space-y-3">
                    @if(!empty($profile->experience))
                        @foreach($profile->experience as $exp)
                            <div class="rounded-xl border border-gray-200 p-4">
                                <div class="font-semibold text-gray-900">
                                    {{ $exp['title'] ?? '-' }} <span class="text-gray-400">at</span>
                                    {{ $exp['company'] ?? '-' }}
                                </div>
                                <div class="mt-1 text-sm text-gray-600">
                                    {{ $exp['start_date'] ?? 'N/A' }} - {{ $exp['end_date'] ?? 'Present' }}
                                </div>
                                @if(!empty($exp['description']))
                                    <p class="mt-2 text-sm text-gray-700">{{ $exp['description'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-600">No experiences listed.</p>
                    @endif
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Education</div>
                <div class="mt-3 space-y-3">
                    @if(!empty($profile->education))
                        @foreach($profile->education as $edu)
                            <div class="rounded-xl border border-gray-200 p-4">
                                <div class="font-semibold text-gray-900">{{ $edu['degree'] ?? '-' }}</div>
                                <div class="mt-1 text-sm text-gray-700">{{ $edu['institution'] ?? '-' }}</div>
                                <div class="mt-1 text-sm text-gray-600">
                                    {{ $edu['start_date'] ?? 'N/A' }} - {{ $edu['end_date'] ?? 'N/A' }}
                                </div>
                                @if(!empty($edu['place']))
                                    <div class="mt-1 text-sm text-gray-500">{{ $edu['place'] }}</div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-600">No education listed.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">General info</div>
                <dl class="mt-3 space-y-3 text-sm">
                    <div class="flex items-start justify-between gap-4">
                        <dt class="text-gray-500">Location</dt>
                        <dd class="text-right font-semibold text-gray-900">{{ $profile->location ?? '-' }}</dd>
                    </div>
                    <div class="flex items-start justify-between gap-4">
                        <dt class="text-gray-500">Phone</dt>
                        <dd class="text-right font-semibold text-gray-900">{{ $profile->phone ?? '-' }}</dd>
                    </div>
                    <div class="flex items-start justify-between gap-4">
                        <dt class="text-gray-500">Website</dt>
                        <dd class="text-right font-semibold text-gray-900">
                            @if($profile->website)
                                <a href="{{ $profile->website }}" class="text-blue-700 hover:underline" target="_blank"
                                    rel="noreferrer">
                                    {{ $profile->website }}
                                </a>
                            @else
                                -
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Skills</div>
                <div class="mt-3 flex flex-wrap gap-2">
                    @if(!empty($profile->skills))
                        @foreach($profile->skills as $skill)
                            <span
                                class="inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1 text-sm text-gray-700">
                                {{ $skill }}
                            </span>
                        @endforeach
                    @else
                        <span class="text-sm text-gray-600">No skills listed.</span>
                    @endif
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Certifications</div>
                <div class="mt-3 space-y-2 text-sm text-gray-700">
                    @if(!empty($profile->certifications))
                        @foreach($profile->certifications as $cert)
                            <div class="rounded-xl border border-gray-200 px-3 py-2">{{ $cert }}</div>
                        @endforeach
                    @else
                        <div class="text-sm text-gray-600">No certifications listed.</div>
                    @endif
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Interests</div>
                <div class="mt-3 space-y-2 text-sm text-gray-700">
                    @if(!empty($profile->interests))
                        @foreach($profile->interests as $interest)
                            <div class="rounded-xl border border-gray-200 px-3 py-2">{{ $interest }}</div>
                        @endforeach
                    @else
                        <div class="text-sm text-gray-600">No interests listed.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

