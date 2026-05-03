@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Edit Profile</h1>
                <p class="text-purple-100 text-sm">Keep your profile updated.</p>
            </div>

            <form method="POST" action="{{ route('jobseeker.profile.update') }}" enctype="multipart/form-data"
                class="p-6 space-y-6" id="profile-form">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Headline -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Headline</label>
                        <input type="text" name="headline" value="{{ old('headline', $profile->headline) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="location" value="{{ old('location', $profile->location) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Website / Portfolio -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">🌐 Website / Portfolio /
                            LinkedIn</label>
                        <input type="url" name="website" value="{{ old('website', $profile->website) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            placeholder="https://linkedin.com/in/username">
                        <p class="text-xs text-gray-500 mt-1">Add your portfolio, LinkedIn, or GitHub profile</p>
                    </div>

                    <!-- Bio -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                        <textarea name="bio" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">{{ old('bio', $profile->bio) }}</textarea>
                    </div>
                </div>

                <!-- Skills -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Skills</label>
                    <div class="border border-gray-300 rounded-lg p-4">
                        <div class="flex flex-wrap gap-2 mb-3" id="skills-container">
                            @foreach($profile->skills ?? [] as $index => $skill)
                                <span
                                    class="skill-tag bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm inline-flex items-center gap-2"
                                    data-index="{{ $index }}">
                                    {{ $skill }}
                                    <button type="button" onclick="removeSkill(this)"
                                        class="text-purple-500 hover:text-purple-700">✕</button>
                                </span>
                            @endforeach
                        </div>
                        <div class="flex gap-2">
                            <input type="text" id="new-skill" placeholder="Type a skill and press Enter"
                                class="flex-1 border border-gray-300 rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-purple-500">
                            <button type="button" onclick="addSkill()"
                                class="bg-purple-600 text-white px-4 py-1 rounded-lg text-sm hover:bg-purple-700">
                                + Add Skill
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="skills" id="skills-input" value='@json($profile->skills ?? [])'>
                </div>

                <!-- Certifications -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">📜 Certifications</label>
                    <div class="border border-gray-300 rounded-lg p-4">
                        <div class="flex flex-wrap gap-2 mb-3" id="certifications-container">
                            @foreach($profile->certifications ?? [] as $index => $cert)
                                <span
                                    class="cert-tag bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm inline-flex items-center gap-2"
                                    data-index="{{ $index }}">
                                    {{ $cert }}
                                    <button type="button" onclick="removeCertification(this)"
                                        class="text-green-500 hover:text-green-700">✕</button>
                                </span>
                            @endforeach
                        </div>
                        <div class="flex gap-2">
                            <input type="text" id="new-certification"
                                placeholder="e.g., AWS Certified Developer, Laravel Certified"
                                class="flex-1 border border-gray-300 rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-purple-500">
                            <button type="button" onclick="addCertification()"
                                class="bg-green-600 text-white px-4 py-1 rounded-lg text-sm hover:bg-green-700">
                                + Add Certification
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="certifications" id="certifications-input"
                        value='@json($profile->certifications ?? [])'>
                </div>

                <!-- Interests -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">⭐ Professional Interests</label>
                    <div class="border border-gray-300 rounded-lg p-4">
                        <div class="flex flex-wrap gap-2 mb-3" id="interests-container">
                            @foreach($profile->interests ?? [] as $index => $interest)
                                <span
                                    class="interest-tag bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm inline-flex items-center gap-2"
                                    data-index="{{ $index }}">
                                    {{ $interest }}
                                    <button type="button" onclick="removeInterest(this)"
                                        class="text-blue-500 hover:text-blue-700">✕</button>
                                </span>
                            @endforeach
                        </div>
                        <div class="flex gap-2">
                            <input type="text" id="new-interest" placeholder="e.g., AI, Cloud Computing, Open Source"
                                class="flex-1 border border-gray-300 rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-purple-500">
                            <button type="button" onclick="addInterest()"
                                class="bg-blue-600 text-white px-4 py-1 rounded-lg text-sm hover:bg-blue-700">
                                + Add Interest
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="interests" id="interests-input" value='@json($profile->interests ?? [])'>
                </div>

                <!-- Resume Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">📄 Resume/CV</label>
                    <div class="border border-gray-300 rounded-lg p-4">
                        @if($profile->resume_path)
                            <div class="mb-3 text-sm text-green-600">
                                ✓ Current resume: {{ basename($profile->resume_path) }}
                                <button type="button" onclick="document.getElementById('resume').click()"
                                    class="ml-3 text-blue-600 hover:text-blue-700">
                                    Replace
                                </button>
                            </div>
                        @endif
                        <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx" class="hidden">
                        <button type="button" onclick="document.getElementById('resume').click()"
                            class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-200">
                            📁 {{ $profile->resume_path ? 'Upload New Resume' : 'Upload Resume (PDF, DOC)' }}
                        </button>
                        <p class="text-xs text-gray-500 mt-2">Upload your resume in PDF, DOC, or DOCX format (Max 2MB)</p>
                    </div>
                </div>

                <!-- Experience Section -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Experience</label>
                    <div id="experience-list">
                        @foreach($profile->experience ?? [] as $index => $exp)
                            <div class="experience-entry border border-gray-200 rounded-lg p-4 mb-3">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" name="experience[{{ $index }}][title]" value="{{ $exp['title'] ?? '' }}"
                                        placeholder="Job Title" class="border rounded-lg px-3 py-2">
                                    <input type="text" name="experience[{{ $index }}][company]"
                                        value="{{ $exp['company'] ?? '' }}" placeholder="Company"
                                        class="border rounded-lg px-3 py-2">
                                    <input type="date" name="experience[{{ $index }}][start_date]"
                                        value="{{ $exp['start_date'] ?? '' }}" placeholder="Start Date"
                                        class="border rounded-lg px-3 py-2">
                                    <input type="date" name="experience[{{ $index }}][end_date]"
                                        value="{{ $exp['end_date'] ?? '' }}" placeholder="End Date"
                                        class="border rounded-lg px-3 py-2">
                                </div>
                                <button type="button" onclick="removeExperience(this)"
                                    class="text-red-500 text-sm mt-2">Remove</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addExperience()" class="text-purple-600 text-sm">+ Add
                        Experience</button>
                </div>

                <!-- Education Section -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Education</label>
                    <div id="education-list">
                        @foreach($profile->education ?? [] as $index => $edu)
                            <div class="education-entry border border-gray-200 rounded-lg p-4 mb-3">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" name="education[{{ $index }}][degree]" value="{{ $edu['degree'] ?? '' }}"
                                        placeholder="Degree" class="border rounded-lg px-3 py-2">
                                    <input type="text" name="education[{{ $index }}][institution]"
                                        value="{{ $edu['institution'] ?? '' }}" placeholder="Institution"
                                        class="border rounded-lg px-3 py-2">
                                    <input type="date" name="education[{{ $index }}][start_date]"
                                        value="{{ $edu['start_date'] ?? '' }}" placeholder="Start Date"
                                        class="border rounded-lg px-3 py-2">
                                    <input type="date" name="education[{{ $index }}][end_date]"
                                        value="{{ $edu['end_date'] ?? '' }}" placeholder="End Date"
                                        class="border rounded-lg px-3 py-2">
                                </div>
                                <button type="button" onclick="removeEducation(this)"
                                    class="text-red-500 text-sm mt-2">Remove</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addEducation()" class="text-purple-600 text-sm">+ Add Education</button>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('jobseeker.profile.show') }}"
                        class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Update
                        Profile</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Skills handling
        let skills = @json($profile->skills ?? []);

        function updateSkillsInput() {
            document.getElementById('skills-input').value = JSON.stringify(skills);
            console.log('Skills saved:', skills);
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
            skills.forEach((skill, index) => {
                const span = document.createElement('span');
                span.className = 'skill-tag bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm inline-flex items-center gap-2';
                span.innerHTML = `${skill} <button type="button" onclick="removeSkill(this)" class="text-purple-500 hover:text-purple-700">✕</button>`;
                container.appendChild(span);
            });
        }

        // Certifications handling
        let certifications = @json($profile->certifications ?? []);

        function updateCertificationsInput() {
            document.getElementById('certifications-input').value = JSON.stringify(certifications);
            console.log('Certifications saved:', certifications);
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
            certifications.forEach((cert, index) => {
                const span = document.createElement('span');
                span.className = 'cert-tag bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm inline-flex items-center gap-2';
                span.innerHTML = `${cert} <button type="button" onclick="removeCertification(this)" class="text-green-500 hover:text-green-700">✕</button>`;
                container.appendChild(span);
            });
        }

        // Interests handling
        let interests = @json($profile->interests ?? []);

        function updateInterestsInput() {
            document.getElementById('interests-input').value = JSON.stringify(interests);
            console.log('Interests saved:', interests);
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
            interests.forEach((interest, index) => {
                const span = document.createElement('span');
                span.className = 'interest-tag bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm inline-flex items-center gap-2';
                span.innerHTML = `${interest} <button type="button" onclick="removeInterest(this)" class="text-blue-500 hover:text-blue-700">✕</button>`;
                container.appendChild(span);
            });
        }

        // Experience handling
        let expIndex = {{ count($profile->experience ?? []) }};

        function addExperience() {
            const container = document.getElementById('experience-list');
            const div = document.createElement('div');
            div.className = 'experience-entry border border-gray-200 rounded-lg p-4 mb-3';
            div.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="experience[${expIndex}][title]" placeholder="Job Title" class="border rounded-lg px-3 py-2">
                        <input type="text" name="experience[${expIndex}][company]" placeholder="Company" class="border rounded-lg px-3 py-2">
                        <input type="date" name="experience[${expIndex}][start_date]" placeholder="Start Date" class="border rounded-lg px-3 py-2">
                        <input type="date" name="experience[${expIndex}][end_date]" placeholder="End Date" class="border rounded-lg px-3 py-2">
                    </div>
                    <button type="button" onclick="removeExperience(this)" class="text-red-500 text-sm mt-2">Remove</button>
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
            div.className = 'education-entry border border-gray-200 rounded-lg p-4 mb-3';
            div.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="education[${eduIndex}][degree]" placeholder="Degree" class="border rounded-lg px-3 py-2">
                        <input type="text" name="education[${eduIndex}][institution]" placeholder="Institution" class="border rounded-lg px-3 py-2">
                        <input type="date" name="education[${eduIndex}][start_date]" placeholder="Start Date" class="border rounded-lg px-3 py-2">
                        <input type="date" name="education[${eduIndex}][end_date]" placeholder="End Date" class="border rounded-lg px-3 py-2">
                    </div>
                    <button type="button" onclick="removeEducation(this)" class="text-red-500 text-sm mt-2">Remove</button>
                `;
            container.appendChild(div);
            eduIndex++;
        }

        function removeEducation(btn) {
            btn.parentElement.remove();
        }

        // Initialize all renders on page load
        document.addEventListener('DOMContentLoaded', function () {
            renderSkills();
            renderCertifications();
            renderInterests();
            updateSkillsInput();
            updateCertificationsInput();
            updateInterestsInput();
        });

        // Debug: Log form submission
        document.getElementById('profile-form').addEventListener('submit', function () {
            console.log('Submitting form with:');
            console.log('Skills:', document.getElementById('skills-input').value);
            console.log('Certifications:', document.getElementById('certifications-input').value);
            console.log('Interests:', document.getElementById('interests-input').value);
        });

        // Force update hidden inputs before form submission
        document.getElementById('profile-form').addEventListener('submit', function (e) {
            // Manually update all hidden inputs
            document.getElementById('skills-input').value = JSON.stringify(skills);
            document.getElementById('certifications-input').value = JSON.stringify(certifications);
            document.getElementById('interests-input').value = JSON.stringify(interests);

            console.log('Form submitting with:');
            console.log('Skills value:', document.getElementById('skills-input').value);
            console.log('Certifications value:', document.getElementById('certifications-input').value);
            console.log('Interests value:', document.getElementById('interests-input').value);

            // Check if any are empty
            if (document.getElementById('skills-input').value === '[]' || document.getElementById('skills-input').value === '') {
                console.error('Skills is empty!');
            }
            if (document.getElementById('certifications-input').value === '[]' || document.getElementById('certifications-input').value === '') {
                console.error('Certifications is empty!');
            }
            if (document.getElementById('interests-input').value === '[]' || document.getElementById('interests-input').value === '') {
                console.error('Interests is empty!');
            }
        });
    </script>

    <style>
        .skill-tag,
        .cert-tag,
        .interest-tag {
            transition: all 0.2s;
        }

        .skill-tag:hover,
        .cert-tag:hover,
        .interest-tag:hover {
            transform: scale(1.05);
        }
    </style>
@endsection