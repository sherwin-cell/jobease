@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">
        {{ $profile->exists ? 'Edit Profile' : 'Complete Your Profile' }}
    </h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('info'))
        <div class="bg-blue-100 text-blue-700 p-2 mb-4 rounded">
            {{ session('info') }}
        </div>
    @endif

    <form method="POST" action="{{ $profile->exists ? route('jobseeker.profile.update') : route('jobseeker.profile.store') }}">
        @csrf
        @if($profile->exists) @method('PUT') @endif

        {{-- Headline --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Headline</label>
            <input type="text" name="headline" value="{{ old('headline', $profile->headline ?? '') }}"
                class="border p-2 w-full rounded">
        </div>

        {{-- Bio --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Bio</label>
            <textarea name="bio" class="border p-2 w-full rounded">{{ old('bio', $profile->bio ?? '') }}</textarea>
        </div>

        {{-- Location, Phone, Website --}}
        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">Location</label>
                <input type="text" name="location" value="{{ old('location', $profile->location ?? '') }}"
                    class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="block mb-1 font-semibold">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}"
                    class="border p-2 w-full rounded">
            </div>
            <div class="col-span-2">
                <label class="block mb-1 font-semibold">Website</label>
                <input type="text" name="website" value="{{ old('website', $profile->website ?? '') }}"
                    class="border p-2 w-full rounded">
            </div>
        </div>

        {{-- Skills --}}
        <div class="mb-4">
            <h3 class="font-semibold mb-2">Skills</h3>
            <div id="skills-list">
                @foreach(old('skills', $profile->skills ?? ['']) as $skill)
                    <div class="flex mb-1 gap-2">
                        <input type="text" name="skills[]" value="{{ $skill }}"
                            class="border p-2 flex-1 rounded" placeholder="e.g. PHP">
                        <button type="button"
                            class="remove-skill bg-red-500 text-white px-2 rounded">Remove</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-skill"
                class="bg-blue-500 text-white px-4 py-1 rounded mt-2">Add Skill</button>
        </div>

        {{-- Experiences --}}
        <div id="experiences" class="mb-4">
            <h3 class="font-semibold mb-2">Experience</h3>
            @foreach(old('experience', $profile->experience ?? [['title' => '', 'company' => '', 'start_date' => '', 'end_date' => '', 'description' => '']]) as $i => $exp)
                <div class="mb-2 border p-2 rounded">
                    <input type="text" name="experience[{{ $i }}][title]" value="{{ $exp['title'] ?? '' }}"
                        placeholder="Title" class="border p-1 w-full mb-1 rounded">
                    <input type="text" name="experience[{{ $i }}][company]" value="{{ $exp['company'] ?? '' }}"
                        placeholder="Company" class="border p-1 w-full mb-1 rounded">
                    <input type="date" name="experience[{{ $i }}][start_date]" value="{{ $exp['start_date'] ?? '' }}"
                        class="border p-1 w-full mb-1 rounded">
                    <input type="date" name="experience[{{ $i }}][end_date]" value="{{ $exp['end_date'] ?? '' }}"
                        class="border p-1 w-full mb-1 rounded">
                    <textarea name="experience[{{ $i }}][description]" placeholder="Description"
                        class="border p-1 w-full mb-1 rounded">{{ $exp['description'] ?? '' }}</textarea>
                    <button type="button"
                        class="remove-experience bg-red-500 text-white px-2 py-1 mt-1 rounded">Remove</button>
                </div>
            @endforeach
            <button type="button" id="add-experience"
                class="bg-blue-500 text-white px-4 py-1 rounded mt-2">Add Experience</button>
        </div>

        {{-- Education --}}
        <div id="education" class="mb-4">
            <h3 class="font-semibold mb-2">Education</h3>
            @foreach(old('education', $profile->education ?? [['degree' => '', 'institution' => '', 'start_date' => '', 'end_date' => '']]) as $i => $edu)
                <div class="mb-2 border p-2 rounded">
                    <input type="text" name="education[{{ $i }}][degree]" value="{{ $edu['degree'] ?? '' }}"
                        placeholder="Degree" class="border p-1 w-full mb-1 rounded">
                    <input type="text" name="education[{{ $i }}][institution]" value="{{ $edu['institution'] ?? '' }}"
                        placeholder="Institution" class="border p-1 w-full mb-1 rounded">
                    <input type="date" name="education[{{ $i }}][start_date]" value="{{ $edu['start_date'] ?? '' }}"
                        class="border p-1 w-full mb-1 rounded">
                    <input type="date" name="education[{{ $i }}][end_date]" value="{{ $edu['end_date'] ?? '' }}"
                        class="border p-1 w-full mb-1 rounded">
                    <button type="button"
                        class="remove-education bg-red-500 text-white px-2 py-1 mt-1 rounded">Remove</button>
                </div>
            @endforeach
            <button type="button" id="add-education"
                class="bg-blue-500 text-white px-4 py-1 rounded mt-2">Add Education</button>
        </div>

        {{-- Certifications --}}
        <div id="certifications" class="mb-4">
            <h3 class="font-semibold mb-2">Certifications</h3>
            @foreach(old('certifications', $profile->certifications ?? ['']) as $cert)
                <div class="flex mb-1 gap-2">
                    <input type="text" name="certifications[]" value="{{ $cert }}"
                        class="border p-2 flex-1 rounded">
                    <button type="button"
                        class="remove-cert bg-red-500 text-white px-2 rounded">Remove</button>
                </div>
            @endforeach
            <button type="button" id="add-cert"
                class="bg-blue-500 text-white px-4 py-1 rounded mt-2">Add Certification</button>
        </div>

        {{-- Interests --}}
        <div id="interests" class="mb-4">
            <h3 class="font-semibold mb-2">Interests</h3>
            @foreach(old('interests', $profile->interests ?? ['']) as $interest)
                <div class="flex mb-1 gap-2">
                    <input type="text" name="interests[]" value="{{ $interest }}"
                        class="border p-2 flex-1 rounded">
                    <button type="button"
                        class="remove-interest bg-red-500 text-white px-2 rounded">Remove</button>
                </div>
            @endforeach
            <button type="button" id="add-interest"
                class="bg-blue-500 text-white px-4 py-1 rounded mt-2">Add Interest</button>
        </div>

        <button type="submit"
            class="bg-green-500 text-white px-6 py-2 rounded mt-4 w-full">
            {{ $profile->exists ? 'Update Profile' : 'Save Profile' }}
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // Skills
        document.getElementById('add-skill')?.addEventListener('click', () => {
            const list = document.getElementById('skills-list');
            const div = document.createElement('div');
            div.classList.add('flex', 'mb-1', 'gap-2');
            div.innerHTML = `
                <input type="text" name="skills[]" class="border p-2 flex-1 rounded" placeholder="e.g. PHP">
                <button type="button" class="remove-skill bg-red-500 text-white px-2 rounded">Remove</button>`;
            list.appendChild(div);
            div.querySelector('.remove-skill').addEventListener('click', () => div.remove());
        });

        document.querySelectorAll('.remove-skill')
            .forEach(btn => btn.addEventListener('click', e => e.target.closest('div').remove()));

        // Certifications
        document.getElementById('add-cert')?.addEventListener('click', () => {
            const wrapper = document.getElementById('certifications');
            const div = document.createElement('div');
            div.classList.add('flex', 'mb-1', 'gap-2');
            div.innerHTML = `
                <input type="text" name="certifications[]" class="border p-2 flex-1 rounded">
                <button type="button" class="remove-cert bg-red-500 text-white px-2 rounded">Remove</button>`;
            wrapper.insertBefore(div, document.getElementById('add-cert'));
            div.querySelector('.remove-cert').addEventListener('click', () => div.remove());
        });

        // Interests
        document.getElementById('add-interest')?.addEventListener('click', () => {
            const wrapper = document.getElementById('interests');
            const div = document.createElement('div');
            div.classList.add('flex', 'mb-1', 'gap-2');
            div.innerHTML = `
                <input type="text" name="interests[]" class="border p-2 flex-1 rounded">
                <button type="button" class="remove-interest bg-red-500 text-white px-2 rounded">Remove</button>`;
            wrapper.insertBefore(div, document.getElementById('add-interest'));
            div.querySelector('.remove-interest').addEventListener('click', () => div.remove());
        });

        // Experience
        document.getElementById('add-experience')?.addEventListener('click', () => {
            const wrapper = document.getElementById('experiences');
            const count = wrapper.querySelectorAll('div.mb-2').length;
            const div = document.createElement('div');
            div.classList.add('mb-2', 'border', 'p-2', 'rounded');
            div.innerHTML = `
                <input type="text" name="experience[${count}][title]" placeholder="Title" class="border p-1 w-full mb-1 rounded">
                <input type="text" name="experience[${count}][company]" placeholder="Company" class="border p-1 w-full mb-1 rounded">
                <input type="date" name="experience[${count}][start_date]" class="border p-1 w-full mb-1 rounded">
                <input type="date" name="experience[${count}][end_date]" class="border p-1 w-full mb-1 rounded">
                <textarea name="experience[${count}][description]" placeholder="Description" class="border p-1 w-full mb-1 rounded"></textarea>
                <button type="button" class="remove-experience bg-red-500 text-white px-2 py-1 mt-1 rounded">Remove</button>`;
            wrapper.insertBefore(div, document.getElementById('add-experience'));
            div.querySelector('.remove-experience').addEventListener('click', () => div.remove());
        });

        // Education
        document.getElementById('add-education')?.addEventListener('click', () => {
            const wrapper = document.getElementById('education');
            const count = wrapper.querySelectorAll('div.mb-2').length;
            const div = document.createElement('div');
            div.classList.add('mb-2', 'border', 'p-2', 'rounded');
            div.innerHTML = `
                <input type="text" name="education[${count}][degree]" placeholder="Degree" class="border p-1 w-full mb-1 rounded">
                <input type="text" name="education[${count}][institution]" placeholder="Institution" class="border p-1 w-full mb-1 rounded">
                <input type="date" name="education[${count}][start_date]" class="border p-1 w-full mb-1 rounded">
                <input type="date" name="education[${count}][end_date]" class="border p-1 w-full mb-1 rounded">
                <button type="button" class="remove-education bg-red-500 text-white px-2 py-1 mt-1 rounded">Remove</button>`;
            wrapper.appendChild(div);
            div.querySelector('.remove-education').addEventListener('click', () => div.remove());
        });

        // Remove existing fields
        document.querySelectorAll('.remove-cert, .remove-interest, .remove-experience, .remove-education')
            .forEach(btn => btn.addEventListener('click', e => e.target.closest('div').remove()));
    });
</script>
@endsection