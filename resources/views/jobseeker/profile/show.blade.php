{{-- resources/views/jobseeker/profile/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">{{ $profile->headline ?? 'No Headline' }}</h1>

    {{-- Bio --}}
    <div class="mb-4">
        <h3 class="font-semibold mb-1">Bio</h3>
        <p class="border p-2 rounded">{{ $profile->bio ?? 'No bio available.' }}</p>
    </div>

    {{-- General Info --}}
    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <h3 class="font-semibold mb-1">Location</h3>
            <p class="border p-2 rounded">{{ $profile->location ?? '-' }}</p>
        </div>
        <div>
            <h3 class="font-semibold mb-1">Phone</h3>
            <p class="border p-2 rounded">{{ $profile->phone ?? '-' }}</p>
        </div>
        <div class="col-span-2">
            <h3 class="font-semibold mb-1">Website</h3>
            @if($profile->website)
                <a href="{{ $profile->website }}" class="text-blue-600 underline" target="_blank">{{ $profile->website }}</a>
            @else
                <p class="border p-2 rounded">-</p>
            @endif
        </div>
    </div>

    {{-- Skills --}}
    <div class="mb-4">
        <h3 class="font-semibold mb-2">Skills</h3>
        @if(!empty($profile->skills))
            <ul class="list-disc list-inside border p-2 rounded">
                @foreach($profile->skills as $skill)
                    <li>{{ $skill }}</li>
                @endforeach
            </ul>
        @else
            <p class="border p-2 rounded">No skills listed.</p>
        @endif
    </div>

    {{-- Experiences --}}
    <div class="mb-4">
        <h3 class="font-semibold mb-2">Experiences</h3>
        @if(!empty($profile->experience))
            @foreach($profile->experience as $exp)
                <div class="border p-2 rounded mb-2">
                    <h4 class="font-semibold">{{ $exp['title'] ?? '-' }} at {{ $exp['company'] ?? '-' }}</h4>
                    <p class="text-sm text-gray-600">
                        {{ $exp['start_date'] ?? 'N/A' }} - {{ $exp['end_date'] ?? 'Present' }}
                    </p>
                    <p>{{ $exp['description'] ?? '' }}</p>
                </div>
            @endforeach
        @else
            <p class="border p-2 rounded">No experiences listed.</p>
        @endif
    </div>

    {{-- Education --}}
    <div class="mb-4">
        <h3 class="font-semibold mb-2">Education</h3>
        @if(!empty($profile->education))
            @foreach($profile->education as $edu)
                <div class="border p-2 rounded mb-2">
                    <h4 class="font-semibold">{{ $edu['degree'] ?? '-' }}</h4>
                    <p>{{ $edu['school'] ?? '-' }}</p>
                    <p class="text-sm text-gray-600">
                        {{ $edu['start_date'] ?? 'N/A' }} - {{ $edu['end_date'] ?? 'N/A' }}
                    </p>
                </div>
            @endforeach
        @else
            <p class="border p-2 rounded">No education listed.</p>
        @endif
    </div>

    {{-- Certifications --}}
    <div class="mb-4">
        <h3 class="font-semibold mb-2">Certifications</h3>
        @if(!empty($profile->certifications))
            <ul class="list-disc list-inside border p-2 rounded">
                @foreach($profile->certifications as $cert)
                    <li>{{ $cert }}</li>
                @endforeach
            </ul>
        @else
            <p class="border p-2 rounded">No certifications listed.</p>
        @endif
    </div>

    {{-- Interests --}}
    <div class="mb-4">
        <h3 class="font-semibold mb-2">Interests</h3>
        @if(!empty($profile->interests))
            <ul class="list-disc list-inside border p-2 rounded">
                @foreach($profile->interests as $interest)
                    <li>{{ $interest }}</li>
                @endforeach
            </ul>
        @else
            <p class="border p-2 rounded">No interests listed.</p>
        @endif
    </div>
</div>
@endsection