@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<style>
    /* ===== PAGE CONTAINER ===== */
    .full-page-container {
        min-height: 100vh;
        background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
        padding: 1.5rem 0;
    }
    .content-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    @media (max-width: 640px) {
        .content-wrapper {
            padding: 0 1rem;
        }
    }

    /* ===== PAGE HEADER ===== */
    .page-header {
        margin-bottom: 1.5rem;
    }
    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 0.25rem;
        line-height: 1.2;
    }
    .page-sub {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0;
    }

    /* ===== FORM CARD ===== */
    .form-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        overflow: hidden;
    }
    .card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
    }
    .card-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #fff;
        margin: 0;
    }
    .card-sub {
        font-size: 0.75rem;
        color: #e0e7ff;
        margin-top: 0.25rem;
    }
    .card-body {
        padding: 1.5rem;
    }
    .card-footer {
        padding: 1rem 1.5rem;
        background: #f9fafb;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    /* ===== FORM SECTIONS ===== */
    .form-section {
        margin-bottom: 1.75rem;
        padding-bottom: 1.75rem;
        border-bottom: 1px solid #f3f4f6;
    }
    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    .section-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }
    .section-badge {
        font-size: 0.6875rem;
        color: #9ca3af;
        font-weight: normal;
    }
    .add-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.75rem;
        font-weight: 500;
        color: #2563eb;
        background: none;
        border: none;
        cursor: pointer;
        transition: color 0.15s;
    }
    .add-btn:hover {
        color: #1d4ed8;
    }

    /* ===== FORM ELEMENTS ===== */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }
    .form-input, .form-textarea, .form-select {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        color: #374151;
        transition: all 0.15s;
        background: #fff;
    }
    .form-input:focus, .form-textarea:focus, .form-select:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }
    .form-textarea {
        resize: vertical;
        min-height: 80px;
    }
    .form-hint {
        font-size: 0.6875rem;
        color: #9ca3af;
        margin-top: 0.25rem;
    }

    /* ===== TAGS CONTAINER ===== */
    .tags-container {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 1rem;
    }
    .tags-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }
    .tag {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    .tag-skill { background: #eff6ff; color: #1d4ed8; }
    .tag-cert { background: #ecfdf5; color: #047857; }
    .tag-interest { background: #fffbeb; color: #b45309; }
    .tag-remove {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        display: inline-flex;
        align-items: center;
        color: inherit;
        opacity: 0.6;
    }
    .tag-remove:hover { opacity: 1; }
    .tag-input-group {
        display: flex;
        gap: 0.5rem;
    }
    .tag-input {
        flex: 1;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        outline: none;
    }
    .tag-input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }
    .tag-btn {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.15s;
    }
    .tag-btn-skill { background: #2563eb; color: #fff; }
    .tag-btn-skill:hover { background: #1d4ed8; }
    .tag-btn-cert { background: #059669; color: #fff; }
    .tag-btn-cert:hover { background: #047857; }
    .tag-btn-interest { background: #d97706; color: #fff; }
    .tag-btn-interest:hover { background: #b45309; }

    /* ===== ENTRY CARD ===== */
    .entry-card {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 1rem;
        margin-bottom: 0.75rem;
    }
    .entry-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }
    .entry-remove {
        margin-top: 0.75rem;
        font-size: 0.75rem;
        color: #ef4444;
        background: none;
        border: none;
        cursor: pointer;
    }
    .entry-remove:hover { color: #dc2626; }

    /* ===== FILE UPLOAD ===== */
    .file-area {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 1rem;
    }
    .current-file {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.75rem;
        padding: 0.75rem;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        margin-bottom: 0.75rem;
    }
    .file-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .file-name {
        font-size: 0.75rem;
        color: #374151;
    }
    .file-size {
        font-size: 0.6875rem;
        color: #9ca3af;
    }
    .resume-success-message {
        margin-top: 0.75rem;
        padding: 0.5rem 0.75rem;
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        border-radius: 0.5rem;
        color: #15803d;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .resume-placeholder {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem;
        background: #fef3c7;
        border: 1px solid #fde68a;
        border-radius: 0.5rem;
        margin-bottom: 0.75rem;
        font-size: 0.75rem;
        color: #92400e;
    }

    /* ===== BUTTONS ===== */
    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #2563eb;
        color: #fff;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.5rem 1.25rem;
        border-radius: 0.5rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-primary:hover { background: #1d4ed8; }
    .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        color: #374151;
        font-size: 0.875rem;
        font-weight: 500;
        padding: 0.5rem 1.25rem;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-secondary:hover { background: #f9fafb; }
    .btn-upload {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #fff;
        border: 1px solid #d1d5db;
        color: #374151;
        font-size: 0.75rem;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-upload:hover { background: #f9fafb; border-color: #9ca3af; }

    /* ===== FULL WIDTH ===== */
    .full-width {
        grid-column: span 2;
    }

    .hidden {
        display: none;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 640px) {
        .form-grid {
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }
        .full-width {
            grid-column: span 1;
        }
        .entry-grid {
            grid-template-columns: 1fr;
            gap: 0.5rem;
        }
        .card-footer {
            flex-direction: column;
        }
        .card-footer .btn-primary,
        .card-footer .btn-secondary {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="full-page-container">
    <div class="content-wrapper">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Edit Profile</h1>
            <p class="page-sub">Update your professional information and preferences</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="resume-success-message" style="margin-bottom: 1rem;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Card -->
        <div class="form-card">
            <div class="card-header">
                <h2 class="card-title">Profile Information</h2>
                <p class="card-sub">Keep your profile up to date to attract the right opportunities</p>
            </div>

            <form method="POST" action="{{ route('jobseeker.profile.update') }}" enctype="multipart/form-data" id="profile-form">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <!-- Basic Information -->
                    <div class="form-section">
                        <div class="section-header">
                            <h3 class="section-title">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Basic Information
                            </h3>
                        </div>
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Headline</label>
                                <input type="text" name="headline" value="{{ old('headline', $profile->headline) }}"
                                    placeholder="e.g., Senior Software Engineer"
                                    class="form-input">
                                <p class="form-hint">A short professional tagline</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Location</label>
                                <input type="text" name="location" value="{{ old('location', $profile->location) }}"
                                    placeholder="e.g., New York, NY"
                                    class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" value="{{ old('phone', $profile->phone) }}"
                                    placeholder="+1 234 567 8900"
                                    class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Website / Portfolio</label>
                                <input type="url" name="website" value="{{ old('website', $profile->website) }}"
                                    placeholder="https://linkedin.com/in/username"
                                    class="form-input">
                                <p class="form-hint">LinkedIn, GitHub, or personal website</p>
                            </div>
                            <div class="full-width">
                                <label class="form-label">Bio</label>
                                <textarea name="bio" rows="3" placeholder="Tell us about your professional background..."
                                    class="form-textarea">{{ old('bio', $profile->bio) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Skills -->
                    <div class="form-section">
                        <div class="section-header">
                            <h3 class="section-title">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Skills
                                <span class="section-badge">Add your key competencies</span>
                            </h3>
                        </div>
                        <div class="tags-container">
                            <div class="tags-wrapper" id="skills-container">
                                @foreach($profile->skills ?? [] as $skill)
                                    <span class="tag tag-skill">
                                        {{ $skill }}
                                        <button type="button" onclick="removeSkill(this)" class="tag-remove">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </span>
                                @endforeach
                            </div>
                            <div class="tag-input-group">
                                <input type="text" id="new-skill" placeholder="Type a skill..." class="tag-input">
                                <button type="button" onclick="addSkill()" class="tag-btn tag-btn-skill">+ Add</button>
                            </div>
                        </div>
                        <input type="hidden" name="skills" id="skills-input" value='@json($profile->skills ?? [])'>
                    </div>

                    <!-- Certifications -->
                    <div class="form-section">
                        <div class="section-header">
                            <h3 class="section-title">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Certifications
                            </h3>
                        </div>
                        <div class="tags-container">
                            <div class="tags-wrapper" id="certifications-container">
                                @foreach($profile->certifications ?? [] as $cert)
                                    <span class="tag tag-cert">
                                        {{ $cert }}
                                        <button type="button" onclick="removeCertification(this)" class="tag-remove">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </span>
                                @endforeach
                            </div>
                            <div class="tag-input-group">
                                <input type="text" id="new-certification" placeholder="e.g., AWS Certified" class="tag-input">
                                <button type="button" onclick="addCertification()" class="tag-btn tag-btn-cert">+ Add</button>
                            </div>
                        </div>
                        <input type="hidden" name="certifications" id="certifications-input" value='@json($profile->certifications ?? [])'>
                    </div>

                    <!-- Interests -->
                    <div class="form-section">
                        <div class="section-header">
                            <h3 class="section-title">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                Professional Interests
                            </h3>
                        </div>
                        <div class="tags-container">
                            <div class="tags-wrapper" id="interests-container">
                                @foreach($profile->interests ?? [] as $interest)
                                    <span class="tag tag-interest">
                                        {{ $interest }}
                                        <button type="button" onclick="removeInterest(this)" class="tag-remove">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </span>
                                @endforeach
                            </div>
                            <div class="tag-input-group">
                                <input type="text" id="new-interest" placeholder="e.g., AI, Cloud Computing" class="tag-input">
                                <button type="button" onclick="addInterest()" class="tag-btn tag-btn-interest">+ Add</button>
                            </div>
                        </div>
                        <input type="hidden" name="interests" id="interests-input" value='@json($profile->interests ?? [])'>
                    </div>

                    <!-- Resume Upload -->
                    <div class="form-section">
                        <div class="section-header">
                            <h3 class="section-title">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Resume / CV
                            </h3>
                        </div>
                        <div class="file-area">
                            <!-- No Resume Placeholder -->
                            @if(!$profile->resume_path)
                                <div class="resume-placeholder" id="resumePlaceholder">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span>No resume uploaded yet. Please upload your resume/CV.</span>
                                </div>
                            @endif

                            <!-- Current Resume Display -->
                            @if($profile->resume_path)
                                <div class="current-file" id="currentResume">
                                    <div class="file-info">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">Current resume</p>
                                            <p class="file-name">{{ basename($profile->resume_path) }}</p>
                                            @if($profile->resume_size)
                                                <p class="file-size">{{ number_format($profile->resume_size / 1024, 2) }} KB</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ asset('storage/' . $profile->resume_path) }}" target="_blank" class="text-indigo-600 text-sm font-medium hover:text-indigo-800">
                                            View
                                        </a>
                                        <button type="button" onclick="document.getElementById('resume').click()" class="text-blue-600 text-sm font-medium">
                                            Replace
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <!-- Upload Success Message -->
                            <div id="uploadSuccessMessage" class="resume-success-message" style="display: none;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span id="uploadSuccessText">Resume uploaded successfully!</span>
                            </div>

                            <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx,.txt" class="hidden" onchange="handleResumeUpload(this)">
                            <button type="button" onclick="document.getElementById('resume').click()" class="btn-upload">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                {{ $profile->resume_path ? 'Upload New Resume' : 'Upload Resume' }}
                            </button>
                            <p class="form-hint mt-2">PDF, DOC, DOCX, or TXT format (Max 5MB)</p>
                        </div>
                    </div>

                    <!-- Work Experience -->
                    <div class="form-section">
                        <div class="section-header">
                            <h3 class="section-title">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Work Experience
                            </h3>
                            <button type="button" onclick="addExperience()" class="add-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Experience
                            </button>
                        </div>
                        <div id="experience-list">
                            @foreach($profile->experience ?? [] as $index => $exp)
                                <div class="entry-card experience-entry">
                                    <div class="entry-grid">
                                        <input type="text" name="experience[{{ $index }}][title]" value="{{ $exp['title'] ?? '' }}"
                                            placeholder="Job Title" class="form-input">
                                        <input type="text" name="experience[{{ $index }}][company]" value="{{ $exp['company'] ?? '' }}"
                                            placeholder="Company" class="form-input">
                                        <input type="date" name="experience[{{ $index }}][start_date]" value="{{ $exp['start_date'] ?? '' }}"
                                            placeholder="Start Date" class="form-input">
                                        <input type="date" name="experience[{{ $index }}][end_date]" value="{{ $exp['end_date'] ?? '' }}"
                                            placeholder="End Date" class="form-input">
                                    </div>
                                    <textarea name="experience[{{ $index }}][description]" rows="2" placeholder="Job description..."
                                        class="form-textarea">{{ $exp['description'] ?? '' }}</textarea>
                                    <button type="button" onclick="removeExperience(this)" class="entry-remove">
                                        Remove
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Education -->
                    <div class="form-section">
                        <div class="section-header">
                            <h3 class="section-title">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                </svg>
                                Education
                            </h3>
                            <button type="button" onclick="addEducation()" class="add-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Education
                            </button>
                        </div>
                        <div id="education-list">
                            @foreach($profile->education ?? [] as $index => $edu)
                                <div class="entry-card education-entry">
                                    <div class="entry-grid">
                                        <input type="text" name="education[{{ $index }}][degree]" value="{{ $edu['degree'] ?? '' }}"
                                            placeholder="Degree" class="form-input">
                                        <input type="text" name="education[{{ $index }}][institution]" value="{{ $edu['institution'] ?? '' }}"
                                            placeholder="Institution" class="form-input">
                                        <input type="date" name="education[{{ $index }}][start_date]" value="{{ $edu['start_date'] ?? '' }}"
                                            placeholder="Start Date" class="form-input">
                                        <input type="date" name="education[{{ $index }}][end_date]" value="{{ $edu['end_date'] ?? '' }}"
                                            placeholder="End Date" class="form-input">
                                    </div>
                                    <textarea name="education[{{ $index }}][description]" rows="2" placeholder="Additional details..."
                                        class="form-textarea">{{ $edu['description'] ?? '' }}</textarea>
                                    <button type="button" onclick="removeEducation(this)" class="entry-remove">
                                        Remove
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('jobseeker.profile.show') }}" class="btn-secondary">Cancel</a>
                    <button type="submit" class="btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Resume upload handler with success message
    function handleResumeUpload(input) {
        const file = input.files[0];
        if (file) {
            const validExtensions = ['.pdf', '.doc', '.docx', '.txt'];
            const fileName = file.name.toLowerCase();
            const isValidExtension = validExtensions.some(ext => fileName.endsWith(ext));
            
            if (isValidExtension) {
                if (file.size <= 5 * 1024 * 1024) {
                    // Hide placeholder and current resume
                    const placeholder = document.getElementById('resumePlaceholder');
                    const currentResume = document.getElementById('currentResume');
                    if (placeholder) placeholder.style.display = 'none';
                    if (currentResume) currentResume.style.display = 'none';
                    
                    // Show success message
                    const successMsg = document.getElementById('uploadSuccessMessage');
                    const successText = document.getElementById('uploadSuccessText');
                    successText.textContent = `✓ "${file.name}" (${(file.size / 1024).toFixed(2)} KB) uploaded successfully! Don't forget to save your changes.`;
                    successMsg.style.display = 'flex';
                    
                    // Auto hide after 5 seconds
                    setTimeout(() => {
                        successMsg.style.display = 'none';
                    }, 5000);
                } else {
                    alert('File size must be less than 5MB');
                    input.value = '';
                }
            } else {
                alert('Please upload PDF, DOC, DOCX, or TXT files only');
                input.value = '';
            }
        }
    }

    // Skills handling
    let skills = @json($profile->skills ?? []);
    function updateSkillsInput() { document.getElementById('skills-input').value = JSON.stringify(skills); }
    function addSkill() {
        const input = document.getElementById('new-skill');
        const skill = input.value.trim();
        if (skill && !skills.includes(skill)) { skills.push(skill); renderSkills(); input.value = ''; updateSkillsInput(); }
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
            span.className = 'tag tag-skill';
            span.innerHTML = `${skill} <button type="button" onclick="removeSkill(this)" class="tag-remove"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>`;
            container.appendChild(span);
        });
    }

    // Certifications
    let certifications = @json($profile->certifications ?? []);
    function updateCertsInput() { document.getElementById('certifications-input').value = JSON.stringify(certifications); }
    function addCertification() {
        const input = document.getElementById('new-certification');
        const cert = input.value.trim();
        if (cert && !certifications.includes(cert)) { certifications.push(cert); renderCerts(); input.value = ''; updateCertsInput(); }
    }
    function removeCertification(btn) {
        const span = btn.parentElement;
        const cert = span.childNodes[0].textContent.trim();
        certifications = certifications.filter(c => c !== cert);
        renderCerts();
        updateCertsInput();
    }
    function renderCerts() {
        const container = document.getElementById('certifications-container');
        if (!container) return;
        container.innerHTML = '';
        certifications.forEach(cert => {
            const span = document.createElement('span');
            span.className = 'tag tag-cert';
            span.innerHTML = `${cert} <button type="button" onclick="removeCertification(this)" class="tag-remove"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>`;
            container.appendChild(span);
        });
    }

    // Interests
    let interests = @json($profile->interests ?? []);
    function updateInterestsInput() { document.getElementById('interests-input').value = JSON.stringify(interests); }
    function addInterest() {
        const input = document.getElementById('new-interest');
        const interest = input.value.trim();
        if (interest && !interests.includes(interest)) { interests.push(interest); renderInterests(); input.value = ''; updateInterestsInput(); }
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
            span.className = 'tag tag-interest';
            span.innerHTML = `${interest} <button type="button" onclick="removeInterest(this)" class="tag-remove"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>`;
            container.appendChild(span);
        });
    }

    // Experience
    let expIndex = {{ count($profile->experience ?? []) }};
    function addExperience() {
        const container = document.getElementById('experience-list');
        const div = document.createElement('div');
        div.className = 'entry-card experience-entry';
        div.innerHTML = `
            <div class="entry-grid">
                <input type="text" name="experience[${expIndex}][title]" placeholder="Job Title" class="form-input">
                <input type="text" name="experience[${expIndex}][company]" placeholder="Company" class="form-input">
                <input type="date" name="experience[${expIndex}][start_date]" placeholder="Start Date" class="form-input">
                <input type="date" name="experience[${expIndex}][end_date]" placeholder="End Date" class="form-input">
            </div>
            <textarea name="experience[${expIndex}][description]" rows="2" placeholder="Job description..." class="form-textarea"></textarea>
            <button type="button" onclick="removeExperience(this)" class="entry-remove">Remove</button>
        `;
        container.appendChild(div);
        expIndex++;
    }
    function removeExperience(btn) { btn.parentElement.remove(); }

    // Education
    let eduIndex = {{ count($profile->education ?? []) }};
    function addEducation() {
        const container = document.getElementById('education-list');
        const div = document.createElement('div');
        div.className = 'entry-card education-entry';
        div.innerHTML = `
            <div class="entry-grid">
                <input type="text" name="education[${eduIndex}][degree]" placeholder="Degree" class="form-input">
                <input type="text" name="education[${eduIndex}][institution]" placeholder="Institution" class="form-input">
                <input type="date" name="education[${eduIndex}][start_date]" placeholder="Start Date" class="form-input">
                <input type="date" name="education[${eduIndex}][end_date]" placeholder="End Date" class="form-input">
            </div>
            <textarea name="education[${eduIndex}][description]" rows="2" placeholder="Additional details..." class="form-textarea"></textarea>
            <button type="button" onclick="removeEducation(this)" class="entry-remove">Remove</button>
        `;
        container.appendChild(div);
        eduIndex++;
    }
    function removeEducation(btn) { btn.parentElement.remove(); }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        renderSkills(); renderCerts(); renderInterests();
        updateSkillsInput(); updateCertsInput(); updateInterestsInput();
    });
    document.getElementById('profile-form').addEventListener('submit', function() {
        document.getElementById('skills-input').value = JSON.stringify(skills);
        document.getElementById('certifications-input').value = JSON.stringify(certifications);
        document.getElementById('interests-input').value = JSON.stringify(interests);
    });
</script>
@endsection