@extends('layouts.app')

@section('title', 'Employer Profile Review')

@section('content')
<style>
    /* ===== PAGE CONTAINER ===== */
    .full-page-container {
        min-height: 100vh;
        background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
        padding: 1.5rem 0;
    }
    .content-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    @media (max-width: 640px) {
        .content-wrapper {
            padding: 0 1rem;
        }
    }

    /* ===== BACK BUTTON ===== */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #fff;
        color: #2563eb;
        font-size: 0.875rem;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        text-decoration: none;
        transition: all 0.15s;
        margin-bottom: 1.5rem;
    }
    .btn-back:hover {
        background: #eff6ff;
    }

    /* ===== PAGE HEADER ===== */
    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
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

    /* ===== STATUS BADGES ===== */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.25rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    .status-pending { background: #fef9c3; color: #a16207; }
    .status-approved { background: #dcfce7; color: #15803d; }
    .status-rejected { background: #fee2e2; color: #b91c1c; }

    /* ===== INFO CARDS ===== */
    .info-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .card-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
    }
    .card-header.dark {
        background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
    }
    .card-header.green {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    }
    .card-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #fff;
        margin: 0;
    }
    .card-body {
        padding: 1.5rem;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    .info-label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #9ca3af;
        margin-bottom: 0.25rem;
    }
    .info-value {
        font-size: 1rem;
        font-weight: 500;
        color: #111827;
        line-height: 1.4;
    }
    .info-value-large {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
    }
    .description-box {
        background: #f9fafb;
        border-radius: 0.75rem;
        padding: 1rem;
        color: #4b5563;
        font-size: 0.875rem;
        line-height: 1.6;
        white-space: pre-line;
    }

    /* ===== ALERTS ===== */
    .alert-success {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #15803d;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .alert-error {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .alert-rejection {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .alert-rejection-title {
        font-size: 1rem;
        font-weight: 600;
        color: #b91c1c;
        margin-bottom: 0.5rem;
    }

    /* ===== SIDEBAR ===== */
    .sidebar-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        padding: 1.5rem;
        position: sticky;
        top: 2rem;
    }
    .sidebar-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
    }

    /* ===== BUTTONS ===== */
    .btn-approve {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        background: #10b981;
        color: #fff;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        border: none;
        cursor: pointer;
        transition: all 0.15s;
        margin-bottom: 0.75rem;
    }
    .btn-approve:hover {
        background: #059669;
    }
    .btn-reject {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        background: #ef4444;
        color: #fff;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        border: none;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-reject:hover {
        background: #dc2626;
    }
    .btn-reset {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        background: #6b7280;
        color: #fff;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        border: none;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-reset:hover {
        background: #4b5563;
    }
    .btn-cancel {
        flex: 1;
        background: #f3f4f6;
        color: #374151;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        border: none;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-cancel:hover {
        background: #e5e7eb;
    }
    .btn-confirm-reject {
        flex: 1;
        background: #ef4444;
        color: #fff;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        border: none;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-confirm-reject:hover {
        background: #dc2626;
    }

    /* ===== MODAL ===== */
    .modal {
        position: fixed;
        inset: 0;
        z-index: 50;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.5);
        padding: 1rem;
    }
    .modal-content {
        background: #fff;
        border-radius: 1rem;
        max-width: 32rem;
        width: 100%;
        padding: 1.75rem;
    }
    .modal-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.5rem;
    }
    .modal-sub {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1.25rem;
    }
    .modal-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        outline: none;
        transition: all 0.15s;
    }
    .modal-textarea:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239,68,68,0.1);
    }
    .modal-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.25rem;
    }
    .hidden {
        display: none;
    }

    /* ===== META INFO ===== */
    .meta-section {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
    }
    .meta-item {
        margin-bottom: 0.75rem;
    }
    .meta-label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #9ca3af;
    }
    .meta-value {
        font-size: 0.875rem;
        color: #111827;
        margin-top: 0.125rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        .page-header {
            flex-direction: column;
        }
    }
</style>

<div class="full-page-container">
    <div class="content-wrapper">
        <!-- Back Button -->
        <a href="{{ route('admin.employer-profiles.index') }}" class="btn-back">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Employer Profiles
        </a>

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Employer Profile Review</h1>
                <p class="page-sub">Review employer registration details and company credentials</p>
            </div>
            <div>
                @if ($employerProfile->isPending())
                    <span class="status-badge status-pending">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        Pending Review
                    </span>
                @elseif ($employerProfile->isApproved())
                    <span class="status-badge status-approved">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                        Approved
                    </span>
                @else
                    <span class="status-badge status-rejected">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                        Rejected
                    </span>
                @endif
            </div>
        </div>

        <!-- Alerts -->
        @if (session('success'))
        <div class="alert-success">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert-error">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('error') }}
        </div>
        @endif

        <!-- Rejection Reason Display -->
        @if ($employerProfile->isRejected() && $employerProfile->rejection_reason)
        <div class="alert-rejection">
            <div class="alert-rejection-title">Rejection Reason</div>
            <p class="text-red-700 text-sm">{{ $employerProfile->rejection_reason }}</p>
        </div>
        @endif

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Employer Information Card -->
                <div class="info-card">
                    <div class="card-header">
                        <h2 class="card-title">Employer Information</h2>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div>
                                <div class="info-label">Employer Name</div>
                                <div class="info-value-large">{{ $employerProfile->user->name }}</div>
                            </div>
                            <div>
                                <div class="info-label">Email Address</div>
                                <div class="info-value">{{ $employerProfile->user->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Company Information Card -->
                <div class="info-card">
                    <div class="card-header dark">
                        <h2 class="card-title">Company Information</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-6">
                            <div class="info-label">Company Name</div>
                            <div class="info-value-large">{{ $employerProfile->company_name }}</div>
                        </div>
                        <div class="info-grid">
                            <div>
                                <div class="info-label">Location</div>
                                <div class="info-value">{{ $employerProfile->location ?? 'N/A' }}</div>
                            </div>
                            <div>
                                <div class="info-label">Phone</div>
                                <div class="info-value">{{ $employerProfile->phone ?? 'N/A' }}</div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <div class="info-label">Website</div>
                            @if ($employerProfile->website)
                                <a href="{{ $employerProfile->website }}" target="_blank" class="info-value text-blue-600 hover:text-blue-800">
                                    {{ $employerProfile->website }}
                                </a>
                            @else
                                <div class="info-value text-gray-400">Not provided</div>
                            @endif
                        </div>
                        <div class="mt-6">
                            <div class="info-label mb-2">Company Description</div>
                            <div class="description-box">
                                {{ $employerProfile->description ?? 'No description provided' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Permit Card -->
                @if ($employerProfile->business_permit)
                <div class="info-card">
                    <div class="card-header green">
                        <h2 class="card-title">Business Permit</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{ asset('storage/' . $employerProfile->business_permit) }}" target="_blank"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            View / Download Permit
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column - Sidebar -->
            <div class="space-y-6">
                <div class="sidebar-card">
                    <h3 class="sidebar-title">Admin Actions</h3>

                    @if ($employerProfile->isPending())
                        <!-- Approve Button -->
                        <form method="POST" action="{{ route('admin.employer-profiles.approve', $employerProfile) }}">
                            @csrf
                            <button type="submit" class="btn-approve" onclick="return confirm('Approve this employer profile?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Approve Profile
                            </button>
                        </form>

                        <!-- Reject Button -->
                        <button type="button" onclick="document.getElementById('rejectModal').classList.remove('hidden')" class="btn-reject">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reject Profile
                        </button>
                    @else
                        <!-- Reset Button -->
                        <form method="POST" action="{{ route('admin.employer-profiles.reset', $employerProfile) }}">
                            @csrf
                            <button type="submit" class="btn-reset" onclick="return confirm('Reset this profile back to pending review?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset to Pending
                            </button>
                        </form>
                    @endif

                    <!-- Meta Information -->
                    <div class="meta-section">
                        <div class="meta-item">
                            <div class="meta-label">Submitted</div>
                            <div class="meta-value">{{ $employerProfile->created_at->format('M d, Y \a\t g:i A') }}</div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-label">Profile ID</div>
                            <div class="meta-value">#{{ $employerProfile->id }}</div>
                        </div>
                        @if ($employerProfile->isApproved() && $employerProfile->approvedByUser)
                        <div class="meta-item">
                            <div class="meta-label">Approved By</div>
                            <div class="meta-value">{{ $employerProfile->approvedByUser->name }}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="modal hidden">
    <div class="modal-content">
        <h3 class="modal-title">Reject Employer Profile</h3>
        <p class="modal-sub">Provide a clear explanation for rejection. This feedback will be sent to the employer.</p>

        <form method="POST" action="{{ route('admin.employer-profiles.reject', $employerProfile) }}">
            @csrf
            <textarea name="rejection_reason" rows="5" required placeholder="Enter rejection reason..."
                class="modal-textarea"></textarea>
            @error('rejection_reason')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
            @enderror

            <div class="modal-actions">
                <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" class="btn-cancel">
                    Cancel
                </button>
                <button type="submit" class="btn-confirm-reject">
                    Reject Profile
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Close modal when clicking outside
    document.getElementById('rejectModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
</script>
@endsection