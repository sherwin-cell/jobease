@extends('layouts.app')

@section('title', 'Edit Job - ' . $job->title)

@section('content')
    <style>
        /* ===== PAGE CONTAINER ===== */
        .full-page-container {
            min-height: 100vh;
            background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
            padding: 2rem 0;
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

            .full-page-container {
                padding: 1rem 0;
            }
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
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

        /* ===== BUTTONS ===== */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #2563eb;
            color: #fff;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
            white-space: nowrap;
            gap: 8px;
        }

        .btn-primary:hover {
            background: #1d4ed8;
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

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            text-decoration: none;
            transition: background 0.15s;
        }

        .btn-outline:hover {
            background: #f9fafb;
        }

        /* ===== FORM CARD ===== */
        .form-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
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

        /* ===== QA SECTION ===== */
        .qa-section {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
        }

        .qa-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .qa-title {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 2px;
        }

        .qa-desc {
            font-size: 0.75rem;
            color: #6b7280;
            margin: 0;
        }

        .toggle-switch {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
        }

        .toggle-switch input {
            width: 36px;
            height: 20px;
            appearance: none;
            background: #cbd5e1;
            border-radius: 999px;
            position: relative;
            cursor: pointer;
            transition: background 0.2s;
        }

        .toggle-switch input:checked {
            background: #2563eb;
        }

        .toggle-switch input::before {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: white;
            top: 2px;
            left: 2px;
            transition: transform 0.2s;
        }

        .toggle-switch input:checked::before {
            transform: translateX(16px);
        }

        /* ===== SLOT ROW ===== */
        .slot-row {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 12px;
            margin-bottom: 12px;
            align-items: center;
        }

        .remove-slot {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 0.75rem;
            color: #ef4444;
            cursor: pointer;
            transition: all 0.15s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .remove-slot:hover {
            background: #fee2e2;
            border-color: #fecaca;
        }

        .add-slot-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 0.75rem;
            font-weight: 500;
            color: #2563eb;
            cursor: pointer;
            transition: all 0.15s;
        }

        .add-slot-btn:hover {
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        /* ===== ACTION BUTTONS ===== */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #e5e7eb;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 640px) {
            .form-card {
                padding: 16px;
            }

            .slot-row {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .qa-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn-primary,
            .action-buttons .btn-outline {
                justify-content: center;
            }

            .remove-slot {
                justify-content: center;
            }
        }
    </style>

    <div class="full-page-container">
        <div class="content-wrapper">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Job Posting</h1>
                    <p class="page-sub">Update your job details and requirements</p>
                </div>
                <a href="{{ route('employer.jobs.index') }}" class="btn-outline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Jobs
                </a>
            </div>

            <!-- Form Card -->
            <div class="form-card">
                <form method="POST" action="{{ route('employer.jobs.update', $job) }}">
                    @csrf
                    @method('PUT')

                    <!-- Job Title -->
                    <div class="form-group">
                        <label class="form-label">Job Title <span>*</span></label>
                        <input type="text" name="title" value="{{ old('title', $job->title) }}"
                            class="form-input @error('title') error @enderror" required
                            placeholder="e.g., Senior Laravel Developer">
                        @error('title')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Job Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Location -->
                        <div class="form-group">
                            <label class="form-label">Location <span>*</span></label>
                            <input type="text" name="location" value="{{ old('location', $job->location) }}"
                                class="form-input @error('location') error @enderror" required
                                placeholder="e.g., New York, NY or Remote">
                            @error('location')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Salary -->
                        <div class="form-group">
                            <label class="form-label">Salary</label>
                            <input type="text" name="salary" value="{{ old('salary', $job->salary) }}"
                                class="form-input @error('salary') error @enderror" placeholder="e.g., $80,000 - $120,000">
                            @error('salary')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Experience Level -->
                    <div class="form-group">
                        <label class="form-label">Experience Level <span>*</span></label>
                        <select name="experience_level" class="form-select @error('experience_level') error @enderror"
                            required>
                            <option value="">-- Select Experience Level --</option>
                            <option value="entry" {{ old('experience_level', $job->experience_level ?? '') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                            <option value="mid" {{ old('experience_level', $job->experience_level ?? '') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                            <option value="senior" {{ old('experience_level', $job->experience_level ?? '') == 'senior' ? 'selected' : '' }}>Senior Level</option>
                        </select>
                        @error('experience_level')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Job Description -->
                    <div class="form-group">
                        <label class="form-label">Job Description <span>*</span></label>
                        <textarea name="description" rows="8" class="form-textarea @error('description') error @enderror"
                            required
                            placeholder="Describe the role, responsibilities, and requirements...">{{ old('description', $job->description) }}</textarea>
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                        <p class="form-hint">Provide a detailed description of the job, including key responsibilities and
                            qualifications.</p>
                    </div>

                    <!-- Skills Required -->
                    <div class="form-group">
                        <label class="form-label">Skills Required</label>
                        <input type="text" name="skills_required"
                            value="{{ old('skills_required', is_array($job->skills_required) ? implode(', ', $job->skills_required) : '') }}"
                            class="form-input @error('skills_required') error @enderror"
                            placeholder="e.g., PHP, Laravel, MySQL, JavaScript">
                        <p class="form-hint">Separate skills with commas</p>
                        @error('skills_required')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button type="submit" class="btn-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Update Job
                        </button>
                        <a href="{{ route('employer.jobs.index') }}" class="btn-outline">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const toggle = document.getElementById('live-skill-qa-toggle');
            const fields = document.getElementById('live-skill-qa-fields');
            const addBtn = document.getElementById('add-live-qa-slot');
            const slots = document.getElementById('live-qa-slots');

            function syncVisibility() {
                if (!toggle || !fields) return;
                fields.style.display = toggle.checked ? 'block' : 'none';
            }

            function bindRemoveButtons() {
                if (!slots) return;
                slots.querySelectorAll('.remove-slot').forEach(btn => {
                    if (btn.dataset.bound) return;
                    btn.dataset.bound = '1';
                    btn.addEventListener('click', () => {
                        const row = btn.closest('.slot-row');
                        if (!row) return;
                        row.remove();
                    });
                });
            }

            if (toggle) toggle.addEventListener('change', syncVisibility);
            syncVisibility();
            bindRemoveButtons();

            if (addBtn && slots) {
                addBtn.addEventListener('click', () => {
                    const row = document.createElement('div');
                    row.className = 'slot-row';
                    row.innerHTML = `
                        <input type="datetime-local" name="live_skill_qa_slot_start[]" class="form-input">
                        <input type="datetime-local" name="live_skill_qa_slot_end[]" class="form-input">
                        <button type="button" class="remove-slot">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Remove
                        </button>
                    `;
                    slots.appendChild(row);
                    bindRemoveButtons();
                });
            }
        })();
    </script>
@endsection