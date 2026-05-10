@extends('layouts.standalone')

@section('content')

<style>
    .profile-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(60, 72, 88, .08);
        padding: 2.5rem 2rem;
        max-width: 900px;
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
        display: block;
    }

    .profile-input,
    .profile-textarea,
    .profile-select {
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
    .profile-textarea:focus,
    .profile-select:focus {
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
        cursor: pointer;
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
        padding: 0.5rem 1.2rem;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        transition: background 0.2s;
        cursor: pointer;
    }

    .profile-btn-add:hover {
        background: #c7d2fe;
    }

    .profile-btn-remove {
        background: #fee2e2;
        color: #b91c1c;
        border: none;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        font-weight: 500;
        transition: background 0.2s;
        cursor: pointer;
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
        min-width: 200px;
    }

    .profile-section-title {
        font-size: 1.15rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 1rem;
        letter-spacing: 0.01em;
    }

    .experience-item,
    .education-item {
        background: #f3f4f6;
        border-radius: 10px;
        padding: 1rem 1.2rem;
        margin-bottom: 1.2rem;
    }

    .date-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 0.75rem;
    }

    .date-row input {
        flex: 1;
    }

    .current-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .current-checkbox label {
        font-size: 0.85rem;
        font-weight: normal;
        color: #374151;
        cursor: pointer;
    }

    .required-star {
        color: #ef4444;
        margin-left: 2px;
    }

    .form-hint {
        font-size: 0.7rem;
        color: #6b7280;
        margin-top: -0.5rem;
        margin-bottom: 0.5rem;
    }

    /* Resume Upload Styles */
    .resume-upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #fafbfc;
    }

    .resume-upload-area:hover {
        border-color: #2563eb;
        background: #f0f9ff;
    }

    .resume-upload-area.dragover {
        border-color: #2563eb;
        background: #eff6ff;
    }

    .resume-file-input {
        display: none;
    }

    .resume-upload-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 1rem;
        color: #9ca3af;
    }

    .resume-upload-text {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .resume-file-info {
        margin-top: 1rem;
        padding: 0.75rem;
        background: #f3f4f6;
        border-radius: 8px;
        display: none;
        align-items: center;
        justify-content: space-between;
    }

    .resume-file-info.show {
        display: flex;
    }

    .resume-file-name {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #374151;
    }

    .resume-file-size {
        font-size: 0.75rem;
        color: #6b7280;
    }

    .resume-remove-btn {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        border-radius: 6px;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .resume-remove-btn:hover {
        background: #fecaca;
    }

    .current-resume {
        background: #e0e7ff;
        border-radius: 8px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .current-resume-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #3730a3;
    }

    .current-resume-btn {
        background: #c7d2fe;
        color: #3730a3;
        border: none;
        border-radius: 6px;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
    }

    .current-resume-btn:hover {
        background: #a5b4fc;
    }

    /* Resume Upload Success Message */
    .resume-success-message {
        margin-top: 0.75rem;
        padding: 0.5rem 0.75rem;
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        color: #15803d;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .resume-placeholder {
        background: #fef3c7;
        border: 1px solid #fde68a;
        border-radius: 8px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
        color: #92400e;
    }
</style>

<div class="profile-card">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">
        Complete Your Profile
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

    @if(session('resume_uploaded'))
        <div class="resume-success-message">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('resume_uploaded') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 text-red-800 p-3 mb-4 rounded">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
        action="{{ $profile->exists ? route('jobseeker.profile.update') : route('jobseeker.profile.store') }}"
        enctype="multipart/form-data">
        @csrf
        @if($profile->exists) @method('PUT') @endif

        {{-- Headline & Bio --}}
        <div class="profile-section">
            <label class="profile-label">Headline <span class="required-star">*</span></label>
            <input type="text" name="headline" value="{{ old('headline', $profile->headline ?? '') }}"
                class="profile-input" placeholder="e.g., Senior Software Developer with 5+ years experience">

            <label class="profile-label">Bio <span class="required-star">*</span></label>
            <textarea name="bio" class="profile-textarea" rows="3" placeholder="Tell us about yourself...">{{ old('bio', $profile->bio ?? '') }}</textarea>
        </div>

        {{-- Location, Phone, Website --}}
        <div class="profile-section">
            <div class="profile-flex-row">
                <div class="profile-flex-col">
                    <label class="profile-label">Location <span class="required-star">*</span></label>
                    <input type="text" name="location" value="{{ old('location', $profile->location ?? '') }}"
                        class="profile-input" placeholder="City, Country">
                </div>
                <div class="profile-flex-col">
                    <label class="profile-label">Phone <span class="required-star">*</span></label>
                    <input type="tel" name="phone" value="{{ old('phone', $profile->phone ?? '') }}"
                        class="profile-input" placeholder="Enter phone number"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
            </div>
            <div>
                <label class="profile-label">Website / Portfolio</label>
                <input type="url" name="website" value="{{ old('website', $profile->website ?? '') }}"
                    class="profile-input" placeholder="https://yourportfolio.com">
            </div>
        </div>

        {{-- Resume Upload --}}
        <div class="profile-section">
            <label class="profile-label">Resume / CV <span class="required-star">*</span></label>
            
            {{-- Show placeholder if no resume exists --}}
            @if(!($profile->exists && $profile->resume_path))
                <div class="resume-placeholder">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>No resume uploaded yet. Please upload your resume/CV.</span>
                </div>
            @endif

            @if($profile->exists && $profile->resume_path)
                <div class="current-resume">
                    <div class="current-resume-info">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Current Resume: {{ basename($profile->resume_path) }}</span>
                    </div>
                    <a href="{{ asset('storage/' . $profile->resume_path) }}" target="_blank" class="current-resume-btn">View</a>
                </div>
            @endif

            <div class="resume-upload-area" id="resumeUploadArea">
                <input type="file" name="resume" id="resumeFile" class="resume-file-input" accept=".pdf,.doc,.docx,.txt">
                <div class="resume-upload-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <div class="resume-upload-text">
                    <strong>Click to upload</strong> or drag and drop<br>
                    <span style="font-size: 0.75rem;">PDF, DOC, DOCX, TXT (Max 5MB)</span>
                </div>
            </div>

            <div class="resume-file-info" id="resumeFileInfo">
                <div class="resume-file-name">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span id="resumeFileName"></span>
                    <span class="resume-file-size" id="resumeFileSize"></span>
                </div>
                <button type="button" class="resume-remove-btn" id="removeResumeBtn">Remove</button>
            </div>
            <div class="form-hint">Upload your latest resume. This will be shared with employers when you apply.</div>
        </div>

        {{-- Skills --}}
        <div class="profile-section">
            <div class="profile-section-title">Skills <span class="required-star">*</span></div>
            <div id="skills-list">
                @foreach(old('skills', $profile->skills ?? ['']) as $skill)
                    <div class="profile-flex-row" style="align-items:center; margin-bottom:0.5rem;">
                        <input type="text" name="skills[]" value="{{ $skill }}" class="profile-input"
                            placeholder="e.g., PHP, Laravel, JavaScript">
                        <button type="button" class="remove-skill profile-btn-remove">Remove</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-skill" class="profile-btn-add">+ Add Skill</button>
        </div>

        {{-- Experiences --}}
        <div class="profile-section">
            <div class="profile-section-title">Work Experience</div>
            <div id="experiences-list">
                @foreach(old('experience', $profile->experience ?? []) as $i => $exp)
                    <div class="experience-item" data-index="{{ $i }}">
                        <input type="text" name="experience[{{ $i }}][title]" value="{{ $exp['title'] ?? '' }}"
                            class="profile-input" placeholder="Job Title *">
                        <input type="text" name="experience[{{ $i }}][company]" value="{{ $exp['company'] ?? '' }}"
                            class="profile-input" placeholder="Company Name *">
                        
                        <div class="date-row">
                            <div style="flex:1">
                                <label style="font-size:0.75rem; color:#6b7280;">Start Date</label>
                                <input type="date" name="experience[{{ $i }}][start_date]"
                                    value="{{ $exp['start_date'] ?? '' }}" class="profile-input">
                            </div>
                            <div style="flex:1">
                                <label style="font-size:0.75rem; color:#6b7280;">End Date</label>
                                <input type="date" name="experience[{{ $i }}][end_date]"
                                    value="{{ $exp['end_date'] ?? '' }}" class="profile-input" id="end_date_{{ $i }}">
                            </div>
                        </div>
                        
                        <div class="current-checkbox">
                            <input type="checkbox" class="current-check" data-index="{{ $i }}" 
                                {{ empty($exp['end_date']) ? 'checked' : '' }}>
                            <label>I currently work here</label>
                        </div>
                        
                        <textarea name="experience[{{ $i }}][description]" class="profile-textarea" rows="2"
                            placeholder="Job description...">{{ $exp['description'] ?? '' }}</textarea>
                        
                        <button type="button" class="remove-experience profile-btn-remove">Remove</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-experience" class="profile-btn-add">+ Add Experience</button>
        </div>

        {{-- Education --}}
        <div class="profile-section">
            <div class="profile-section-title">Education</div>
            <div id="education-list">
                @foreach(old('education', $profile->education ?? []) as $i => $edu)
                    <div class="education-item" data-index="{{ $i }}">
                        <div class="profile-flex-row">
                            <div class="profile-flex-col">
                                <select name="education[{{ $i }}][level]" class="profile-select">
                                    <option value="">Select Education Level</option>
                                    <option value="high_school" {{ ($edu['level'] ?? '') == 'high_school' ? 'selected' : '' }}>High School Diploma</option>
                                    <option value="associate" {{ ($edu['level'] ?? '') == 'associate' ? 'selected' : '' }}>Associate Degree</option>
                                    <option value="bachelor" {{ ($edu['level'] ?? '') == 'bachelor' ? 'selected' : '' }}>Bachelor's Degree</option>
                                    <option value="master" {{ ($edu['level'] ?? '') == 'master' ? 'selected' : '' }}>Master's Degree</option>
                                    <option value="doctorate" {{ ($edu['level'] ?? '') == 'doctorate' ? 'selected' : '' }}>Doctorate (PhD)</option>
                                    <option value="certificate" {{ ($edu['level'] ?? '') == 'certificate' ? 'selected' : '' }}>Professional Certificate</option>
                                    <option value="bootcamp" {{ ($edu['level'] ?? '') == 'bootcamp' ? 'selected' : '' }}>Bootcamp / Training</option>
                                </select>
                            </div>
                            <div class="profile-flex-col">
                                <input type="text" name="education[{{ $i }}][degree]" value="{{ $edu['degree'] ?? '' }}"
                                    class="profile-input" placeholder="Degree Name">
                            </div>
                        </div>
                        
                        <input type="text" name="education[{{ $i }}][institution]" value="{{ $edu['institution'] ?? '' }}"
                            class="profile-input" placeholder="Institution / University *">
                        
                        <input type="text" name="education[{{ $i }}][field_of_study]" value="{{ $edu['field_of_study'] ?? '' }}"
                            class="profile-input" placeholder="Field of Study">
                        
                        <div class="date-row">
                            <div style="flex:1">
                                <label style="font-size:0.75rem; color:#6b7280;">Start Date</label>
                                <input type="date" name="education[{{ $i }}][start_date]"
                                    value="{{ $edu['start_date'] ?? '' }}" class="profile-input">
                            </div>
                            <div style="flex:1">
                                <label style="font-size:0.75rem; color:#6b7280;">End Date</label>
                                <input type="date" name="education[{{ $i }}][end_date]"
                                    value="{{ $edu['end_date'] ?? '' }}" class="profile-input" id="edu_end_date_{{ $i }}">
                            </div>
                        </div>
                        
                        <div class="current-checkbox">
                            <input type="checkbox" class="current-check-edu" data-index="{{ $i }}" 
                                {{ empty($edu['end_date']) ? 'checked' : '' }}>
                            <label>Currently studying here</label>
                        </div>
                        
                        <textarea name="education[{{ $i }}][description]" class="profile-textarea" rows="2"
                            placeholder="Additional details...">{{ $edu['description'] ?? '' }}</textarea>
                        
                        <button type="button" class="remove-education profile-btn-remove">Remove</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-education" class="profile-btn-add">+ Add Education</button>
        </div>

        {{-- Certifications --}}
        <div class="profile-section">
            <div class="profile-section-title">Certifications</div>
            <div id="certifications-list">
                @foreach(old('certifications', $profile->certifications ?? []) as $cert)
                    <div class="profile-flex-row" style="align-items:center; margin-bottom:0.5rem;">
                        <input type="text" name="certifications[]" value="{{ $cert }}" class="profile-input"
                            placeholder="e.g., AWS Certified Developer">
                        <button type="button" class="remove-cert profile-btn-remove">Remove</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-cert" class="profile-btn-add">+ Add Certification</button>
        </div>

        {{-- Interests --}}
        <div class="profile-section">
            <div class="profile-section-title">Professional Interests</div>
            <div id="interests-list">
                @foreach(old('interests', $profile->interests ?? []) as $interest)
                    <div class="profile-flex-row" style="align-items:center; margin-bottom:0.5rem;">
                        <input type="text" name="interests[]" value="{{ $interest }}" class="profile-input"
                            placeholder="e.g., Cloud Computing, AI">
                        <button type="button" class="remove-interest profile-btn-remove">Remove</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-interest" class="profile-btn-add">+ Add Interest</button>
        </div>

        <button type="submit" class="profile-btn-primary">
            {{ $profile->exists ? 'Update Profile' : 'Save Profile' }}
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let expCounter = {{ count(old('experience', $profile->experience ?? [])) }};
    let eduCounter = {{ count(old('education', $profile->education ?? [])) }};

    // ==================== RESUME UPLOAD HANDLING ====================
    const resumeUploadArea = document.getElementById('resumeUploadArea');
    const resumeFileInput = document.getElementById('resumeFile');
    const resumeFileInfo = document.getElementById('resumeFileInfo');
    const resumeFileName = document.getElementById('resumeFileName');
    const resumeFileSize = document.getElementById('resumeFileSize');
    const removeResumeBtn = document.getElementById('removeResumeBtn');
    const resumePlaceholder = document.querySelector('.resume-placeholder');
    const currentResume = document.querySelector('.current-resume');

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function showSuccessMessage(fileName) {
        // Check if success message already exists
        let successMsg = document.querySelector('.resume-upload-success');
        if (successMsg) {
            successMsg.remove();
        }
        
        // Create new success message
        const msgDiv = document.createElement('div');
        msgDiv.className = 'resume-success-message resume-upload-success';
        msgDiv.innerHTML = `
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>✓ Resume "${fileName}" uploaded successfully! Ready to save.</span>
        `;
        
        // Insert after the resume file info
        const profileSection = document.querySelector('.profile-section:has(.resume-upload-area)');
        profileSection.appendChild(msgDiv);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (msgDiv) msgDiv.remove();
        }, 5000);
    }

    function updateFileDisplay(file) {
        if (file) {
            resumeFileName.textContent = file.name;
            resumeFileSize.textContent = formatFileSize(file.size);
            resumeFileInfo.classList.add('show');
            resumeUploadArea.style.display = 'none';
            
            // Hide placeholder if exists
            if (resumePlaceholder) {
                resumePlaceholder.style.display = 'none';
            }
            
            // Hide current resume if exists
            if (currentResume) {
                currentResume.style.display = 'none';
            }
            
            // Show success message
            showSuccessMessage(file.name);
            
            const submitBtn = document.querySelector('.profile-btn-primary');
            if (submitBtn) {
                const currentText = submitBtn.textContent;
                if (!currentText.includes('✓ Resume ready')) {
                    submitBtn.textContent = currentText + ' ✓ Resume ready';
                }
            }
        }
    }

    function resetUploadArea() {
        resumeFileInfo.classList.remove('show');
        resumeUploadArea.style.display = 'block';
        resumeFileInput.value = '';
        
        // Show placeholder if exists and no resume in database
        if (resumePlaceholder && !currentResume) {
            resumePlaceholder.style.display = 'flex';
        }
        
        // Show current resume if exists
        if (currentResume) {
            currentResume.style.display = 'flex';
        }
        
        // Remove success message
        const successMsg = document.querySelector('.resume-upload-success');
        if (successMsg) {
            successMsg.remove();
        }
        
        const submitBtn = document.querySelector('.profile-btn-primary');
        if (submitBtn) {
            let originalText = submitBtn.textContent.replace(' ✓ Resume ready', '');
            submitBtn.textContent = originalText;
        }
    }

    resumeFileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const validExtensions = ['.pdf', '.doc', '.docx', '.txt'];
            const fileName = file.name.toLowerCase();
            const isValidExtension = validExtensions.some(ext => fileName.endsWith(ext));
            
            if (isValidExtension) {
                if (file.size <= 5 * 1024 * 1024) {
                    updateFileDisplay(file);
                } else {
                    alert('File size must be less than 5MB');
                    resetUploadArea();
                }
            } else {
                alert('Please upload PDF, DOC, DOCX, or TXT files only');
                resetUploadArea();
            }
        }
    });

    resumeUploadArea.addEventListener('click', () => {
        resumeFileInput.click();
    });

    resumeUploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        resumeUploadArea.classList.add('dragover');
    });

    resumeUploadArea.addEventListener('dragleave', () => {
        resumeUploadArea.classList.remove('dragover');
    });

    resumeUploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        resumeUploadArea.classList.remove('dragover');
        
        const file = e.dataTransfer.files[0];
        if (file) {
            const validExtensions = ['.pdf', '.doc', '.docx', '.txt'];
            const fileName = file.name.toLowerCase();
            const isValidExtension = validExtensions.some(ext => fileName.endsWith(ext));
            
            if (isValidExtension) {
                if (file.size <= 5 * 1024 * 1024) {
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    resumeFileInput.files = dataTransfer.files;
                    updateFileDisplay(file);
                } else {
                    alert('File size must be less than 5MB');
                }
            } else {
                alert('Please upload PDF, DOC, DOCX, or TXT files only');
            }
        }
    });

    if (removeResumeBtn) {
        removeResumeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            resetUploadArea();
        });
    }

    if (resumeFileInput.files.length > 0) {
        updateFileDisplay(resumeFileInput.files[0]);
    }

    // Skills
    document.getElementById('add-skill')?.addEventListener('click', () => {
        const list = document.getElementById('skills-list');
        const div = document.createElement('div');
        div.classList.add('profile-flex-row');
        div.style.alignItems = 'center';
        div.style.marginBottom = '0.5rem';
        div.innerHTML = `
            <input type="text" name="skills[]" class="profile-input" placeholder="e.g., PHP, Laravel">
            <button type="button" class="remove-skill profile-btn-remove">Remove</button>`;
        list.appendChild(div);
        div.querySelector('.remove-skill').addEventListener('click', () => div.remove());
    });

    document.querySelectorAll('.remove-skill').forEach(btn => {
        btn.addEventListener('click', () => btn.closest('.profile-flex-row')?.remove());
    });

    // Certifications
    document.getElementById('add-cert')?.addEventListener('click', () => {
        const list = document.getElementById('certifications-list');
        const div = document.createElement('div');
        div.classList.add('profile-flex-row');
        div.style.alignItems = 'center';
        div.style.marginBottom = '0.5rem';
        div.innerHTML = `
            <input type="text" name="certifications[]" class="profile-input" placeholder="e.g., AWS Certified">
            <button type="button" class="remove-cert profile-btn-remove">Remove</button>`;
        list.appendChild(div);
        div.querySelector('.remove-cert').addEventListener('click', () => div.remove());
    });

    document.querySelectorAll('.remove-cert').forEach(btn => {
        btn.addEventListener('click', () => btn.closest('.profile-flex-row')?.remove());
    });

    // Interests
    document.getElementById('add-interest')?.addEventListener('click', () => {
        const list = document.getElementById('interests-list');
        const div = document.createElement('div');
        div.classList.add('profile-flex-row');
        div.style.alignItems = 'center';
        div.style.marginBottom = '0.5rem';
        div.innerHTML = `
            <input type="text" name="interests[]" class="profile-input" placeholder="e.g., Web Development">
            <button type="button" class="remove-interest profile-btn-remove">Remove</button>`;
        list.appendChild(div);
        div.querySelector('.remove-interest').addEventListener('click', () => div.remove());
    });

    document.querySelectorAll('.remove-interest').forEach(btn => {
        btn.addEventListener('click', () => btn.closest('.profile-flex-row')?.remove());
    });

    // Experience
    document.getElementById('add-experience')?.addEventListener('click', () => {
        const list = document.getElementById('experiences-list');
        const div = document.createElement('div');
        div.classList.add('experience-item');
        div.innerHTML = `
            <input type="text" name="experience[${expCounter}][title]" class="profile-input" placeholder="Job Title *">
            <input type="text" name="experience[${expCounter}][company]" class="profile-input" placeholder="Company Name *">
            <div class="date-row">
                <div style="flex:1">
                    <label style="font-size:0.75rem; color:#6b7280;">Start Date</label>
                    <input type="date" name="experience[${expCounter}][start_date]" class="profile-input">
                </div>
                <div style="flex:1">
                    <label style="font-size:0.75rem; color:#6b7280;">End Date</label>
                    <input type="date" name="experience[${expCounter}][end_date]" class="profile-input" id="end_date_${expCounter}">
                </div>
            </div>
            <div class="current-checkbox">
                <input type="checkbox" class="current-check" data-index="${expCounter}">
                <label>I currently work here</label>
            </div>
            <textarea name="experience[${expCounter}][description]" class="profile-textarea" rows="2" placeholder="Job description..."></textarea>
            <button type="button" class="remove-experience profile-btn-remove">Remove</button>`;
        list.appendChild(div);
        
        const checkbox = div.querySelector('.current-check');
        const endDate = div.querySelector(`#end_date_${expCounter}`);
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                endDate.value = '';
                endDate.disabled = true;
            } else {
                endDate.disabled = false;
            }
        });
        
        div.querySelector('.remove-experience').addEventListener('click', () => div.remove());
        expCounter++;
    });

    document.querySelectorAll('.current-check').forEach(checkbox => {
        const index = checkbox.dataset.index;
        const endDate = document.getElementById(`end_date_${index}`);
        if (checkbox.checked && endDate) {
            endDate.disabled = true;
        }
        checkbox.addEventListener('change', function() {
            const endDateInput = document.getElementById(`end_date_${this.dataset.index}`);
            if (this.checked) {
                if (endDateInput) {
                    endDateInput.value = '';
                    endDateInput.disabled = true;
                }
            } else {
                if (endDateInput) {
                    endDateInput.disabled = false;
                }
            }
        });
    });

    // Education
    document.getElementById('add-education')?.addEventListener('click', () => {
        const list = document.getElementById('education-list');
        const div = document.createElement('div');
        div.classList.add('education-item');
        div.innerHTML = `
            <div class="profile-flex-row">
                <div class="profile-flex-col">
                    <select name="education[${eduCounter}][level]" class="profile-select">
                        <option value="">Select Education Level</option>
                        <option value="high_school">High School Diploma</option>
                        <option value="associate">Associate Degree</option>
                        <option value="bachelor">Bachelor's Degree</option>
                        <option value="master">Master's Degree</option>
                        <option value="doctorate">Doctorate (PhD)</option>
                        <option value="certificate">Professional Certificate</option>
                        <option value="bootcamp">Bootcamp / Training</option>
                    </select>
                </div>
                <div class="profile-flex-col">
                    <input type="text" name="education[${eduCounter}][degree]" class="profile-input" placeholder="Degree Name">
                </div>
            </div>
            <input type="text" name="education[${eduCounter}][institution]" class="profile-input" placeholder="Institution / University *">
            <input type="text" name="education[${eduCounter}][field_of_study]" class="profile-input" placeholder="Field of Study">
            <div class="date-row">
                <div style="flex:1">
                    <label style="font-size:0.75rem; color:#6b7280;">Start Date</label>
                    <input type="date" name="education[${eduCounter}][start_date]" class="profile-input">
                </div>
                <div style="flex:1">
                    <label style="font-size:0.75rem; color:#6b7280;">End Date</label>
                    <input type="date" name="education[${eduCounter}][end_date]" class="profile-input" id="edu_end_date_${eduCounter}">
                </div>
            </div>
            <div class="current-checkbox">
                <input type="checkbox" class="current-check-edu" data-index="${eduCounter}">
                <label>Currently studying here</label>
            </div>
            <textarea name="education[${eduCounter}][description]" class="profile-textarea" rows="2" placeholder="Additional details..."></textarea>
            <button type="button" class="remove-education profile-btn-remove">Remove</button>`;
        list.appendChild(div);
        
        const checkbox = div.querySelector('.current-check-edu');
        const endDate = div.querySelector(`#edu_end_date_${eduCounter}`);
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                endDate.value = '';
                endDate.disabled = true;
            } else {
                endDate.disabled = false;
            }
        });
        
        div.querySelector('.remove-education').addEventListener('click', () => div.remove());
        eduCounter++;
    });

    document.querySelectorAll('.current-check-edu').forEach(checkbox => {
        const index = checkbox.dataset.index;
        const endDate = document.getElementById(`edu_end_date_${index}`);
        if (checkbox.checked && endDate) {
            endDate.disabled = true;
        }
        checkbox.addEventListener('change', function() {
            const endDateInput = document.getElementById(`edu_end_date_${this.dataset.index}`);
            if (this.checked) {
                if (endDateInput) {
                    endDateInput.value = '';
                    endDateInput.disabled = true;
                }
            } else {
                if (endDateInput) {
                    endDateInput.disabled = false;
                }
            }
        });
    });

    document.querySelectorAll('.remove-experience').forEach(btn => {
        btn.addEventListener('click', () => btn.closest('.experience-item')?.remove());
    });
    
    document.querySelectorAll('.remove-education').forEach(btn => {
        btn.addEventListener('click', () => btn.closest('.education-item')?.remove());
    });
});
</script>
@endsection