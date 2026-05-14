@extends('layouts.app')

@section('title', isset($job) ? 'Edit Job' : 'Create Job')

@section('content')
    <style>
        /* ============================================================
           PAGE CONTAINER
        ============================================================ */
        .full-page-container {
            min-height: 100vh;
            background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
            padding: 2rem 0;
        }

        .content-wrapper {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* ============================================================
           PAGE HEADER
        ============================================================ */
        .page-header {
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 4px;
            line-height: 1.2;
        }

        .page-sub {
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0;
        }

        /* ============================================================
           BUTTONS
        ============================================================ */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #10b981;
            color: #fff;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
            white-space: nowrap;
            gap: 8px;
            width: 100%;
        }

        .btn-primary:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #6b7280;
            color: #fff;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.15s;
            white-space: nowrap;
            gap: 8px;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            color: #2563eb;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.15s;
            margin-bottom: 20px;
        }

        .btn-back:hover {
            background: #eff6ff;
        }

        /* ============================================================
           FORM CARD
        ============================================================ */
        .form-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            background: linear-gradient(135deg, #f8fafc 0%, #fff 100%);
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title svg {
            width: 20px;
            height: 20px;
        }

        .card-body {
            padding: 28px;
        }

        .card-footer {
            padding: 20px 28px;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }

        /* ============================================================
           FORM STYLES
        ============================================================ */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-label span {
            color: #ef4444;
            margin-left: 2px;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 0.875rem;
            color: #374151;
            transition: all 0.15s;
            background: #fff;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-input.error,
        .form-textarea.error,
        .form-select.error {
            border-color: #ef4444;
        }

        .form-error {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 4px;
        }

        .form-hint {
            color: #9ca3af;
            font-size: 0.75rem;
            margin-top: 4px;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* ============================================================
           RESPONSIVE DESIGN
        ============================================================ */

        /* Tablet (768px and below) */
        @media (max-width: 768px) {
            .full-page-container {
                padding: 1rem 0;
            }

            .content-wrapper {
                padding: 0 1rem;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .page-sub {
                font-size: 0.75rem;
            }

            .card-header {
                padding: 16px 20px;
            }

            .card-body {
                padding: 20px;
            }

            .card-footer {
                padding: 16px 20px;
            }
        }

        /* Mobile (640px and below) */
        @media (max-width: 640px) {
            .full-page-container {
                padding: 0.75rem 0;
            }

            .content-wrapper {
                padding: 0 0.75rem;
            }

            .page-title {
                font-size: 1.125rem;
            }

            .page-sub {
                font-size: 0.7rem;
            }

            .btn-back {
                font-size: 0.75rem;
                padding: 6px 12px;
                margin-bottom: 16px;
            }

            .btn-back svg {
                width: 14px;
                height: 14px;
            }

            .card-header,
            .card-body,
            .card-footer {
                padding: 16px;
            }

            .card-title {
                font-size: 1rem;
            }

            .card-title svg {
                width: 18px;
                height: 18px;
            }

            .row {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-label {
                font-size: 0.8rem;
            }

            .form-input,
            .form-textarea,
            .form-select {
                padding: 8px 12px;
                font-size: 0.8125rem;
            }

            .form-textarea {
                min-height: 100px;
            }

            .form-hint {
                font-size: 0.65rem;
            }

            .btn-primary {
                padding: 10px 16px;
                font-size: 0.8125rem;
            }

            .btn-primary svg {
                width: 14px;
                height: 14px;
            }
        }

        /* Very Small Phones (480px and below) */
        @media (max-width: 480px) {
            .full-page-container {
                padding: 0.5rem 0;
            }

            .content-wrapper {
                padding: 0 0.5rem;
            }

            .page-title {
                font-size: 1rem;
            }

            .page-sub {
                font-size: 0.65rem;
            }

            .card-header,
            .card-body,
            .card-footer {
                padding: 12px;
            }

            .card-title {
                font-size: 0.9375rem;
            }

            .card-title svg {
                width: 16px;
                height: 16px;
            }

            .form-label {
                font-size: 0.75rem;
            }

            .form-input,
            .form-textarea,
            .form-select {
                padding: 7px 10px;
                font-size: 0.75rem;
            }

            .form-hint {
                font-size: 0.6rem;
            }

            .btn-primary {
                padding: 8px 14px;
                font-size: 0.75rem;
            }

            .btn-primary svg {
                width: 12px;
                height: 12px;
            }
        }
    </style>

    <div class="full-page-container">
        <div class="content-wrapper">
            <!-- Back Button -->
            <a href="{{ route('employer.jobs.index') }}" class="btn-back">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Jobs
            </a>

            <!-- Form Card -->
            <div class="form-card">
                <div class="card-header">
                    <h2 class="card-title">
                        @if(isset($job))
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Edit Job Posting
                        @else
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Create New Job Posting
                        @endif
                    </h2>
                </div>

                <form action="{{ isset($job) ? route('employer.jobs.update', $job) : route('employer.jobs.store') }}"
                    method="POST">
                    @csrf
                    @if(isset($job))
                        @method('PUT')
                    @endif

                    <div class="card-body">
                        <!-- Job Title -->
                        <div class="form-group">
                            <label class="form-label">Job Title <span>*</span></label>
                            <input type="text" name="title" value="{{ old('title', $job->title ?? '') }}"
                                class="form-input @error('title') error @enderror" required
                                placeholder="e.g., Senior Laravel Developer">
                            @error('title')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Job Description -->
                        <div class="form-group">
                            <label class="form-label">Job Description <span>*</span></label>
                            <textarea name="description" rows="8"
                                class="form-textarea @error('description') error @enderror" required
                                placeholder="Describe the role, responsibilities, and requirements...">{{ old('description', $job->description ?? '') }}</textarea>
                            @error('description')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                            <p class="form-hint">Provide a detailed description of the job, including key responsibilities
                                and qualifications.</p>
                        </div>

                        <!-- Location & Salary Row -->
                        <div class="row">
                            <div class="form-group">
                                <label class="form-label">Location <span>*</span></label>
                                <input type="text" name="location" value="{{ old('location', $job->location ?? '') }}"
                                    class="form-input @error('location') error @enderror" required
                                    placeholder="e.g., New York, NY or Remote">
                                @error('location')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Salary <span>*</span></label>
                                <input type="number" name="salary" value="{{ old('salary', $job->salary ?? '') }}"
                                    class="form-input @error('salary') error @enderror" required
                                    placeholder="e.g., 80000">
                                @error('salary')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                                <p class="form-hint">Enter annual salary in USD</p>
                            </div>
                        </div>

                        <!-- Experience Level -->
                        <div class="form-group">
                            <label class="form-label">Experience Level <span>*</span></label>
                            <select name="experience_level" class="form-select @error('experience_level') error @enderror" required>
                                <option value="">-- Select Experience Level --</option>
                                <option value="entry" {{ old('experience_level', $job->experience_level ?? '') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                                <option value="mid" {{ old('experience_level', $job->experience_level ?? '') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                                <option value="senior" {{ old('experience_level', $job->experience_level ?? '') == 'senior' ? 'selected' : '' }}>Senior Level</option>
                            </select>
                            @error('experience_level')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Required Skills -->
                        <div class="form-group">
                            <label class="form-label">Required Skills <span>*</span></label>
                            <input type="text" name="skills_required"
                                value="{{ old('skills_required', $job->skills_required ?? '') }}"
                                class="form-input @error('skills_required') error @enderror" required
                                placeholder="e.g., PHP, Laravel, MySQL, JavaScript">
                            @error('skills_required')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                            <p class="form-hint">Separate skills with commas (at least one skill required)</p>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn-primary">
                            @if(isset($job))
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Update Job Posting
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Create Job Posting
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection