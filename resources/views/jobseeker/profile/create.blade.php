@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            {{ $profile->exists ? 'Edit Profile' : 'Complete Your Profile' }}
        </h1>
        @if($profile->exists)
            <a href="{{ route('jobseeker.profile.show') }}"
               class="text-sm text-blue-600 hover:underline">← Back to Profile</a>
        @endif
    </div>

    <form method="POST" action="{{ $profile->exists ? route('jobseeker.profile.update') : route('jobseeker.profile.store') }}">
        @csrf
        @if($profile->exists) @method('PUT') @endif

        {{-- Basic Info --}}
        <section class="rounded-2xl border border-gray-200 bg-white p-6 mb-6">
            <h2 class="text-base font-semibold text-gray-700 mb-4">Basic Information</h2>

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">Headline</label>
                <input type="text" name="headline" value="{{ old('headline', $profile->headline ?? '') }}"
                    class="border border-gray-300 p-2 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="e.g. Senior Software Engineer">
                @error('headline') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">Bio</label>
                <textarea name="bio" rows="4"
                    class="border border-gray-300 p-2 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Tell employers a little about yourself…">{{ old('bio', $profile->bio ?? '') }}</textarea>
                @error('bio') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" value="{{ old('location', $profile->location ?? '') }}"
                        class="border border-gray-300 p-2 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="City, Country">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}"
                        class="border border-gray-300 p-2 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="+1 555-000-0000">
                </div>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Website / LinkedIn</label>
                <input type="text" name="website" value="{{ old('website', $profile->website ?? '') }}"
                    class="border border-gray-300 p-2 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="https://...">
                @error('website') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </section>

        {{-- Skills --}}
        <section class="rounded-2xl border border-gray-200 bg-white p-6 mb-6">
            <h2 class="text-base font-semibold text-gray-700 mb-4">Skills</h2>
            <div id="skills-list" class="space-y-2">
                @foreach(old('skills', $profile->skills ?? []) as $skill)
                    @if($skill !== '')
                        <div class="flex gap-2 items-center skill-row">
                            <input type="text" name="skills[]" value="{{ $skill }}"
                                class="border border-gray-300 p-2 flex-1 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="e.g. PHP">
                            <button type="button"
                                class="remove-row shrink-0 text-red-600 hover:text-red-800 text-sm font-medium">Remove</button>
                        </div>
                    @endif
                @endforeach
            </div>
            <button type="button" id="add-skill"
                class="mt-3 text-sm text-blue-600 hover:text-blue-800 font-medium">+ Add Skill</button>
        </section>

        {{-- Experience --}}
        <section class="rounded-2xl border border-gray-200 bg-white p-6 mb-6">
            <h2 class="text-base font-semibold text-gray-700 mb-4">Experience</h2>
            <div id="experience-list" class="space-y-4">
                @php $experiences = old('experience', $profile->experience ?? []); @endphp
                @foreach($experiences as $i => $exp)
                    @php $isCurrent = !empty($exp['current_job']); @endphp
                    <div class="experience-entry border border-gray-200 rounded-xl p-4 bg-gray-50">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block mb-1 text-xs font-medium text-gray-600">Job Title *</label>
                                <input type="text" name="experience[{{ $i }}][title]"
                                    value="{{ $exp['title'] ?? '' }}"
                                    placeholder="e.g. Software Engineer"
                                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-medium text-gray-600">Company *</label>
                                <input type="text" name="experience[{{ $i }}][company]"
                                    value="{{ $exp['company'] ?? '' }}"
                                    placeholder="e.g. Acme Corp"
                                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block mb-1 text-xs font-medium text-gray-600">Start Date *</label>
                                <input type="date" name="experience[{{ $i }}][start_date]"
                                    value="{{ $exp['start_date'] ?? '' }}"
                                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="end-date-wrapper {{ $isCurrent ? 'hidden' : '' }}">
                                <label class="block mb-1 text-xs font-medium text-gray-600">End Date</label>
                                <input type="date" name="experience[{{ $i }}][end_date]"
                                    value="{{ $exp['end_date'] ?? '' }}"
                                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <div class="flex items-center gap-2 mb-3">
                            <input type="checkbox" name="experience[{{ $i }}][current_job]"
                                value="1" id="current_job_{{ $i }}"
                                class="current-job-checkbox rounded"
                                {{ $isCurrent ? 'checked' : '' }}>
                            <label for="current_job_{{ $i }}" class="text-sm text-gray-700">I currently work here</label>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-600">Description</label>
                            <textarea name="experience[{{ $i }}][description]" rows="3"
                                placeholder="Describe your responsibilities and achievements…"
                                class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $exp['description'] ?? '' }}</textarea>
                        </div>
                        <button type="button"
                            class="remove-entry mt-3 text-sm text-red-600 hover:text-red-800 font-medium">Remove Experience</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-experience"
                class="mt-3 text-sm text-blue-600 hover:text-blue-800 font-medium">+ Add Experience</button>
        </section>

        {{-- Education --}}
        <section class="rounded-2xl border border-gray-200 bg-white p-6 mb-6">
            <h2 class="text-base font-semibold text-gray-700 mb-4">Education</h2>
            <div id="education-list" class="space-y-4">
                @php $educations = old('education', $profile->education ?? []); @endphp
                @foreach($educations as $i => $edu)
                    <div class="education-entry border border-gray-200 rounded-xl p-4 bg-gray-50">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block mb-1 text-xs font-medium text-gray-600">Degree *</label>
                                <input type="text" name="education[{{ $i }}][degree]"
                                    value="{{ $edu['degree'] ?? '' }}"
                                    placeholder="e.g. Bachelor of Science"
                                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-medium text-gray-600">School / University *</label>
                                <input type="text" name="education[{{ $i }}][school]"
                                    value="{{ $edu['school'] ?? ($edu['institution'] ?? '') }}"
                                    placeholder="e.g. MIT"
                                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1 text-xs font-medium text-gray-600">Field of Study</label>
                            <input type="text" name="education[{{ $i }}][field_of_study]"
                                value="{{ $edu['field_of_study'] ?? '' }}"
                                placeholder="e.g. Computer Science"
                                class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block mb-1 text-xs font-medium text-gray-600">Start Date *</label>
                                <input type="date" name="education[{{ $i }}][start_date]"
                                    value="{{ $edu['start_date'] ?? '' }}"
                                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-medium text-gray-600">End Date</label>
                                <input type="date" name="education[{{ $i }}][end_date]"
                                    value="{{ $edu['end_date'] ?? '' }}"
                                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <button type="button"
                            class="remove-entry mt-3 text-sm text-red-600 hover:text-red-800 font-medium">Remove Education</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-education"
                class="mt-3 text-sm text-blue-600 hover:text-blue-800 font-medium">+ Add Education</button>
        </section>

        {{-- Certifications --}}
        <section class="rounded-2xl border border-gray-200 bg-white p-6 mb-6">
            <h2 class="text-base font-semibold text-gray-700 mb-4">Certifications</h2>
            <div id="cert-list" class="space-y-4">
                @php
                    $certs = old('certifications', $profile->certifications ?? []);
                @endphp
                @foreach($certs as $i => $cert)
                    @php
                        // Support both old string format and new object format
                        $certName    = is_array($cert) ? ($cert['name'] ?? '') : $cert;
                        $certOrg     = is_array($cert) ? ($cert['issuing_org'] ?? '') : '';
                        $certIssued  = is_array($cert) ? ($cert['issue_date'] ?? '') : '';
                        $certExpires = is_array($cert) ? ($cert['expiration_date'] ?? '') : '';
                    @endphp
                    <div class="cert-entry border border-gray-200 rounded-xl p-4 bg-gray-50">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block mb-1 text-xs font-medium text-gray-600">Certification Name *</label>
                                <input type="text" name="certifications[{{ $i }}][name]"
                                    value="{{ $certName }}"
                                    placeholder="e.g. AWS Certified Developer"
                                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-medium text-gray-600">Issuing Organization</label>
                                <input type="text" name="certifications[{{ $i }}][issuing_org]"
                                    value="{{ $certOrg }}"
                                    placeholder="e.g. Amazon Web Services"
                                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block mb-1 text-xs font-medium text-gray-600">Issue Date</label>
                                <input type="date" name="certifications[{{ $i }}][issue_date]"
                                    value="{{ $certIssued }}"
                                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block mb-1 text-xs font-medium text-gray-600">Expiration Date</label>
                                <input type="date" name="certifications[{{ $i }}][expiration_date]"
                                    value="{{ $certExpires }}"
                                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <button type="button"
                            class="remove-entry mt-3 text-sm text-red-600 hover:text-red-800 font-medium">Remove Certification</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-cert"
                class="mt-3 text-sm text-blue-600 hover:text-blue-800 font-medium">+ Add Certification</button>
        </section>

        {{-- Interests --}}
        <section class="rounded-2xl border border-gray-200 bg-white p-6 mb-6">
            <h2 class="text-base font-semibold text-gray-700 mb-4">Interests</h2>
            <div id="interests-list" class="space-y-2">
                @foreach(old('interests', $profile->interests ?? []) as $interest)
                    @if($interest !== '')
                        <div class="flex gap-2 items-center interest-row">
                            <input type="text" name="interests[]" value="{{ $interest }}"
                                class="border border-gray-300 p-2 flex-1 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="e.g. Open Source">
                            <button type="button"
                                class="remove-row shrink-0 text-red-600 hover:text-red-800 text-sm font-medium">Remove</button>
                        </div>
                    @endif
                @endforeach
            </div>
            <button type="button" id="add-interest"
                class="mt-3 text-sm text-blue-600 hover:text-blue-800 font-medium">+ Add Interest</button>
        </section>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl transition">
            {{ $profile->exists ? 'Save Changes' : 'Create Profile' }}
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // ── Generic "remove this row" handler (for skills / interests) ──
    function bindRemoveRow(btn) {
        btn.addEventListener('click', () => btn.closest('[class*="-row"]').remove());
    }
    document.querySelectorAll('.remove-row').forEach(bindRemoveRow);

    // ── Generic "remove this entry" handler (for exp / edu / cert) ──
    function bindRemoveEntry(btn) {
        btn.addEventListener('click', () => btn.closest('[class*="-entry"]').remove());
    }
    document.querySelectorAll('.remove-entry').forEach(bindRemoveEntry);

    // ── "Currently work here" toggle ──
    function bindCurrentJobCheckbox(checkbox) {
        checkbox.addEventListener('change', () => {
            const entry   = checkbox.closest('.experience-entry');
            const wrapper = entry.querySelector('.end-date-wrapper');
            const endInput = wrapper.querySelector('input[type="date"]');
            if (checkbox.checked) {
                wrapper.classList.add('hidden');
                endInput.value = '';
            } else {
                wrapper.classList.remove('hidden');
            }
        });
    }
    document.querySelectorAll('.current-job-checkbox').forEach(bindCurrentJobCheckbox);

    // ── Counters (avoid index collision after removes) ──
    let expCount  = {{ count($experiences ?? []) }};
    let eduCount  = {{ count($educations ?? []) }};
    let certCount = {{ count($certs ?? []) }};

    // ── Add Skill ──
    document.getElementById('add-skill').addEventListener('click', () => {
        const list = document.getElementById('skills-list');
        const div  = document.createElement('div');
        div.className = 'flex gap-2 items-center skill-row';
        div.innerHTML = `
            <input type="text" name="skills[]"
                class="border border-gray-300 p-2 flex-1 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="e.g. PHP">
            <button type="button" class="remove-row shrink-0 text-red-600 hover:text-red-800 text-sm font-medium">Remove</button>`;
        list.appendChild(div);
        bindRemoveRow(div.querySelector('.remove-row'));
    });

    // ── Add Interest ──
    document.getElementById('add-interest').addEventListener('click', () => {
        const list = document.getElementById('interests-list');
        const div  = document.createElement('div');
        div.className = 'flex gap-2 items-center interest-row';
        div.innerHTML = `
            <input type="text" name="interests[]"
                class="border border-gray-300 p-2 flex-1 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="e.g. Open Source">
            <button type="button" class="remove-row shrink-0 text-red-600 hover:text-red-800 text-sm font-medium">Remove</button>`;
        list.appendChild(div);
        bindRemoveRow(div.querySelector('.remove-row'));
    });

    // ── Add Experience ──
    document.getElementById('add-experience').addEventListener('click', () => {
        const idx  = expCount++;
        const list = document.getElementById('experience-list');
        const div  = document.createElement('div');
        div.className = 'experience-entry border border-gray-200 rounded-xl p-4 bg-gray-50';
        div.innerHTML = `
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-600">Job Title *</label>
                    <input type="text" name="experience[${idx}][title]" placeholder="e.g. Software Engineer"
                        class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-600">Company *</label>
                    <input type="text" name="experience[${idx}][company]" placeholder="e.g. Acme Corp"
                        class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-600">Start Date *</label>
                    <input type="date" name="experience[${idx}][start_date]"
                        class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="end-date-wrapper">
                    <label class="block mb-1 text-xs font-medium text-gray-600">End Date</label>
                    <input type="date" name="experience[${idx}][end_date]"
                        class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div class="flex items-center gap-2 mb-3">
                <input type="checkbox" name="experience[${idx}][current_job]" value="1"
                    id="current_job_${idx}" class="current-job-checkbox rounded">
                <label for="current_job_${idx}" class="text-sm text-gray-700">I currently work here</label>
            </div>
            <div>
                <label class="block mb-1 text-xs font-medium text-gray-600">Description</label>
                <textarea name="experience[${idx}][description]" rows="3"
                    placeholder="Describe your responsibilities and achievements…"
                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <button type="button" class="remove-entry mt-3 text-sm text-red-600 hover:text-red-800 font-medium">Remove Experience</button>`;
        list.appendChild(div);
        bindRemoveEntry(div.querySelector('.remove-entry'));
        bindCurrentJobCheckbox(div.querySelector('.current-job-checkbox'));
    });

    // ── Add Education ──
    document.getElementById('add-education').addEventListener('click', () => {
        const idx  = eduCount++;
        const list = document.getElementById('education-list');
        const div  = document.createElement('div');
        div.className = 'education-entry border border-gray-200 rounded-xl p-4 bg-gray-50';
        div.innerHTML = `
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-600">Degree *</label>
                    <input type="text" name="education[${idx}][degree]" placeholder="e.g. Bachelor of Science"
                        class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-600">School / University *</label>
                    <input type="text" name="education[${idx}][school]" placeholder="e.g. MIT"
                        class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-xs font-medium text-gray-600">Field of Study</label>
                <input type="text" name="education[${idx}][field_of_study]" placeholder="e.g. Computer Science"
                    class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-600">Start Date *</label>
                    <input type="date" name="education[${idx}][start_date]"
                        class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-600">End Date</label>
                    <input type="date" name="education[${idx}][end_date]"
                        class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <button type="button" class="remove-entry mt-3 text-sm text-red-600 hover:text-red-800 font-medium">Remove Education</button>`;
        list.appendChild(div);
        bindRemoveEntry(div.querySelector('.remove-entry'));
    });

    // ── Add Certification ──
    document.getElementById('add-cert').addEventListener('click', () => {
        const idx  = certCount++;
        const list = document.getElementById('cert-list');
        const div  = document.createElement('div');
        div.className = 'cert-entry border border-gray-200 rounded-xl p-4 bg-gray-50';
        div.innerHTML = `
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-600">Certification Name *</label>
                    <input type="text" name="certifications[${idx}][name]" placeholder="e.g. AWS Certified Developer"
                        class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-600">Issuing Organization</label>
                    <input type="text" name="certifications[${idx}][issuing_org]" placeholder="e.g. Amazon Web Services"
                        class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-600">Issue Date</label>
                    <input type="date" name="certifications[${idx}][issue_date]"
                        class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-600">Expiration Date</label>
                    <input type="date" name="certifications[${idx}][expiration_date]"
                        class="border border-gray-300 p-2 w-full rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <button type="button" class="remove-entry mt-3 text-sm text-red-600 hover:text-red-800 font-medium">Remove Certification</button>`;
        list.appendChild(div);
        bindRemoveEntry(div.querySelector('.remove-entry'));
    });
});
</script>
@endsection