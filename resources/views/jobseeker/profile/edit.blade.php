@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8 px-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h1 class="text-lg font-semibold text-gray-900">
            {{ $profile->exists ? 'Edit Profile' : 'Create Profile' }}
        </h1>
        <p class="text-xs text-gray-500">
            Keep your profile updated.
        </p>
    </div>

    {{-- FORM --}}
    <form method="POST"
        action="{{ $profile->exists ? route('jobseeker.profile.update') : route('jobseeker.profile.store') }}"
        class="space-y-5">

        @csrf
        @if($profile->exists) @method('PUT') @endif

        {{-- BASIC INFO --}}
        <div class="space-y-2 text-sm">

            <input type="text" name="headline"
                value="{{ old('headline', $profile->headline ?? '') }}"
                placeholder="Headline"
                class="w-full border-b border-gray-300 focus:border-blue-500 focus:ring-0 py-1 text-sm outline-none">

            <textarea name="bio"
                placeholder="Bio"
                class="w-full border-b border-gray-300 focus:border-blue-500 focus:ring-0 py-1 text-sm resize-none outline-none h-16">{{ old('bio', $profile->bio ?? '') }}</textarea>

            <input type="text" name="location"
                value="{{ old('location', $profile->location ?? '') }}"
                placeholder="Location"
                class="w-full border-b border-gray-300 focus:border-blue-500 focus:ring-0 py-1 text-sm outline-none">

            <input type="text" name="phone"
                value="{{ old('phone', $profile->phone ?? '') }}"
                placeholder="Phone"
                class="w-full border-b border-gray-300 focus:border-blue-500 focus:ring-0 py-1 text-sm outline-none">

            <input type="text" name="website"
                value="{{ old('website', $profile->website ?? '') }}"
                placeholder="Website"
                class="w-full border-b border-gray-300 focus:border-blue-500 focus:ring-0 py-1 text-sm outline-none">

        </div>

        {{-- SKILLS --}}
        <div class="space-y-2 text-sm">

            <p class="text-xs text-gray-500">Skills</p>

            <div id="skills-list" class="space-y-1">
                @foreach(old('skills', $profile->skills ?? ['']) as $skill)
                    <div class="flex gap-2">
                        <input type="text" name="skills[]" value="{{ $skill }}"
                            class="flex-1 border-b border-gray-300 focus:border-blue-500 focus:ring-0 py-1 text-sm outline-none">
                        <button type="button" class="remove text-red-500 text-xs">✕</button>
                    </div>
                @endforeach
            </div>

            <button type="button" id="add-skill" class="text-blue-600 text-xs">
                + Add Skill
            </button>
        </div>

        {{-- EXPERIENCE --}}
        <div class="space-y-2 text-sm">

            <p class="text-xs text-gray-500">Experience</p>

            <div id="experience-list" class="space-y-3">
                @foreach(old('experience', $profile->experience ?? []) as $i => $exp)
                    <div class="space-y-1">

                        <input type="text" name="experience[{{ $i }}][title]"
                            value="{{ $exp['title'] ?? '' }}"
                            placeholder="Job Title"
                            class="w-full border-b border-gray-300 py-1 text-sm outline-none">

                        <input type="text" name="experience[{{ $i }}][company]"
                            value="{{ $exp['company'] ?? '' }}"
                            placeholder="Company"
                            class="w-full border-b border-gray-300 py-1 text-sm outline-none">

                        <div class="grid grid-cols-2 gap-2">
                            <input type="date" name="experience[{{ $i }}][start_date]"
                                value="{{ $exp['start_date'] ?? '' }}"
                                class="border-b border-gray-300 py-1 text-sm outline-none">

                            <input type="date" name="experience[{{ $i }}][end_date]"
                                value="{{ $exp['end_date'] ?? '' }}"
                                class="border-b border-gray-300 py-1 text-sm outline-none">
                        </div>

                        <textarea name="experience[{{ $i }}][description]"
                            placeholder="Description"
                            class="w-full border-b border-gray-300 py-1 text-sm resize-none outline-none">{{ $exp['description'] ?? '' }}</textarea>

                        <button type="button" class="remove-exp text-red-500 text-xs">
                            Remove
                        </button>
                    </div>
                @endforeach
            </div>

            <button type="button" id="add-exp" class="text-blue-600 text-xs">
                + Add Experience
            </button>
        </div>

        {{-- EDUCATION --}}
        <div class="space-y-2 text-sm">

            <p class="text-xs text-gray-500">Education</p>

            <div id="education-list" class="space-y-3">
                @foreach(old('education', $profile->education ?? []) as $i => $edu)
                    <div class="space-y-1">

                        <input type="text" name="education[{{ $i }}][degree]"
                            value="{{ $edu['degree'] ?? '' }}"
                            placeholder="Degree"
                            class="w-full border-b border-gray-300 py-1 text-sm outline-none">

                        <input type="text" name="education[{{ $i }}][institution]"
                            value="{{ $edu['institution'] ?? '' }}"
                            placeholder="University"
                            class="w-full border-b border-gray-300 py-1 text-sm outline-none">

                        <input type="text" name="education[{{ $i }}][field_of_study]"
                            value="{{ $edu['field_of_study'] ?? '' }}"
                            placeholder="Field of Study"
                            class="w-full border-b border-gray-300 py-1 text-sm outline-none">

                        <div class="grid grid-cols-2 gap-2">
                            <input type="date" name="education[{{ $i }}][start_date]"
                                value="{{ $edu['start_date'] ?? '' }}"
                                class="border-b border-gray-300 py-1 text-sm outline-none">

                            <input type="date" name="education[{{ $i }}][end_date]"
                                value="{{ $edu['end_date'] ?? '' }}"
                                class="border-b border-gray-300 py-1 text-sm outline-none">
                        </div>

                        <textarea name="education[{{ $i }}][description]"
                            placeholder="Description"
                            class="w-full border-b border-gray-300 py-1 text-sm resize-none outline-none">{{ $edu['description'] ?? '' }}</textarea>

                        <button type="button" class="remove-edu text-red-500 text-xs">
                            Remove
                        </button>

                    </div>
                @endforeach
            </div>

            <button type="button" id="add-edu" class="text-blue-600 text-xs">
                + Add Education
            </button>
        </div>

        {{-- SUBMIT --}}
        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded text-sm">
            {{ $profile->exists ? 'Update Profile' : 'Save Profile' }}
        </button>

    </form>
</div>

{{-- ✅ FIXED JS --}}
<script>
document.getElementById('add-skill').onclick = () => {
    document.getElementById('skills-list').insertAdjacentHTML('beforeend',
        `<div class="flex gap-2">
            <input type="text" name="skills[]" class="flex-1 border-b border-gray-300 py-1 text-sm outline-none">
            <button type="button" class="remove text-red-500 text-xs">✕</button>
        </div>`);
};

document.getElementById('add-exp').onclick = () => {
    const list = document.getElementById('experience-list');
    const count = list.querySelectorAll('div').length;

    list.insertAdjacentHTML('beforeend',
        `<div class="space-y-1">
            <input type="text" name="experience[${count}][title]" placeholder="Job Title" class="w-full border-b border-gray-300 py-1 text-sm outline-none">
            <input type="text" name="experience[${count}][company]" placeholder="Company" class="w-full border-b border-gray-300 py-1 text-sm outline-none">
            <div class="grid grid-cols-2 gap-2">
                <input type="date" name="experience[${count}][start_date]" class="border-b border-gray-300 py-1 text-sm outline-none">
                <input type="date" name="experience[${count}][end_date]" class="border-b border-gray-300 py-1 text-sm outline-none">
            </div>
            <textarea name="experience[${count}][description]" placeholder="Description" class="w-full border-b border-gray-300 py-1 text-sm resize-none outline-none"></textarea>
            <button type="button" class="remove-exp text-red-500 text-xs">Remove</button>
        </div>`);
};

document.getElementById('add-edu').onclick = () => {
    const list = document.getElementById('education-list');
    const count = list.querySelectorAll('div').length;

    list.insertAdjacentHTML('beforeend',
        `<div class="space-y-1">
            <input type="text" name="education[${count}][degree]" placeholder="Degree" class="w-full border-b border-gray-300 py-1 text-sm outline-none">
            <input type="text" name="education[${count}][institution]" placeholder="University" class="w-full border-b border-gray-300 py-1 text-sm outline-none">
            <input type="text" name="education[${count}][field_of_study]" placeholder="Field of Study" class="w-full border-b border-gray-300 py-1 text-sm outline-none">
            <div class="grid grid-cols-2 gap-2">
                <input type="date" name="education[${count}][start_date]" class="border-b border-gray-300 py-1 text-sm outline-none">
                <input type="date" name="education[${count}][end_date]" class="border-b border-gray-300 py-1 text-sm outline-none">
            </div>
            <textarea name="education[${count}][description]" placeholder="Description" class="w-full border-b border-gray-300 py-1 text-sm resize-none outline-none"></textarea>
            <button type="button" class="remove-edu text-red-500 text-xs">Remove</button>
        </div>`);
};

document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove') ||
       e.target.classList.contains('remove-exp') ||
       e.target.classList.contains('remove-edu')) {
        e.target.closest('div').remove();
    }
});
</script>

@endsection