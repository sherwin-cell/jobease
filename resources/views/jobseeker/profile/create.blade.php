@extends('layouts.standalone')

@section('content')

    <style>
        .profile-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 rgba(60, 72, 88, .08);
            padding: 2.5rem 2rem;
            max-width: 700px;
            margin: 2rem auto;
        }

        .profile-section {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }

        .profile-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .profile-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .profile-input,
        .profile-textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            background: #f9fafb;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-size: 1rem;
            margin-bottom: 0.75rem;
        }

        .profile-input:focus,
        .profile-textarea:focus {
            border-color: #2563eb;
            outline: none;
            box-shadow: 0 0 0 2px #2563eb22;
            background: #fff;
        }

        .profile-btn-primary {
            background: linear-gradient(90deg, #2563eb 0%, #1e40af 100%);
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            margin-top: 1.5rem;
            width: 100%;
            font-size: 1.1rem;
            transition: background 0.2s;
        }

        .profile-btn-primary:hover {
            background: linear-gradient(90deg, #1e40af 0%, #2563eb 100%);
        }

        .profile-btn-add {
            background: #e0e7ff;
            color: #3730a3;
            font-weight: 500;
            border: none;
            border-radius: 6px;
            padding: 0.4rem 1.2rem;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.98rem;
            transition: background 0.2s;
        }

        .profile-btn-add:hover {
            background: #c7d2fe;
        }

        .profile-btn-remove {
            background: #fee2e2;
            color: #b91c1c;
            border: none;
            border-radius: 6px;
            padding: 0.4rem 1.2rem;
            font-size: 0.98rem;
            font-weight: 500;
            transition: background 0.2s;
        }

        .profile-btn-remove:hover {
            background: #fecaca;
        }

        .profile-flex-row {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .profile-flex-col {
            flex: 1 1 0;
            min-width: 220px;
        }

        .profile-section-title {
            font-size: 1.15rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1rem;
            letter-spacing: 0.01em;
        }
    </style>

    <div class="profile-card">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">
            {{ $profile->exists ? 'Complete Your Profile' : 'Complete Your Profile' }}
        </h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div class="bg-blue-50 text-blue-700 p-3 mb-4 rounded text-center">
                {{ session('info') }}
            </div>
        @endif

        {{-- No sign-in form duplication here --}}
        <form method="POST"
            action="{{ $profile->exists ? route('jobseeker.profile.update') : route('jobseeker.profile.store') }}">
            @csrf
            @if($profile->exists) @method('PUT') @endif

            {{-- Headline & Bio --}}
            <div class="profile-section">
                <label class="profile-label">Headline</label>
                <input type="text" name="headline" value="{{ old('headline', $profile->headline ?? '') }}"
                    class="profile-input">

                <label class="profile-label">Bio</label>
                <textarea name="bio" class="profile-textarea" rows="3">{{ old('bio', $profile->bio ?? '') }}</textarea>
            </div>

            {{-- Location, Phone, Website --}}
            <div class="profile-section">
                <div class="profile-flex-row">
                    <div class="profile-flex-col">
                        <label class="profile-label">Location</label>
                        <input type="text" name="location" value="{{ old('location', $profile->location ?? '') }}"
                            class="profile-input">
                    </div>
                    <div class="profile-flex-col">
                        <label class="profile-label">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}"
                            class="profile-input" placeholder="Enter phone number"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <div style="margin-top:1rem;">
                        <label class="profile-label">Website</label>
                        <input type="text" name="website" value="{{ old('website', $profile->website ?? '') }}"
                            class="profile-input">
                    </div>
                </div>

                {{-- Skills --}}
                <div class="profile-section">
                    <div class="profile-section-title">Skills</div>
                    <div id="skills-list">
                        @foreach(old('skills', $profile->skills ?? ['']) as $skill)
                            <div class="profile-flex-row" style="align-items:center; margin-bottom:0.5rem;">
                                <input type="text" name="skills[]" value="{{ $skill }}" class="profile-input"
                                    placeholder="e.g. PHP">
                                <button type="button" class="remove-skill profile-btn-remove">Remove</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-skill" class="profile-btn-add">Add Skill</button>
                </div>

                {{-- Experiences --}}
                <div id="experiences" class="profile-section">
                    <div class="profile-section-title">Experience</div>
                    @foreach(old('experience', $profile->experience ?? [['title' => '', 'company' => '', 'start_date' => '', 'end_date' => '', 'description' => '']]) as $i => $exp)
                        <div class="mb-3"
                            style="background:#f3f4f6; border-radius:10px; padding:1rem 1.2rem; margin-bottom:1.2rem;">
                            <input type="text" name="experience[{{ $i }}][title]" value="{{ $exp['title'] ?? '' }}"
                                placeholder="Title" class="profile-input">
                            <input type="text" name="experience[{{ $i }}][company]" value="{{ $exp['company'] ?? '' }}"
                                placeholder="Company" class="profile-input">
                            <div class="profile-flex-row">
                                <input type="date" name="experience[{{ $i }}][start_date]"
                                    value="{{ $exp['start_date'] ?? '' }}" class="profile-input">
                                <input type="date" name="experience[{{ $i }}][end_date]" value="{{ $exp['end_date'] ?? '' }}"
                                    class="profile-input">
                            </div>
                            <textarea name="experience[{{ $i }}][description]" placeholder="Description"
                                class="profile-textarea" rows="2">{{ $exp['description'] ?? '' }}</textarea>
                            <button type="button" class="remove-experience profile-btn-remove"
                                style="margin-top:0.5rem;">Remove</button>
                        </div>
                    @endforeach
                    <button type="button" id="add-experience" class="profile-btn-add">Add Experience</button>
                </div>

                {{-- Education --}}
                <div id="education" class="profile-section">
                    <div class="profile-section-title">Education</div>
                    @foreach(old('education', $profile->education ?? [['degree' => '', 'institution' => '', 'start_date' => '', 'end_date' => '']]) as $i => $edu)
                        <div class="mb-3"
                            style="background:#f3f4f6; border-radius:10px; padding:1rem 1.2rem; margin-bottom:1.2rem;">
                            <input type="text" name="education[{{ $i }}][degree]" value="{{ $edu['degree'] ?? '' }}"
                                placeholder="Degree" class="profile-input">
                            <input type="text" name="education[{{ $i }}][institution]" value="{{ $edu['institution'] ?? '' }}"
                                placeholder="Institution" class="profile-input">
                            <div class="profile-flex-row">
                                <input type="date" name="education[{{ $i }}][start_date]" value="{{ $edu['start_date'] ?? '' }}"
                                    class="profile-input">
                                <input type="date" name="education[{{ $i }}][end_date]" value="{{ $edu['end_date'] ?? '' }}"
                                    class="profile-input">
                            </div>
                            <button type="button" class="remove-education profile-btn-remove"
                                style="margin-top:0.5rem;">Remove</button>
                        </div>
                    @endforeach
                    <button type="button" id="add-education" class="profile-btn-add">Add Education</button>
                </div>

                {{-- Certifications --}}
                <div id="certifications" class="profile-section">
                    <div class="profile-section-title">Certifications</div>
                    @foreach(old('certifications', $profile->certifications ?? ['']) as $cert)
                        <div class="profile-flex-row" style="align-items:center; margin-bottom:0.5rem;">
                            <input type="text" name="certifications[]" value="{{ $cert }}" class="profile-input">
                            <button type="button" class="remove-cert profile-btn-remove">Remove</button>
                        </div>
                    @endforeach
                    <button type="button" id="add-cert" class="profile-btn-add">Add Certification</button>
                </div>

                {{-- Interests --}}
                <div id="interests" class="profile-section">
                    <div class="profile-section-title">Interests</div>
                    @foreach(old('interests', $profile->interests ?? ['']) as $interest)
                        <div class="profile-flex-row" style="align-items:center; margin-bottom:0.5rem;">
                            <input type="text" name="interests[]" value="{{ $interest }}" class="profile-input">
                            <button type="button" class="remove-interest profile-btn-remove">Remove</button>
                        </div>
                    @endforeach
                    <button type="button" id="add-interest" class="profile-btn-add">Add Interest</button>
                </div>

                <button type="submit" class="profile-btn-primary">
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