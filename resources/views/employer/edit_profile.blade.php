@extends('layouts.app')

@section('title', 'Company Profile')

@section('content')
@php
    $isEdit = request()->get('edit') == 1;
@endphp

<style>
    /* ===== PAGE CONTAINER ===== */
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
    .btn-primary:hover { background: #1d4ed8; transform: translateY(-1px); }

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
    .btn-success:hover { background: #059669; }

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
    .btn-secondary:hover { background: #4b5563; }

    /* ===== ALERTS ===== */
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
    }
    .alert-error {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .alert-list {
        list-style: disc;
        padding-left: 20px;
        margin: 0;
    }

    /* ===== PROFILE CARD ===== */
    .profile-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        overflow: hidden;
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

    /* ===== INFO GRID ===== */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }
    .info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .info-label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #9ca3af;
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
    .description-text {
        font-size: 0.875rem;
        color: #4b5563;
        line-height: 1.6;
        white-space: pre-line;
        margin: 0;
    }

    /* ===== FORM STYLES ===== */
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
    .form-input, .form-textarea {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 0.875rem;
        color: #374151;
        transition: all 0.15s;
        background: #fff;
    }
    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }
    .form-actions {
        display: flex;
        gap: 16px;
        margin-top: 24px;
        padding-top: 16px;
        border-top: 1px solid #e5e7eb;
    }

    /* ===== EMPTY STATE ===== */
    .empty-value {
        color: #9ca3af;
        font-style: italic;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 640px) {
        .card-header, .card-body, .card-footer {
            padding: 16px;
        }
        .info-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .form-actions {
            flex-direction: column;
        }
        .form-actions .btn-success,
        .form-actions .btn-secondary {
            justify-content: center;
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
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Company Information
                </h2>
            </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Company Name
                        </span>
                        <span class="info-value">{{ $company->company_name ?? '<span class="empty-value">Not set</span>' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Location
                        </span>
                        <span class="info-value">{{ $company->location ?? '<span class="empty-value">Not set</span>' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Phone
                        </span>
                        <span class="info-value">{{ $company->phone ?? '<span class="empty-value">Not set</span>' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="info-item mt-4">
                    <span class="info-label">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        Description
                    </span>
                    <p class="description-text">{{ $company->description ?? 'Not set' }}</p>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ url()->current() }}?edit=1" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <form method="POST" action="{{ route('employer.profile.update') }}">
                @csrf
                @method('PUT')
                <div class="card-header">
                    <h2 class="card-title">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                </div>
                <div class="card-footer">
                    <div class="form-actions">
                        <button type="submit" class="btn-success">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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