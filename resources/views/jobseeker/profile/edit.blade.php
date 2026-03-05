{{-- resources/views/jobseeker/profile/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        {{-- General Info --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Headline</label>
            <input type="text" name="headline" value="{{ old('headline', $profile->headline) }}" class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Bio</label>
            <textarea name="bio" class="border p-2 w-full">{{ old('bio', $profile->bio) }}</textarea>
        </div>

        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">Location</label>
                <input type="text" name="location" value="{{ old('location', $profile->location) }}" class="border p-2 w-full">
            </div>
            <div>
                <label class="block mb-1 font-semibold">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="border p-2 w-full">
            </div>
            <div>
                <label class="block mb-1 font-semibold">Website</label>
                <input type="text" name="website" value="{{ old('website', $profile->website) }}" class="border p-2 w-full">
            </div>
        </div>

        {{-- Skills --}}
        <div class="mb-4">
            <h3 class="font-semibold mb-2">Skills</h3>
            <div id="skills">
                @foreach($profile->skills ?? [] as $i => $skill)
                    <div class="flex mb-1 gap-2">
                        <input type="text" name="skills[]" value="{{ $skill }}" class="border p-2 flex-1">
                        <button type="button" class="remove-skill bg-red-500 text-white px-2 rounded">Remove</button>
                    </div>
                @endforeach
                {{-- Empty field if no skills --}}
                @if(empty($profile->skills))
                    <div class="flex mb-1 gap-2">
                        <input type="text" name="skills[]" class="border p-2 flex-1">
                        <button type="button" class="remove-skill bg-red-500 text-white px-2 rounded">Remove</button>
                    </div>
                @endif
            </div>
            <button type="button" id="add-skill" class="bg-blue-500 text-white px-4 py-1 rounded mt-2">Add Skill</button>
        </div>

        {{-- Experiences --}}
        <div class="mb-4">
            <h3 class="font-semibold mb-2">Experiences</h3>
            <div id="experiences">
                @foreach($profile->experience ?? [] as $i => $exp)
                    <div class="mb-2 border p-2 rounded">
                        <input type="text" name="experience[{{ $i }}][title]" value="{{ $exp['title'] ?? '' }}" placeholder="Title" class="border p-1 w-full mb-1">
                        <input type="text" name="experience[{{ $i }}][company]" value="{{ $exp['company'] ?? '' }}" placeholder="Company" class="border p-1 w-full mb-1">
                        <input type="date" name="experience[{{ $i }}][start_date]" value="{{ $exp['start_date'] ?? '' }}" class="border p-1 w-full mb-1">
                        <input type="date" name="experience[{{ $i }}][end_date]" value="{{ $exp['end_date'] ?? '' }}" class="border p-1 w-full mb-1">
                        <textarea name="experience[{{ $i }}][description]" placeholder="Description" class="border p-1 w-full">{{ $exp['description'] ?? '' }}</textarea>
                        <button type="button" class="remove-experience bg-red-500 text-white px-2 py-1 mt-1 rounded">Remove</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-experience" class="bg-blue-500 text-white px-4 py-1 rounded mt-2">Add Experience</button>
        </div>

        {{-- Education --}}
        <div class="mb-4">
            <h3 class="font-semibold mb-2">Education</h3>
            <div id="education">
                @foreach($profile->education ?? [] as $i => $edu)
                    <div class="mb-2 border p-2 rounded">
                        <input type="text" name="education[{{ $i }}][degree]" value="{{ $edu['degree'] ?? '' }}" placeholder="Degree" class="border p-1 w-full mb-1">
                        <input type="text" name="education[{{ $i }}][school]" value="{{ $edu['school'] ?? '' }}" placeholder="School" class="border p-1 w-full mb-1">
                        <input type="date" name="education[{{ $i }}][start_date]" value="{{ $edu['start_date'] ?? '' }}" class="border p-1 w-full mb-1">
                        <input type="date" name="education[{{ $i }}][end_date]" value="{{ $edu['end_date'] ?? '' }}" class="border p-1 w-full mb-1">
                        <button type="button" class="remove-education bg-red-500 text-white px-2 py-1 mt-1 rounded">Remove</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-education" class="bg-blue-500 text-white px-4 py-1 rounded mt-2">Add Education</button>
        </div>

        {{-- Certifications --}}
        <div class="mb-4">
            <h3 class="font-semibold mb-2">Certifications</h3>
            <div id="certifications">
                @foreach($profile->certifications ?? [] as $i => $cert)
                    <div class="flex mb-1 gap-2">
                        <input type="text" name="certifications[]" value="{{ $cert }}" class="border p-2 flex-1">
                        <button type="button" class="remove-cert bg-red-500 text-white px-2 rounded">Remove</button>
                    </div>
                @endforeach
                @if(empty($profile->certifications))
                    <div class="flex mb-1 gap-2">
                        <input type="text" name="certifications[]" class="border p-2 flex-1">
                        <button type="button" class="remove-cert bg-red-500 text-white px-2 rounded">Remove</button>
                    </div>
                @endif
            </div>
            <button type="button" id="add-cert" class="bg-blue-500 text-white px-4 py-1 rounded mt-2">Add Certification</button>
        </div>

        {{-- Interests --}}
        <div class="mb-4">
            <h3 class="font-semibold mb-2">Interests</h3>
            <div id="interests">
                @foreach($profile->interests ?? [] as $i => $interest)
                    <div class="flex mb-1 gap-2">
                        <input type="text" name="interests[]" value="{{ $interest }}" class="border p-2 flex-1">
                        <button type="button" class="remove-interest bg-red-500 text-white px-2 rounded">Remove</button>
                    </div>
                @endforeach
                @if(empty($profile->interests))
                    <div class="flex mb-1 gap-2">
                        <input type="text" name="interests[]" class="border p-2 flex-1">
                        <button type="button" class="remove-interest bg-red-500 text-white px-2 rounded">Remove</button>
                    </div>
                @endif
            </div>
            <button type="button" id="add-interest" class="bg-blue-500 text-white px-4 py-1 rounded mt-2">Add Interest</button>
        </div>

        <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded">Save Profile</button>
    </form>
</div>

{{-- JS for dynamic fields --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    function createField(wrapperId, removeClass, inputHTML) {
        const wrapper = document.getElementById(wrapperId);
        const div = document.createElement('div');
        div.classList.add('mb-1', 'flex', 'gap-2');
        div.innerHTML = inputHTML;
        wrapper.appendChild(div);

        div.querySelector(`.${removeClass}`).addEventListener('click', function() {
            div.remove();
        });
    }

    // Skills
    document.getElementById('add-skill').addEventListener('click', function() {
        createField('skills', 'remove-skill', `<input type="text" name="skills[]" class="border p-2 flex-1">
        <button type="button" class="remove-skill bg-red-500 text-white px-2 rounded">Remove</button>`);
    });
    document.querySelectorAll('.remove-skill').forEach(btn => btn.addEventListener('click', e => e.target.closest('div').remove()));

    // Certifications
    document.getElementById('add-cert').addEventListener('click', function() {
        createField('certifications', 'remove-cert', `<input type="text" name="certifications[]" class="border p-2 flex-1">
        <button type="button" class="remove-cert bg-red-500 text-white px-2 rounded">Remove</button>`);
    });
    document.querySelectorAll('.remove-cert').forEach(btn => btn.addEventListener('click', e => e.target.closest('div').remove()));
    
    // Interests
    document.getElementById('add-interest').addEventListener('click', function() {
        createField('interests', 'remove-interest', `<input type="text" name="interests[]" class="border p-2 flex-1">
        <button type="button" class="remove-interest bg-red-500 text-white px-2 rounded">Remove</button>`);
    });
    document.querySelectorAll('.remove-interest').forEach(btn => btn.addEventListener('click', e => e.target.closest('div').remove()));

    // Experiences and Education would need similar JS if you want fully dynamic blocks.
});
</script>
@endsection