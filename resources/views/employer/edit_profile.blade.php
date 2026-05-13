@extends('layouts.app')

@section('title', 'Company Profile')

@section('content')
@php
    $isEdit = request()->get('edit') == 1;
@endphp

<style>
    /* ============================================================
       GLOBAL ICON SIZING - ONE RULE FOR ALL ICONS
    ============================================================ */
    svg {
        width: 20px;
        height: 20px;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    /* ============================================================
       PAGE CONTAINER
    ============================================================ */
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

    .btn-success {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #10b981;
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

    .btn-success:hover {
        background: #059669;
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

    /* ============================================================
       ALERTS
    ============================================================ */
    .alert-success {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #15803d;
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.875rem;
    }

    .alert-error {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.875rem;
    }

    .alert-list {
        list-style: disc;
        padding-left: 20px;
        margin: 0;
    }

    /* ============================================================
       PROFILE CARD
    ============================================================ */
    .profile-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        overflow: hidden;
        transition: box-shadow 0.2s;
    }

    .profile-card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
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

    .card-body {
        padding: 24px;
    }

    .card-footer {
        padding: 16px 24px;
        background: #f9fafb;
        border-top: 1px solid #e5e7eb;
    }

    /* ============================================================
       INFO GRID - VIEW MODE
    ============================================================ */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .info-item-full {
        grid-column: span 2;
    }

    .info-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .info-value {
        font-size: 0.9375rem;
        font-weight: 500;
        color: #111827;
        word-break: break-word;
    }

    .info-value a {
        color: #2563eb;
        text-decoration: none;
    }

    .info-value a:hover {
        text-decoration: underline;
    }

    .empty-value {
        color: #9ca3af;
        font-style: italic;
        font-weight: normal;
    }

    .description-text {
        font-size: 0.875rem;
        color: #4b5563;
        line-height: 1.6;
        white-space: pre-line;
        margin: 0;
    }

    /* ============================================================
       FORM STYLES - EDIT MODE
    ============================================================ */
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

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        font-size: 0.875rem;
        color: #374151;
        transition: all 0.15s;
        background: #fff;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
        font-family: inherit;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    /* ============================================================
       BUSINESS PERMIT SECTION
    ============================================================ */
    .permit-section {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #e5e7eb;
    }

    .current-file {
        background: #e0e7ff;
        border-radius: 12px;
        padding: 12px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .current-file-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.8rem;
        color: #3730a3;
        word-break: break-all;
        flex: 1;
    }

    .current-file-btn {
        background: #c7d2fe;
        color: #3730a3;
        border: none;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 0.7rem;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .current-file-btn:hover {
        background: #a5b4fc;
    }

    .permit-note {
        font-size: 0.7rem;
        color: #6b7280;
        margin-top: 8px;
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

        .info-grid {
            gap: 16px;
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

        .page-header {
            margin-bottom: 16px;
        }

        .page-title {
            font-size: 1.125rem;
        }

        .page-sub {
            font-size: 0.7rem;
        }

        /* Card padding */
        .card-header,
        .card-body,
        .card-footer {
            padding: 16px;
        }

        .card-title {
            font-size: 1rem;
        }

        /* Info grid - single column on mobile */
        .info-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .info-item-full {
            grid-column: span 1;
        }

        .info-label {
            font-size: 0.65rem;
        }

        .info-value {
            font-size: 0.875rem;
        }

        .description-text {
            font-size: 0.8125rem;
        }

        /* Buttons full width on mobile */
        .btn-primary,
        .btn-success,
        .btn-secondary {
            width: 100%;
            justify-content: center;
            padding: 10px 16px;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            font-size: 0.8rem;
        }

        .form-input,
        .form-textarea {
            padding: 8px 12px;
            font-size: 0.8125rem;
        }

        /* Alert messages */
        .alert-success,
        .alert-error {
            padding: 10px 14px;
            font-size: 0.75rem;
        }

        /* Current file section */
        .current-file {
            flex-direction: column;
            align-items: flex-start;
        }

        .current-file-info {
            width: 100%;
        }

        .current-file-btn {
            width: 100%;
            justify-content: center;
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

        .info-value {
            font-size: 0.8125rem;
        }

        .btn-primary,
        .btn-success,
        .btn-secondary {
            padding: 8px 14px;
            font-size: 0.75rem;
        }

        .form-input,
        .form-textarea {
            padding: 7px 10px;
            font-size: 0.75rem;
        }

        .current-file-info {
            font-size: 0.7rem;
        }
    }
</style>

<div class="full-page-container">
    <div class="content-wrapper">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Company Profile</h1>
            <p class="page-sub">View and update your company information</p>
        </div>

        <!-- Error Alerts -->
        @if ($errors->any())
        <div class="alert-error">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <ul class="alert-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <!-- Success Alert -->
        @if (session('success'))
        <div class="alert-success">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- ================= VIEW MODE ================= -->
        @if (!$isEdit)
        <div class="profile-card">
            <div class="card-header">
                <h2 class="card-title">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Company Information
                </h2>
            </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Company Name
                        </span>
                        <span class="info-value">{{ $company->company_name ?? '<span class="empty-value">Not set</span>' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Location
                        </span>
                        <span class="info-value">{{ $company->location ?? '<span class="empty-value">Not set</span>' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Phone
                        </span>
                        <span class="info-value">{{ $company->phone ?? '<span class="empty-value">Not set</span>' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.66 0 3-4 3-9s-1.34-9-3-9m0 18c-1.66 0-3-4-3-9s1.34-9 3-9" />
                            </svg>
                            Website
                        </span>
                        <span class="info-value">
                            @if ($company->website)
                                <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                            @else
                                <span class="empty-value">Not set</span>
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Description - Full width -->
                <div class="info-item info-item-full" style="margin-top: 8px;">
                    <span class="info-label">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        Description
                    </span>
                    <p class="description-text">{{ $company->description ?? '<span class="empty-value">Not set</span>' }}</p>
                </div>

                <!-- Business Permit Section -->
                <div class="permit-section">
                    <div class="info-item info-item-full">
                        <span class="info-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Business Permit
                        </span>
                        <span class="info-value">
                            @if($company->business_permit_path ?? false)
                                <div class="current-file" style="margin-top: 8px;">
                                    <div class="current-file-info">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span>Current file: {{ basename($company->business_permit_path) }}</span>
                                    </div>
                                    <a href="{{ Storage::url($company->business_permit_path) }}" target="_blank" class="current-file-btn">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View
                                    </a>
                                </div>
                            @else
                                <span class="empty-value">No business permit uploaded</span>
                            @endif
                        </span>
                        <p class="permit-note">Your business permit is used for verification purposes.</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ url()->current() }}?edit=1" class="btn-primary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit Profile
                </a>
            </div>
        </div>
        @endif

        <!-- ================= EDIT MODE ================= -->
        @if ($isEdit)
        <div class="profile-card">
            <form method="POST" action="{{ route('employer.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-header">
                    <h2 class="card-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Edit Company Profile
                    </h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="company_name" class="form-input"
                            value="{{ old('company_name', $company->company_name) }}"
                            placeholder="Enter company name">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-input"
                            value="{{ old('location', $company->location) }}"
                            placeholder="Enter location">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-input"
                            value="{{ old('phone', $company->phone) }}"
                            placeholder="Enter phone number">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Website</label>
                        <input type="url" name="website" class="form-input"
                            value="{{ old('website', $company->website) }}"
                            placeholder="https://example.com">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="5" class="form-textarea"
                            placeholder="Describe your company...">{{ old('description', $company->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Business Permit (Optional)</label>
                        <input type="file" name="business_permit" class="form-input" accept=".jpg,.jpeg,.png,.pdf">
                        <p class="permit-note">Upload new business permit (JPG, PNG, or PDF. Max 5MB). Leave empty to keep current file.</p>
                        @if($company->business_permit_path ?? false)
                            <div class="current-file" style="margin-top: 12px;">
                                <div class="current-file-info">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Current: {{ basename($company->business_permit_path) }}</span>
                                </div>
                                <a href="{{ Storage::url($company->business_permit_path) }}" target="_blank" class="current-file-btn">View</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-actions">
                        <button type="submit" class="btn-success">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Save Changes
                        </button>
                        <a href="{{ url()->current() }}?edit=0" class="btn-secondary">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection