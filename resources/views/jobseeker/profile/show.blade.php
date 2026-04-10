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

            {{-- Bio --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Bio</div>
                <p class="mt-2 text-sm text-gray-700 whitespace-pre-line">
                    {{ $profile->bio ?? 'No bio available.' }}
                </p>
            </div>

            {{-- Experience --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Experience</div>
                <div class="mt-3 space-y-4">
                    @forelse($experiences as $exp)
                        <div class="rounded-xl border border-gray-200 p-4">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $exp['title'] ?? '-' }}</div>
                                    <div class="text-sm text-gray-600 mt-0.5">{{ $exp['company'] ?? '-' }}</div>
                                </div>
                                @if(!empty($exp['current_job']))
                                    <span class="shrink-0 inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">
                                        Current
                                    </span>
                                @endif
                            </div>
                            <div class="mt-2 text-xs text-gray-500">
                                @php
                                    $startFmt = !empty($exp['start_date']) ? \Carbon\Carbon::parse($exp['start_date'])->format('M Y') : 'N/A';
                                    $endFmt   = (!empty($exp['current_job']) || empty($exp['end_date']))
                                                ? 'Present'
                                                : \Carbon\Carbon::parse($exp['end_date'])->format('M Y');
                                @endphp
                                {{ $startFmt }} – {{ $endFmt }}
                            </div>
                            @if(!empty($exp['description']))
                                <p class="mt-2 text-sm text-gray-700 whitespace-pre-line">{{ $exp['description'] }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No experience listed.</p>
                    @endforelse
                </div>
            </div>

            {{-- Education --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Education</div>
                <div class="mt-3 space-y-4">
                    @forelse($educations as $edu)
                        <div class="rounded-xl border border-gray-200 p-4">
                            <div class="font-semibold text-gray-900">{{ $edu['degree'] ?? '-' }}</div>
                            @php
                                $school = $edu['school'] ?? ($edu['institution'] ?? '-');
                            @endphp
                            <div class="text-sm text-gray-700 mt-0.5">{{ $school }}</div>
                            @if(!empty($edu['field_of_study']))
                                <div class="text-sm text-gray-500 mt-0.5">{{ $edu['field_of_study'] }}</div>
                            @endif
                            <div class="mt-2 text-xs text-gray-500">
                                @php
                                    $startFmt = !empty($edu['start_date']) ? \Carbon\Carbon::parse($edu['start_date'])->format('M Y') : 'N/A';
                                    $endFmt   = !empty($edu['end_date'])   ? \Carbon\Carbon::parse($edu['end_date'])->format('M Y')   : 'Present';
                                @endphp
                                {{ $startFmt }} – {{ $endFmt }}
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No education listed.</p>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="space-y-6">

            {{-- General Info --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">General Info</div>
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
                                <a href="{{ $profile->website }}" class="text-blue-600 hover:underline break-all" target="_blank" rel="noreferrer">
                                    {{ $profile->website }}
                                </a>
                            @else
                                -
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>

            {{-- Skills --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Skills</div>
                <div class="mt-3 flex flex-wrap gap-2">
                    @forelse($profile->skills ?? [] as $skill)
                        <span class="inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1 text-sm text-gray-700">
                            {{ $skill }}
                        </span>
                    @empty
                        <span class="text-sm text-gray-500">No skills listed.</span>
                    @endforelse
                </div>
            </div>

            {{-- Certifications --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Certifications</div>
                <div class="mt-3 space-y-3">
                    @php $certs = $profile->certifications ?? []; @endphp
                    @forelse($certs as $cert)
                        @php
                            $certName    = is_array($cert) ? ($cert['name'] ?? '-') : $cert;
                            $certOrg     = is_array($cert) ? ($cert['issuing_org'] ?? '') : '';
                            $certIssued  = is_array($cert) && !empty($cert['issue_date'])
                                           ? \Carbon\Carbon::parse($cert['issue_date'])->format('M Y') : null;
                            $certExpires = is_array($cert) && !empty($cert['expiration_date'])
                                           ? \Carbon\Carbon::parse($cert['expiration_date'])->format('M Y') : null;
                        @endphp
                        <div class="rounded-xl border border-gray-200 px-4 py-3">
                            <div class="font-medium text-gray-900 text-sm">{{ $certName }}</div>
                            @if($certOrg)
                                <div class="text-xs text-gray-500 mt-0.5">{{ $certOrg }}</div>
                            @endif
                            @if($certIssued || $certExpires)
                                <div class="text-xs text-gray-400 mt-1">
                                    @if($certIssued) Issued: {{ $certIssued }} @endif
                                    @if($certIssued && $certExpires) · @endif
                                    @if($certExpires) Expires: {{ $certExpires }} @endif
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-sm text-gray-500">No certifications listed.</div>
                    @endforelse
                </div>
            </div>

            {{-- Interests --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Interests</div>
                <div class="mt-3 flex flex-wrap gap-2">
                    @forelse($profile->interests ?? [] as $interest)
                        <span class="inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1 text-sm text-gray-700">
                            {{ $interest }}
                        </span>
                    @empty
                        <span class="text-sm text-gray-500">No interests listed.</span>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection

