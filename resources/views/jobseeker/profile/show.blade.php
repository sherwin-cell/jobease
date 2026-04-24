@extends('layouts.app')

@section('content')

    @php
        use Carbon\Carbon;

        $experience = $profile->experience ?? [];
        $education = $profile->education ?? [];
        $skills = $profile->skills ?? [];

        $formatDate = function ($date) {
            if (empty($date))
                return null;
            try {
                return Carbon::parse($date)->format('M Y');
            } catch (\Exception $e) {
                return $date;
            }
        };
    @endphp

    <div class="min-h-screen bg-gray-50 py-10">

        <div class="max-w-3xl mx-auto px-4">

            {{-- MAIN CARD --}}
            <div class="bg-white rounded-3xl shadow overflow-hidden">

                {{-- COVER --}}
                <div class="h-36 bg-gradient-to-r from-yellow-300 via-orange-400 to-pink-500"></div>

                <div class="p-5">

                    {{-- HEADER ROW --}}
                    <div class="flex gap-4">

                        {{-- AVATAR --}}
                        <div class="-mt-14 relative">
                            <div
                                class="w-20 h-20 rounded-full border-4 border-white bg-gray-300 flex items-center justify-center text-lg font-bold text-white shadow">
                                {{ strtoupper(substr($profile->user->name, 0, 1)) }}
                            </div>

                            {{-- EDIT --}}
                            <a href="{{ route('jobseeker.profile.edit') }}"
                                class="absolute bottom-0 right-0 bg-gray-800 text-white p-1 rounded-full shadow hover:bg-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                                  m-1.414-9.414a2 2 0 112.828 2.828L11 15l-4 1 1-4
                                                  7.586-7.586z" />
                                </svg>
                            </a>
                        </div>

                        {{-- INFO --}}
                        <div class="flex-1">

                            {{-- NAME --}}
                            <h1 class="text-lg font-semibold text-gray-900">
                                {{ $profile->user->name }}
                            </h1>

                            {{-- HEADLINE --}}
                            <p class="text-xs text-gray-600">
                                <span class="font-medium text-gray-500">Headline:</span>
                                {{ $profile->headline ?? 'Job Seeker' }}
                            </p>

                            {{-- LOCATION --}}
                            <p class="text-xs text-gray-500">
                                <span class="font-medium">Location:</span>
                                {{ $profile->location ?? 'No location' }}
                            </p>

                            {{-- CONTACT --}}
                            <div class="text-xs text-gray-600 mt-2">
                                <span class="font-medium text-gray-500">Email:</span>
                                {{ $profile->user->email }}

                                @if($profile->phone)
                                    <span class="ml-2">
                                        <span class="font-medium text-gray-500">Phone:</span>
                                        {{ $profile->phone }}
                                    </span>
                                @endif
                            </div>

                            {{-- BIO --}}
                            <p class="text-xs text-gray-700 mt-2 leading-snug">
                                <span class="font-medium text-gray-500">Bio:</span>
                                {{ $profile->bio ?: 'No biography added yet.' }}
                            </p>

                            {{-- SKILLS --}}
                            <div class="mt-3">
                                <p class="text-[10px] font-semibold text-gray-500 mb-1">Skills:</p>

                                <div class="flex flex-wrap gap-1.5">
                                    @forelse($skills as $skill)
                                        <span class="px-2 py-0.5 bg-gray-100 text-gray-700 text-[10px] rounded-full">
                                            {{ $skill }}
                                        </span>
                                    @empty
                                        <span class="text-[10px] text-gray-400">No skills</span>
                                    @endforelse
                                </div>
                            </div>

                        </div>

                        {{-- EXPERIENCE --}}
                        <div class="mt-6">
                            <h2 class="text-sm font-semibold mb-3 text-gray-800 border-b pb-1">
                                Experience
                            </h2>

                            @forelse($experience as $exp)
                                <div class="mb-3 text-xs">
                                    <p class="font-medium text-gray-900">
                                        {{ $exp['title'] ?? '-' }}
                                        <span class="text-gray-500">• {{ $exp['company'] ?? '-' }}</span>
                                    </p>

                                    <p class="text-gray-500">
                                        {{ $formatDate($exp['start_date'] ?? null) ?? '-' }} -
                                        {{ $formatDate($exp['end_date'] ?? null) ?? 'Present' }}
                                    </p>
                                </div>
                            @empty
                                <p class="text-xs text-gray-400">No experience added</p>
                            @endforelse
                        </div>
                        {{-- EDUCATION --}}
                        {{-- EDUCATION --}}
                        <div class="mt-6">
                            <h2 class="text-sm font-semibold mb-3 text-gray-800 border-b pb-1">
                                Education
                            </h2>

                            @forelse($education as $edu)
                                <div class="mb-4 text-xs">

                                    {{-- DEGREE --}}
                                    <p class="font-medium text-gray-900">
                                        {{ $edu['degree'] ?? '-' }}
                                    </p>

                                    {{-- UNIVERSITY --}}
                                    <p class="text-gray-600">
                                        {{ $edu['institution'] ?? 'No university' }}
                                    </p>

                                    {{-- DATES --}}
                                    <p class="text-gray-500 mt-1">
                                        {{ $formatDate($edu['start_date'] ?? null) ?? '-' }} -
                                        {{ $formatDate($edu['end_date'] ?? null) ?? 'Present' }}
                                    </p>

                                </div>
                            @empty
                                <p class="text-xs text-gray-400">No education added</p>
                            @endforelse
                        </div>

                    </div>
                </div>

            </div>
        </div>

@endsection