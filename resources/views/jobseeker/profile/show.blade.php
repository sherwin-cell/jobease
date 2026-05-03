@extends('layouts.app')

@section('content')

    @php
        use Carbon\Carbon;

        $experience = $profile->experience ?? [];
        $education = $profile->education ?? [];
        $skills = $profile->skills ?? [];
        $certifications = $profile->certifications ?? [];
        $interests = $profile->interests ?? [];

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

        <div class="max-w-4xl mx-auto px-4">

            {{-- MAIN CARD --}}
            <div class="bg-white rounded-3xl shadow overflow-hidden">

                {{-- COVER --}}
                <div class="h-36 bg-gradient-to-r from-purple-600 to-blue-600"></div>

                <div class="p-6">

                    {{-- HEADER ROW --}}
                    <div class="flex flex-col md:flex-row gap-6">

                        {{-- LEFT SIDE (Avatar + Info) --}}
                        <div class="flex gap-4 md:w-1/2">
                            {{-- AVATAR --}}
                            <div class="-mt-14">
                                <div class="relative w-20 h-20 overflow-visible">

                                    {{-- PROFILE CIRCLE --}}
                                    <div
                                        class="w-full h-full rounded-full border-4 border-white bg-gradient-to-r from-purple-500 to-blue-500 flex items-center justify-center text-2xl font-bold text-white shadow-lg">
                                        {{ strtoupper(substr($profile->user->name, 0, 1)) }}
                                    </div>

                                    {{-- PENCIL EDIT BUTTON --}}
                                    <a href="{{ route('jobseeker.profile.edit') }}"
                                        class="absolute -bottom-1 -right-1 w-7 h-7 bg-gray-900 text-white rounded-full border-2 border-white shadow-md flex items-center justify-center hover:bg-purple-600 transition-all duration-200 z-20">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                        m-1.414-9.414a2 2 0 112.828 2.828L11 15l-4 1 1-4
                        7.586-7.586z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            {{-- INFO --}}
                            <div class="flex-1 space-y-2">
                                <h1 class="text-xl font-bold text-gray-900">{{ $profile->user->name }}</h1>

                                <div class="text-sm">
                                    <span class="font-medium text-gray-500">Headline:</span>
                                    {{ $profile->headline ?? 'Job Seeker' }}
                                </div>

                                <div class="text-sm">
                                    <span class="font-medium text-gray-500">Location:</span>
                                    {{ $profile->location ?? 'No location' }}
                                </div>

                                <div class="text-sm">
                                    <span class="font-medium text-gray-500">Email:</span>
                                    {{ $profile->user->email }}
                                </div>

                                @if($profile->phone)
                                    <div class="text-sm">
                                        <span class="font-medium text-gray-500">Phone:</span>
                                        {{ $profile->phone }}
                                    </div>
                                @endif

                                @if($profile->website)
                                    <div class="text-sm">
                                        <span class="font-medium text-gray-500">Website:</span>
                                        <a href="{{ $profile->website }}" target="_blank" class="text-blue-600 hover:underline">
                                            {{ Str::limit($profile->website, 30) }}
                                        </a>
                                    </div>
                                @endif

                                <div class="text-sm">
                                    <span class="font-medium text-gray-500">Bio:</span>
                                    {{ $profile->bio ?: 'No biography added yet.' }}
                                </div>
                            </div>
                        </div>

                        {{-- RIGHT SIDE (Stats) --}}
                        <div class="md:w-1/2">
                            @if($profile->resume_path)
                                <div class="bg-green-50 rounded-lg p-3 mb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="text-lg">📄</span>
                                        <div>
                                            <p class="text-sm font-medium text-green-800">Resume/CV</p>
                                            <a href="{{ Storage::url($profile->resume_path) }}" target="_blank"
                                                class="text-xs text-green-600 hover:underline">
                                                View Resume →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if(count($certifications) > 0)
                                <div class="bg-blue-50 rounded-lg p-3">
                                    <p class="text-sm font-medium text-blue-800 mb-2">📜 Certifications</p>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($certifications as $cert)
                                            <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">
                                                {{ $cert }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- SKILLS SECTION --}}
                    <div class="mt-6">
                        <h2 class="text-md font-semibold mb-3 text-gray-800 border-b pb-2">Skills</h2>
                        <div class="flex flex-wrap gap-2">
                            @forelse($skills as $skill)
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 text-sm rounded-full">
                                    {{ $skill }}
                                </span>
                            @empty
                                <p class="text-sm text-gray-400">No skills added</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- TWO COLUMN LAYOUT FOR EXPERIENCE & EDUCATION --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        {{-- EXPERIENCE --}}
                        <div>
                            <h2 class="text-md font-semibold mb-3 text-gray-800 border-b pb-2">💼 Experience</h2>
                            @forelse($experience as $exp)
                                <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                    <h3 class="font-semibold text-gray-800">{{ $exp['title'] ?? 'No title' }}</h3>
                                    <p class="text-sm text-gray-600">{{ $exp['company'] ?? 'No company' }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $formatDate($exp['start_date'] ?? null) ?? 'Start date' }} -
                                        {{ $formatDate($exp['end_date'] ?? null) ?? 'Present' }}
                                    </p>
                                    @if(!empty($exp['description']))
                                        <p class="text-xs text-gray-600 mt-2">{{ $exp['description'] }}</p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-sm text-gray-400">No experience added</p>
                            @endforelse
                        </div>

                        {{-- EDUCATION --}}
                        <div>
                            <h2 class="text-md font-semibold mb-3 text-gray-800 border-b pb-2">🎓 Education</h2>
                            @forelse($education as $edu)
                                <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                    <h3 class="font-semibold text-gray-800">{{ $edu['degree'] ?? 'No degree' }}</h3>
                                    <p class="text-sm text-gray-600">{{ $edu['institution'] ?? 'No institution' }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $formatDate($edu['start_date'] ?? null) ?? 'Start date' }} -
                                        {{ $formatDate($edu['end_date'] ?? null) ?? 'Present' }}
                                    </p>
                                    @if(!empty($edu['field_of_study']))
                                        <p class="text-xs text-gray-600 mt-1">Field: {{ $edu['field_of_study'] }}</p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-sm text-gray-400">No education added</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- INTERESTS SECTION --}}
                    @if(count($interests) > 0)
                        <div class="mt-6">
                            <h2 class="text-md font-semibold mb-3 text-gray-800 border-b pb-2">⭐ Professional Interests</h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($interests as $interest)
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded-full">
                                        {{ $interest }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection