@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Main Card --}}
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

                {{-- Header --}}
                <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-white">Edit Profile</h1>
                            <p class="text-indigo-100 text-sm mt-1">Update your professional information</p>
                        </div>
                        <div class="hidden sm:block">
                            <svg class="w-12 h-12 text-white opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('jobseeker.profile.update') }}" enctype="multipart/form-data" id="profile-form">
                    @csrf
                    @method('PUT')

                    <div class="p-6 md:p-8 space-y-8">

                        {{-- Basic Information Section --}}
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h2 class="text-lg font-semibold text-gray-800">Basic Information</h2>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Headline</label>
                                    <input type="text" name="headline" value="{{ old('headline', $profile->headline) }}"
                                        placeholder="e.g., Senior Software Engineer | Laravel Specialist"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                                    <p class="text-xs text-gray-400 mt-1">A short professional tagline</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Location</label>
                                    <input type="text" name="location" value="{{ old('location', $profile->location) }}"
                                        placeholder="e.g., New York, NY"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Phone Number</label>
                                    <input type="tel" name="phone" value="{{ old('phone', $profile->phone) }}"
                                        placeholder="+1 234 567 8900"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Website / Portfolio</label>
                                    <input type="url" name="website" value="{{ old('website', $profile->website) }}"
                                        placeholder="https://linkedin.com/in/username"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                                    <p class="text-xs text-gray-400 mt-1">LinkedIn, GitHub, or personal website</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Bio</label>
                                    <textarea name="bio" rows="3" placeholder="Tell us about your professional background, achievements, and career goals..."
                                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">{{ old('bio', $profile->bio) }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Skills Section --}}
                        <div class="border-t border-gray-100 pt-6">
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <h2 class="text-lg font-semibold text-gray-800">Skills</h2>
                                <span class="text-xs text-gray-400 ml-2">Add your key competencies</span>
                            </div>
                            <div class="bg-gray-50 rounded-xl border border-gray-100 p-5">
                                <div class="flex flex-wrap gap-2 mb-4" id="skills-container">
                                    @foreach($profile->skills ?? [] as $skill)
                                        <span class="skill-tag bg-gradient-to-r from-indigo-50 to-purple-50 text-indigo-700 px-3 py-1.5 rounded-full text-sm inline-flex items-center gap-2 shadow-sm">
                                            {{ $skill }}
                                            <button type="button" onclick="removeSkill(this)" class="hover:text-red-500 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endforeach
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" id="new-skill" placeholder="Type a skill and press Enter or click Add"
                                        class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                    <button type="button" onclick="addSkill()"
                                        class="bg-purple-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-purple-700 transition-all duration-200 shadow-sm">
                                        + Add
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="skills" id="skills-input" value='@json($profile->skills ?? [])'>
                        </div>

                        {{-- Certifications Section --}}
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <h2 class="text-lg font-semibold text-gray-800">Certifications</h2>
                                <span class="text-xs text-gray-400 ml-2">Professional credentials</span>
                            </div>
                            <div class="bg-gray-50 rounded-xl border border-gray-100 p-5">
                                <div class="flex flex-wrap gap-2 mb-4" id="certifications-container">
                                    @foreach($profile->certifications ?? [] as $cert)
                                        <span class="cert-tag bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-full text-sm inline-flex items-center gap-2 shadow-sm">
                                            {{ $cert }}
                                            <button type="button" onclick="removeCertification(this)" class="hover:text-red-500 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endforeach
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" id="new-certification" placeholder="e.g., AWS Certified Developer, Laravel Certified"
                                        class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    <button type="button" onclick="addCertification()"
                                        class="bg-emerald-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-emerald-700 transition-all duration-200 shadow-sm">
                                        + Add
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="certifications" id="certifications-input" value='@json($profile->certifications ?? [])'>
                        </div>

                        {{-- Interests Section --}}
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <h2 class="text-lg font-semibold text-gray-800">Professional Interests</h2>
                                <span class="text-xs text-gray-400 ml-2">Topics you're passionate about</span>
                            </div>
                            <div class="bg-gray-50 rounded-xl border border-gray-100 p-5">
                                <div class="flex flex-wrap gap-2 mb-4" id="interests-container">
                                    @foreach($profile->interests ?? [] as $interest)
                                        <span class="interest-tag bg-amber-50 text-amber-700 px-3 py-1.5 rounded-full text-sm inline-flex items-center gap-2 shadow-sm">
                                            {{ $interest }}
                                            <button type="button" onclick="removeInterest(this)" class="hover:text-red-500 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endforeach
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" id="new-interest" placeholder="e.g., AI, Cloud Computing, Open Source"
                                        class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                    <button type="button" onclick="addInterest()"
                                        class="bg-amber-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-amber-700 transition-all duration-200 shadow-sm">
                                        + Add
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="interests" id="interests-input" value='@json($profile->interests ?? [])'>
                        </div>

                        {{-- Resume Upload Section --}}
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h2 class="text-lg font-semibold text-gray-800">Resume / CV</h2>
                            </div>
                            <div class="bg-gray-50 rounded-xl border border-gray-100 p-5">
                                @if($profile->resume_path)
                                    <div class="flex items-center justify-between mb-4 p-3 bg-white rounded-lg border border-gray-200">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-700">Current resume</p>
                                                <p class="text-xs text-gray-400">{{ basename($profile->resume_path) }}</p>
                                            </div>
                                        </div>
                                        <button type="button" onclick="document.getElementById('resume').click()" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                                            Replace
                                        </button>
                                    </div>
                                @endif
                                <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx" class="hidden">
                                <button type="button" onclick="document.getElementById('resume').click()"
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white border border-gray-300 text-gray-700 px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    {{ $profile->resume_path ? 'Upload New Resume' : 'Upload Resume' }}
                                </button>
                                <p class="text-xs text-gray-400 mt-3">PDF, DOC, or DOCX format (Max 2MB)</p>
                            </div>
                        </div>

                        {{-- Work Experience Section --}}
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <h2 class="text-lg font-semibold text-gray-800">Work Experience</h2>
                                </div>
                                <button type="button" onclick="addExperience()"
                                    class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Add Experience
                                </button>
                            </div>
                            <div id="experience-list" class="space-y-4">
                                @foreach($profile->experience ?? [] as $index => $exp)
                                    <div class="experience-entry bg-gray-50 rounded-xl border border-gray-100 p-5">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <input type="text" name="experience[{{ $index }}][title]" value="{{ $exp['title'] ?? '' }}"
                                                placeholder="Job Title" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                                            <input type="text" name="experience[{{ $index }}][company]" value="{{ $exp['company'] ?? '' }}"
                                                placeholder="Company" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                                            <input type="date" name="experience[{{ $index }}][start_date]" value="{{ $exp['start_date'] ?? '' }}"
                                                placeholder="Start Date" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                                            <input type="date" name="experience[{{ $index }}][end_date]" value="{{ $exp['end_date'] ?? '' }}"
                                                placeholder="End Date" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                                        </div>
                                        <button type="button" onclick="removeExperience(this)"
                                            class="mt-3 text-red-500 text-sm hover:text-red-600 transition-colors">
                                            Remove
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Education Section --}}
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    </svg>
                                    <h2 class="text-lg font-semibold text-gray-800">Education</h2>
                                </div>
                                <button type="button" onclick="addEducation()"
                                    class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Add Education
                                </button>
                            </div>
                            <div id="education-list" class="space-y-4">
                                @foreach($profile->education ?? [] as $index => $edu)
                                    <div class="education-entry bg-gray-50 rounded-xl border border-gray-100 p-5">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <input type="text" name="education[{{ $index }}][degree]" value="{{ $edu['degree'] ?? '' }}"
                                                placeholder="Degree" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                                            <input type="text" name="education[{{ $index }}][institution]" value="{{ $edu['institution'] ?? '' }}"
                                                placeholder="Institution" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                                            <input type="date" name="education[{{ $index }}][start_date]" value="{{ $edu['start_date'] ?? '' }}"
                                                placeholder="Start Date" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                                            <input type="date" name="education[{{ $index }}][end_date]" value="{{ $edu['end_date'] ?? '' }}"
                                                placeholder="End Date" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                                        </div>
                                        <button type="button" onclick="removeEducation(this)"
                                            class="mt-3 text-red-500 text-sm hover:text-red-600 transition-colors">
                                            Remove
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="border-t border-gray-100 bg-gray-50 px-6 md:px-8 py-5 flex flex-col sm:flex-row justify-end gap-3">
                        <a href="{{ route('jobseeker.profile.show') }}"
                            class="px-6 py-2.5 text-center text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 font-medium">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 text-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-medium shadow-md">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Skills handling
        let skills = @json($profile->skills ?? []);

        function updateSkillsInput() {
            document.getElementById('skills-input').value = JSON.stringify(skills);
        }

        function addSkill() {
            const input = document.getElementById('new-skill');
            const skill = input.value.trim();
            if (skill && !skills.includes(skill)) {
                skills.push(skill);
                renderSkills();
                input.value = '';
                updateSkillsInput();
            }
        }

        function removeSkill(btn) {
            const span = btn.parentElement;
            const skill = span.childNodes[0].textContent.trim();
            skills = skills.filter(s => s !== skill);
            renderSkills();
            updateSkillsInput();
        }

        function renderSkills() {
            const container = document.getElementById('skills-container');
            if (!container) return;
            container.innerHTML = '';
            skills.forEach(skill => {
                const span = document.createElement('span');
                span.className = 'skill-tag bg-gradient-to-r from-indigo-50 to-purple-50 text-indigo-700 px-3 py-1.5 rounded-full text-sm inline-flex items-center gap-2 shadow-sm';
                span.innerHTML = `${skill} <button type="button" onclick="removeSkill(this)" class="hover:text-red-500 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>`;
                container.appendChild(span);
            });
        }

        // Certifications handling
        let certifications = @json($profile->certifications ?? []);

        function updateCertificationsInput() {
            document.getElementById('certifications-input').value = JSON.stringify(certifications);
        }

        function addCertification() {
            const input = document.getElementById('new-certification');
            const cert = input.value.trim();
            if (cert && !certifications.includes(cert)) {
                certifications.push(cert);
                renderCertifications();
                input.value = '';
                updateCertificationsInput();
            }
        }

        function removeCertification(btn) {
            const span = btn.parentElement;
            const cert = span.childNodes[0].textContent.trim();
            certifications = certifications.filter(c => c !== cert);
            renderCertifications();
            updateCertificationsInput();
        }

        function renderCertifications() {
            const container = document.getElementById('certifications-container');
            if (!container) return;
            container.innerHTML = '';
            certifications.forEach(cert => {
                const span = document.createElement('span');
                span.className = 'cert-tag bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-full text-sm inline-flex items-center gap-2 shadow-sm';
                span.innerHTML = `${cert} <button type="button" onclick="removeCertification(this)" class="hover:text-red-500 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>`;
                container.appendChild(span);
            });
        }

        // Interests handling
        let interests = @json($profile->interests ?? []);

        function updateInterestsInput() {
            document.getElementById('interests-input').value = JSON.stringify(interests);
        }

        function addInterest() {
            const input = document.getElementById('new-interest');
            const interest = input.value.trim();
            if (interest && !interests.includes(interest)) {
                interests.push(interest);
                renderInterests();
                input.value = '';
                updateInterestsInput();
            }
        }

        function removeInterest(btn) {
            const span = btn.parentElement;
            const interest = span.childNodes[0].textContent.trim();
            interests = interests.filter(i => i !== interest);
            renderInterests();
            updateInterestsInput();
        }

        function renderInterests() {
            const container = document.getElementById('interests-container');
            if (!container) return;
            container.innerHTML = '';
            interests.forEach(interest => {
                const span = document.createElement('span');
                span.className = 'interest-tag bg-amber-50 text-amber-700 px-3 py-1.5 rounded-full text-sm inline-flex items-center gap-2 shadow-sm';
                span.innerHTML = `${interest} <button type="button" onclick="removeInterest(this)" class="hover:text-red-500 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>`;
                container.appendChild(span);
            });
        }

        // Experience handling
        let expIndex = {{ count($profile->experience ?? []) }};

        function addExperience() {
            const container = document.getElementById('experience-list');
            const div = document.createElement('div');
            div.className = 'experience-entry bg-gray-50 rounded-xl border border-gray-100 p-5';
            div.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="experience[${expIndex}][title]" placeholder="Job Title" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    <input type="text" name="experience[${expIndex}][company]" placeholder="Company" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    <input type="date" name="experience[${expIndex}][start_date]" placeholder="Start Date" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    <input type="date" name="experience[${expIndex}][end_date]" placeholder="End Date" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>
                <button type="button" onclick="removeExperience(this)" class="mt-3 text-red-500 text-sm hover:text-red-600 transition-colors">Remove</button>
            `;
            container.appendChild(div);
            expIndex++;
        }

        function removeExperience(btn) {
            btn.parentElement.remove();
        }

        // Education handling
        let eduIndex = {{ count($profile->education ?? []) }};

        function addEducation() {
            const container = document.getElementById('education-list');
            const div = document.createElement('div');
            div.className = 'education-entry bg-gray-50 rounded-xl border border-gray-100 p-5';
            div.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="education[${eduIndex}][degree]" placeholder="Degree" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    <input type="text" name="education[${eduIndex}][institution]" placeholder="Institution" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    <input type="date" name="education[${eduIndex}][start_date]" placeholder="Start Date" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    <input type="date" name="education[${eduIndex}][end_date]" placeholder="End Date" class="border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>
                <button type="button" onclick="removeEducation(this)" class="mt-3 text-red-500 text-sm hover:text-red-600 transition-colors">Remove</button>
            `;
            container.appendChild(div);
            eduIndex++;
        }

        function removeEducation(btn) {
            btn.parentElement.remove();
        }

        // Initialize all renders
        document.addEventListener('DOMContentLoaded', function() {
            renderSkills();
            renderCertifications();
            renderInterests();
            updateSkillsInput();
            updateCertificationsInput();
            updateInterestsInput();
        });

        // Update hidden inputs before submit
        document.getElementById('profile-form').addEventListener('submit', function(e) {
            document.getElementById('skills-input').value = JSON.stringify(skills);
            document.getElementById('certifications-input').value = JSON.stringify(certifications);
            document.getElementById('interests-input').value = JSON.stringify(interests);
        });
    </script>
</div>
@endsection