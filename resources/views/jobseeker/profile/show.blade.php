@extends('layouts.app')


@section('content')

@php
    $experience = $profile->experience ?? [];
    $education = $profile->education ?? [];
    $skills = $profile->skills ?? [];
@endphp

<div class="w-full max-w-5xl mx-auto">
    <!-- Profile Card -->
    <div class="bg-white rounded-3xl shadow-xl p-10 flex flex-col md:flex-row md:items-center gap-8 mb-10 border border-gray-100">
        <div class="flex-shrink-0 flex flex-col items-center md:items-start w-full md:w-1/3">
            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-5xl font-bold text-white mb-4 border-4 border-white shadow-lg">
                {{ strtoupper(substr($profile->user->name, 0, 1)) }}
            </div>
            <div class="text-center md:text-left w-full">
                <h1 class="text-3xl font-extrabold text-gray-900 mb-1">{{ $profile->user->name }}</h1>
                <div class="text-lg text-gray-600 mb-2">{{ $profile->headline ?? 'Jobseeker' }}</div>
                <div class="flex flex-wrap gap-2 justify-center md:justify-start mb-2">
                    @foreach($skills as $skill)
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">{{ $skill }}</span>
                    @endforeach
                </div>
                <div class="text-sm text-gray-500">{{ $profile->location }}</div>
            </div>
        </div>
        <div class="flex-1 flex flex-col gap-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                <div class="text-gray-500 text-sm">{{ $profile->user->email }}</div>
                <a href="{{ route('jobseeker.profile.edit') }}" class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 shadow transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13h3l8-8a2.828 2.828 0 10-4-4l-8 8v3zm0 0v3a2 2 0 002 2h3" /></svg>
                    Edit Profile
                </a>
            </div>
            <div class="mt-2 text-gray-700 text-base whitespace-pre-line">{{ $profile->bio ?: 'No bio available.' }}</div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Experience -->
        <div class="bg-white rounded-2xl shadow p-7 border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6" /></svg>
                Experience
            </h2>
            <div class="space-y-5">
                @forelse($experience as $exp)
                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">
                        <div class="flex items-center justify-between">
                            <div class="font-semibold text-gray-900 text-base">{{ $exp['title'] ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $exp['start_date'] ?? '-' }} – {{ $exp['end_date'] ?? 'Present' }}</div>
                        </div>
                        <div class="text-sm text-gray-600 mb-1">{{ $exp['company'] ?? '-' }}</div>
                        @if(!empty($exp['description']))
                            <div class="text-gray-700 text-sm mt-2">{{ $exp['description'] }}</div>
                        @endif
                    </div>
                @empty
                    <div class="text-gray-400 italic">No experience listed.</div>
                @endforelse
            </div>
        </div>

        <!-- Education -->
        <div class="bg-white rounded-2xl shadow p-7 border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7v-7" /></svg>
                Education
            </h2>
            <div class="space-y-5">
                @forelse($education as $edu)
                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">
                        <div class="font-semibold text-gray-900 text-base">{{ $edu['degree'] ?? '-' }}</div>
                        <div class="text-sm text-gray-600 mb-1">{{ $edu['institution'] ?? '-' }}</div>
                        <div class="text-xs text-gray-500">{{ $edu['start_date'] ?? '-' }} – {{ $edu['end_date'] ?? '-' }}</div>
                    </div>
                @empty
                    <div class="text-gray-400 italic">No education listed.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Sidebar Info (Below on mobile) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
        <div class="md:col-start-3 space-y-8">
            <!-- General Info -->
            <div class="bg-white rounded-2xl shadow p-7 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    General Info
                </h2>
                <div class="space-y-2 text-sm">
                    <div><span class="text-gray-500">Location:</span> {{ $profile->location ?: '-' }}</div>
                    <div><span class="text-gray-500">Phone:</span> {{ $profile->phone ?: '-' }}</div>
                    <div><span class="text-gray-500">Website:</span> @if($profile->website)<a href="{{ $profile->website }}" target="_blank" class="text-blue-600 hover:underline">Visit</a>@else-@endif</div>
                </div>
            </div>
            <!-- Skills -->
            <div class="bg-white rounded-2xl shadow p-7 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 01-8 0M12 3v4m0 0a4 4 0 01-8 0m8 0a4 4 0 008 0m-8 0V3" /></svg>
                    Skills
                </h2>
                <div class="flex flex-wrap gap-2 mt-2">
                    @forelse($skills as $skill)
                        <span class="px-3 py-1 text-xs border rounded-full bg-indigo-50 text-indigo-700">{{ $skill }}</span>
                    @empty
                        <span class="text-gray-400 italic">No skills listed.</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection