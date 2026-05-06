@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    @php
        use Carbon\Carbon;

        $experience = $profile->experience ?? [];
        $education = $profile->education ?? [];
        $skills = $profile->skills ?? [];
        $certifications = $profile->certifications ?? [];
        $interests = $profile->interests ?? [];

        $formatDate = function ($date) {
            if (empty($date)) return null;
            try {
                return Carbon::parse($date)->format('M Y');
            } catch (\Exception $e) {
                return $date;
            }
        };
    @endphp

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Main Card --}}
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

                {{-- Cover Image with Gradient --}}
                <div class="relative h-40 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500">
                    {{-- Optional: Add a pattern overlay --}}
                    <div class="absolute inset-0 bg-black opacity-10"></div>
                </div>

                {{-- Content Container --}}
                <div class="px-6 pb-8">

                    {{-- Header Section with Avatar --}}
                    <div class="relative flex flex-col md:flex-row md:items-end justify-between -mt-12 mb-6">
                        {{-- Left: Avatar & Basic Info --}}
                        <div class="flex flex-col md:flex-row items-center md:items-end gap-5">
                            {{-- Avatar --}}
                            <div class="relative">
                                <div class="w-28 h-28 rounded-full border-4 border-white bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-3xl font-bold text-white shadow-lg">
                                    {{ strtoupper(substr($profile->user->name, 0, 1)) }}
                                </div>
                                <a href="{{ route('jobseeker.profile.edit') }}"
                                   class="absolute bottom-0 right-0 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center text-gray-600 hover:text-indigo-600 hover:shadow-lg transition-all duration-200 border border-gray-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            </div>

                            {{-- Name and Headline --}}
                            <div class="text-center md:text-left">
                                <h1 class="text-2xl font-bold text-gray-900">{{ $profile->user->name }}</h1>
                                <p class="text-gray-500 mt-1">{{ $profile->headline ?? 'Professional Profile' }}</p>
                                <div class="flex flex-wrap items-center gap-3 mt-2 text-sm text-gray-500">
                                    @if($profile->location)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $profile->location }}
                                        </span>
                                    @endif
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        {{ $profile->user->email }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Right: Resume Download --}}
                        @if($profile->resume_path)
                            <div class="mt-4 md:mt-0">
                                <a href="{{ Storage::url($profile->resume_path) }}" target="_blank"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-xl hover:bg-indigo-100 transition-colors duration-200 font-medium text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download Resume
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- Bio Section --}}
                    @if($profile->bio)
                        <div class="mb-8 p-4 bg-gray-50 rounded-xl">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $profile->bio }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Contact Info Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        @if($profile->phone)
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Phone</p>
                                    <p class="text-sm text-gray-700">{{ $profile->phone }}</p>
                                </div>
                            </div>
                        @endif

                        @if($profile->website)
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.66 0 3-4 3-9s-1.34-9-3-9m0 18c-1.66 0-3-4-3-9s1.34-9 3-9" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Website</p>
                                    <a href="{{ $profile->website }}" target="_blank" class="text-sm text-indigo-600 hover:underline truncate block max-w-[180px]">
                                        {{ Str::limit($profile->website, 30) }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if($profile->user->created_at)
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Member Since</p>
                                    <p class="text-sm text-gray-700">{{ $profile->user->created_at->format('F Y') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Skills Section --}}
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Core Skills
                            </h2>
                            @if(count($skills) > 0)
                                <span class="text-xs text-gray-400">{{ count($skills) }} skills</span>
                            @endif
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @forelse($skills as $skill)
                                <span class="px-3 py-1.5 bg-gradient-to-r from-indigo-50 to-purple-50 text-indigo-700 text-sm rounded-full font-medium border border-indigo-100">
                                    {{ $skill }}
                                </span>
                            @empty
                                <div class="flex items-center gap-2 text-gray-400 text-sm py-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    No skills added yet
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Experience & Education Grid --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                        {{-- Experience Column --}}
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Work Experience
                                </h2>
                            </div>
                            <div class="space-y-4">
                                @forelse($experience as $exp)
                                    <div class="p-4 bg-gray-50 rounded-xl hover:shadow-sm transition-shadow duration-200">
                                        <div class="flex justify-between items-start mb-1">
                                            <h3 class="font-semibold text-gray-800">{{ $exp['title'] ?? 'Position' }}</h3>
                                            <span class="text-xs text-gray-400 bg-white px-2 py-0.5 rounded-full">
                                                {{ $formatDate($exp['start_date'] ?? null) ?? 'Start' }} - {{ $formatDate($exp['end_date'] ?? null) ?? 'Present' }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-2">{{ $exp['company'] ?? 'Company' }}</p>
                                        @if(!empty($exp['description']))
                                            <p class="text-xs text-gray-500 leading-relaxed mt-2">{{ $exp['description'] }}</p>
                                        @endif
                                    </div>
                                @empty
                                    <div class="p-4 bg-gray-50 rounded-xl text-center text-gray-400 text-sm">
                                        <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        No work experience added
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Education Column --}}
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                    </svg>
                                    Education
                                </h2>
                            </div>
                            <div class="space-y-4">
                                @forelse($education as $edu)
                                    <div class="p-4 bg-gray-50 rounded-xl hover:shadow-sm transition-shadow duration-200">
                                        <div class="flex justify-between items-start mb-1">
                                            <h3 class="font-semibold text-gray-800">{{ $edu['degree'] ?? 'Degree' }}</h3>
                                            <span class="text-xs text-gray-400 bg-white px-2 py-0.5 rounded-full">
                                                {{ $formatDate($edu['start_date'] ?? null) ?? 'Start' }} - {{ $formatDate($edu['end_date'] ?? null) ?? 'Present' }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600">{{ $edu['institution'] ?? 'Institution' }}</p>
                                        @if(!empty($edu['field_of_study']))
                                            <p class="text-xs text-gray-500 mt-1">Field: {{ $edu['field_of_study'] }}</p>
                                        @endif
                                    </div>
                                @empty
                                    <div class="p-4 bg-gray-50 rounded-xl text-center text-gray-400 text-sm">
                                        <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                        </svg>
                                        No education added
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- Certifications & Interests Section --}}
                    @if(count($certifications) > 0 || count($interests) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                            @if(count($certifications) > 0)
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2 mb-4">
                                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        Certifications
                                    </h2>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($certifications as $cert)
                                            <span class="px-3 py-1.5 bg-orange-50 text-orange-700 text-sm rounded-full font-medium border border-orange-100">
                                                {{ $cert }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if(count($interests) > 0)
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2 mb-4">
                                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                        Professional Interests
                                    </h2>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($interests as $interest)
                                            <span class="px-3 py-1.5 bg-pink-50 text-pink-700 text-sm rounded-full font-medium border border-pink-100">
                                                {{ $interest }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection