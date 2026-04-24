@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            {{ $profile->exists ? 'Edit Profile' : 'Create Profile' }}
        </h1>
        <p class="text-sm text-gray-500">
            Update your profile information below.
        </p>
    </div>

    <!-- FORM -->
    <form method="POST"
        action="{{ $profile->exists ? route('jobseeker.profile.update') : route('jobseeker.profile.store') }}"
        class="space-y-6">

        @csrf
        @if($profile->exists) @method('PUT') @endif

        <!-- BASIC INFO -->
        <div class="bg-white p-6 rounded-xl border space-y-4">

            <input type="text" name="headline"
                value="{{ old('headline', $profile->headline ?? '') }}"
                placeholder="Headline"
                class="w-full border rounded p-2">

            <textarea name="bio"
                placeholder="Bio"
                class="w-full border rounded p-2">{{ old('bio', $profile->bio ?? '') }}</textarea>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <input type="text" name="location"
                    value="{{ old('location', $profile->location ?? '') }}"
                    placeholder="Location"
                    class="border rounded p-2">

                <input type="text" name="phone"
                    value="{{ old('phone', $profile->phone ?? '') }}"
                    placeholder="Phone"
                    class="border rounded p-2">

                <input type="text" name="website"
                    value="{{ old('website', $profile->website ?? '') }}"
                    placeholder="Website"
                    class="border rounded p-2">
            </div>

        </div>

        <!-- SKILLS -->
        <div class="bg-white p-6 rounded-xl border">
            <h3 class="font-semibold mb-2">Skills</h3>

            <div id="skills-list">
                @foreach(old('skills', $profile->skills ?? ['']) as $skill)
                    <div class="flex gap-2 mb-2">
                        <input type="text" name="skills[]" value="{{ $skill }}"
                            class="flex-1 border rounded p-2">
                        <button type="button" class="remove bg-red-500 text-white px-3 rounded">
                            X
                        </button>
                    </div>
                @endforeach
            </div>

            <button type="button" id="add-skill"
                class="mt-2 bg-blue-600 text-white px-4 py-1 rounded">
                + Add Skill
            </button>
        </div>

        <!-- EXPERIENCE -->
        <div class="bg-white p-6 rounded-xl border">
            <h3 class="font-semibold mb-2">Experience</h3>

            <div id="experience-list">
                @foreach(old('experience', $profile->experience ?? []) as $i => $exp)
                    <div class="border p-3 rounded mb-3 space-y-2">
                        <input type="text" name="experience[{{ $i }}][title]"
                            value="{{ $exp['title'] ?? '' }}"
                            placeholder="Title"
                            class="w-full border p-2 rounded">

                        <input type="text" name="experience[{{ $i }}][company]"
                            value="{{ $exp['company'] ?? '' }}"
                            placeholder="Company"
                            class="w-full border p-2 rounded">

                        <div class="grid grid-cols-2 gap-2">
                            <input type="date" name="experience[{{ $i }}][start_date]"
                                value="{{ $exp['start_date'] ?? '' }}"
                                class="border p-2 rounded">

                            <input type="date" name="experience[{{ $i }}][end_date]"
                                value="{{ $exp['end_date'] ?? '' }}"
                                class="border p-2 rounded">
                        </div>

                        <textarea name="experience[{{ $i }}][description]"
                            placeholder="Description"
                            class="w-full border p-2 rounded">{{ $exp['description'] ?? '' }}</textarea>

                        <button type="button" class="remove-exp text-red-500 text-sm">
                            Remove
                        </button>
                    </div>
                @endforeach
            </div>

            <button type="button" id="add-exp"
                class="bg-blue-600 text-white px-4 py-1 rounded">
                + Add Experience
            </button>
        </div>

        <!-- EDUCATION -->
        <div class="bg-white p-6 rounded-xl border">
            <h3 class="font-semibold mb-2">Education</h3>

            <div id="education-list">
                @foreach(old('education', $profile->education ?? [['degree' => '', 'institution' => '', 'field_of_study' => '', 'start_date' => '', 'end_date' => '', 'description' => '']]) as $i => $edu)
                    <div class="border p-3 rounded mb-3 space-y-2">
                        <input type="text" name="education[{{ $i }}][degree]"
                            value="{{ $edu['degree'] ?? '' }}"
                            placeholder="Degree"
                            class="w-full border p-2 rounded">

                        <input type="text" name="education[{{ $i }}][institution]"
                            value="{{ $edu['institution'] ?? '' }}"
                            placeholder="Institution"
                            class="w-full border p-2 rounded">

                        <input type="text" name="education[{{ $i }}][field_of_study]"
                            value="{{ $edu['field_of_study'] ?? '' }}"
                            placeholder="Field of Study"
                            class="w-full border p-2 rounded">

                        <div class="grid grid-cols-2 gap-2">
                            <input type="date" name="education[{{ $i }}][start_date]"
                                value="{{ $edu['start_date'] ?? '' }}"
                                class="border p-2 rounded">

                            <input type="date" name="education[{{ $i }}][end_date]"
                                value="{{ $edu['end_date'] ?? '' }}"
                                class="border p-2 rounded">
                        </div>

                        <textarea name="education[{{ $i }}][description]"
                            placeholder="Description"
                            class="w-full border p-2 rounded">{{ $edu['description'] ?? '' }}</textarea>

                        <button type="button" class="remove-edu text-red-500 text-sm">
                            Remove
                        </button>
                    </div>
                @endforeach
            </div>

            <button type="button" id="add-edu"
                class="bg-blue-600 text-white px-4 py-1 rounded">
                + Add Education
            </button>
        </div>

        <!-- SUBMIT -->
        <button class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold">
            {{ $profile->exists ? 'Update Profile' : 'Save Profile' }}
        </button>

    </form>
</div>

<!-- SIMPLE JS -->
<script>
document.getElementById('add-skill').onclick = () => {
    document.getElementById('skills-list').insertAdjacentHTML('beforeend',
        `<div class="flex gap-2 mb-2">
            <input type="text" name="skills[]" class="flex-1 border rounded p-2">
            <button type="button" class="remove bg-red-500 text-white px-3 rounded">X</button>
        </div>`);
};

document.getElementById('add-exp').onclick = () => {
    const list = document.getElementById('experience-list');
    const count = list.querySelectorAll('.border.p-3').length;
    list.insertAdjacentHTML('beforeend',
        `<div class="border p-3 rounded mb-3 space-y-2">
            <input type="text" name="experience[${count}][title]" placeholder="Title" class="w-full border p-2 rounded">
            <input type="text" name="experience[${count}][company]" placeholder="Company" class="w-full border p-2 rounded">
            <div class="grid grid-cols-2 gap-2">
                <input type="date" name="experience[${count}][start_date]" class="border p-2 rounded">
                <input type="date" name="experience[${count}][end_date]" class="border p-2 rounded">
            </div>
            <textarea name="experience[${count}][description]" placeholder="Description" class="w-full border p-2 rounded"></textarea>
            <button type="button" class="remove-exp text-red-500 text-sm">Remove</button>
        </div>`);
};

document.getElementById('add-edu').onclick = () => {
    const list = document.getElementById('education-list');
    const count = list.querySelectorAll('.border.p-3').length;
    list.insertAdjacentHTML('beforeend',
        `<div class="border p-3 rounded mb-3 space-y-2">
            <input type="text" name="education[${count}][degree]" placeholder="Degree" class="w-full border p-2 rounded">
            <input type="text" name="education[${count}][institution]" placeholder="Institution" class="w-full border p-2 rounded">
            <input type="text" name="education[${count}][field_of_study]" placeholder="Field of Study" class="w-full border p-2 rounded">
            <div class="grid grid-cols-2 gap-2">
                <input type="date" name="education[${count}][start_date]" class="border p-2 rounded">
                <input type="date" name="education[${count}][end_date]" class="border p-2 rounded">
            </div>
            <textarea name="education[${count}][description]" placeholder="Description" class="w-full border p-2 rounded"></textarea>
            <button type="button" class="remove-edu text-red-500 text-sm">Remove</button>
        </div>`);
};

document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove') || e.target.classList.contains('remove-exp') || e.target.classList.contains('remove-edu')){
        e.target.closest('div.border').remove();
    }
});
</script>

@endsection