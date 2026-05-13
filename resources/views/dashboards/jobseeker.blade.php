@extends('layouts.app')

@section('title', 'Job Seeker Dashboard')

@section('content')
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

    /* Force all lordicons to be properly sized */
    lord-icon {
        width: 20px !important;
        height: 20px !important;
    }

    /* Override any inline large lordicon styles */
    [style*="width:250px"] {
        width: 20px !important;
        height: 20px !important;
    }

    /* Tab button icons */
    .tab-btn svg,
    .tab-btn lord-icon {
        width: 18px !important;
        height: 18px !important;
    }

    /* ===== PAGE HEADER ===== */
    .page-header {
        display: flex;
        align-items: center;
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
        gap: 6px;
        background: #2563eb;
        color: #fff;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 9px 18px;
        border-radius: 10px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background 0.15s, transform 0.1s;
        white-space: nowrap;
    }

    .btn-primary svg {
        width: 16px;
        height: 16px;
    }

    .btn-primary:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }

    .btn-ghost {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #fff;
        color: #374151;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 9px 18px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.15s;
        white-space: nowrap;
    }

    .btn-ghost:hover {
        background: #f9fafb;
    }

    .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fff;
        color: #2563eb;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 9px 18px;
        border-radius: 10px;
        border: 1.5px solid #2563eb;
        text-decoration: none;
        transition: background 0.15s;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .btn-outline:hover {
        background: #eff6ff;
    }

    /* ===== PROFILE DROPDOWN ===== */
    .profile-dropdown {
        position: relative;
        display: inline-block;
    }

    .profile-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 40px;
        padding: 6px 6px 6px 16px;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: var(--shadow-sm);
    }

    .profile-btn:hover {
        background: #f9fafb;
        border-color: #d1d5db;
        transform: translateY(-1px);
    }

    .profile-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .profile-name {
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
    }

    .profile-chevron {
        width: 16px;
        height: 16px;
        color: #9ca3af;
        transition: transform 0.2s;
    }

    .profile-dropdown.active .profile-chevron {
        transform: rotate(180deg);
    }

    .dropdown-menu {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        width: 260px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s;
        z-index: 100;
    }

    .profile-dropdown.active .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-header {
        padding: 16px;
        border-bottom: 1px solid #f3f4f6;
    }

    .dropdown-user-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 2px;
    }

    .dropdown-user-email {
        font-size: 0.75rem;
        color: #6b7280;
    }

    .dropdown-divider {
        height: 1px;
        background: #f3f4f6;
        margin: 8px 0;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 16px;
        color: #374151;
        text-decoration: none;
        font-size: 0.875rem;
        transition: background 0.15s;
        cursor: pointer;
        width: 100%;
        background: none;
        border: none;
        text-align: left;
    }

    .dropdown-item:hover {
        background: #f9fafb;
    }

    .dropdown-item svg {
        width: 18px;
        height: 18px;
        color: #9ca3af;
    }

    .dropdown-item.danger {
        color: #ef4444;
    }

    .dropdown-item.danger svg {
        color: #ef4444;
    }

    .dropdown-item.danger:hover {
        background: #fef2f2;
    }

    /* ===== MODAL ===== */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-container {
        background: #fff;
        border-radius: 20px;
        width: 90%;
        max-width: 420px;
        transform: scale(0.9);
        transition: transform 0.3s ease;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .modal-overlay.active .modal-container {
        transform: scale(1);
    }

    .modal-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .modal-header svg {
        width: 28px;
        height: 28px;
        color: #ef4444;
    }

    .modal-header h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .modal-body {
        padding: 20px 24px;
    }

    .modal-body p {
        color: #6b7280;
        font-size: 0.9375rem;
        line-height: 1.5;
        margin: 0;
    }

    .modal-footer {
        padding: 16px 24px;
        border-top: 1px solid #f3f4f6;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .modal-btn {
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.15s;
        border: none;
    }

    .modal-btn-cancel {
        background: #f3f4f6;
        color: #374151;
    }

    .modal-btn-cancel:hover {
        background: #e5e7eb;
    }

    .modal-btn-confirm {
        background: #ef4444;
        color: #fff;
    }

    .modal-btn-confirm:hover {
        background: #dc2626;
    }

    /* ===== STATS CARDS ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 20px;
        transition: all 0.2s;
    }

    .stat-card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
        border-color: #d1d5db;
        transform: translateY(-2px);
    }

    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
    }

    .stat-title {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 4px;
    }

    .stat-sub {
        font-size: 0.75rem;
        color: #6b7280;
    }

    /* ===== TAB CONTROLLER ===== */
    .tab-controller {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        overflow: hidden;
    }

    .tab-headers {
        display: flex;
        border-bottom: 1px solid #e5e7eb;
        background: #fff;
        padding: 0 20px;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .tab-btn {
        padding: 14px 20px;
        font-size: 0.875rem;
        font-weight: 600;
        color: #6b7280;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .tab-btn.active {
        color: #2563eb;
    }

    .tab-btn.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 2px;
        background: #2563eb;
        border-radius: 2px;
    }

    .tab-btn:hover:not(.active) {
        color: #374151;
        background: #f9fafb;
    }

    .tab-content {
        display: none;
        padding: 24px;
        animation: fadeIn 0.3s ease;
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== SEARCH CARD ===== */
    .search-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 24px;
    }

    .search-form {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .search-input-wrapper {
        flex: 1;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 10px 16px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 0.875rem;
        outline: none;
        transition: all 0.15s;
    }

    .search-input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* ===== JOB CARD ===== */
    .job-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 12px;
        transition: all 0.2s;
    }

    .job-card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
        border-color: #d1d5db;
        transform: translateY(-2px);
    }

    .job-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }

    .job-title {
        font-size: 1.0625rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 6px;
    }

    .job-title a {
        color: inherit;
        text-decoration: none;
    }

    .job-title a:hover {
        color: #2563eb;
    }

    .job-desc {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0;
        line-height: 1.5;
    }

    .skills-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 12px;
    }

    .skill-tag {
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 999px;
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #374151;
    }

    /* ===== JOB META ICONS ===== */
    .job-meta-icon svg {
        width: 14px;
        height: 14px;
    }

    /* ===== TABLE STYLES ===== */
    .table-wrapper {
        overflow-x: auto;
    }

    .applications-table {
        width: 100%;
        border-collapse: collapse;
    }

    .applications-table th {
        text-align: left;
        padding: 12px 16px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }

    .applications-table td {
        padding: 16px;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
    }

    .applications-table tr:hover td {
        background: #f9fafb;
    }

    /* ===== STATUS BADGES ===== */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        font-size: 0.6875rem;
        font-weight: 600;
        border-radius: 999px;
    }

    .status-pending {
        background: #fef9c3;
        color: #a16207;
    }

    .status-reviewing {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-interview {
        background: #f3e8ff;
        color: #6b21a5;
    }

    .status-offered {
        background: #dcfce7;
        color: #15803d;
    }

    .status-rejected {
        background: #fee2e2;
        color: #b91c1c;
    }

    /* ===== PROFILE COMPLETION BANNER ===== */
    .profile-completion-banner {
        background: linear-gradient(135deg, #f5f3ff 0%, #eff6ff 100%);
        border-radius: 16px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        border: 1px solid #e0e7ff;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 48px 24px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
    }

    .empty-icon {
        font-size: 3rem;
        margin-bottom: 12px;
    }

    .empty-title {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 4px;
    }

    .empty-sub {
        font-size: 0.875rem;
        color: #6b7280;
    }

    /* ============================================================
       RESPONSIVE DESIGN
    ============================================================ */

    @media (max-width: 768px) {
        .stats-grid {
            gap: 12px;
        }

        .stat-value {
            font-size: 1.5rem;
        }

        .tab-headers {
            padding: 0 12px;
        }

        .tab-btn {
            padding: 12px 16px;
            font-size: 0.813rem;
        }

        .tab-content {
            padding: 16px;
        }

        .search-form {
            flex-direction: column;
        }

        .search-form .btn-primary {
            width: 100%;
            justify-content: center;
        }

        .job-top {
            flex-direction: column;
        }

        .job-card .btn-primary {
            width: 100%;
            justify-content: center;
        }

        .profile-btn .profile-name {
            display: none;
        }

        .profile-btn {
            padding: 6px;
        }

        .modal-container {
            width: 95%;
        }
    }

    @media (max-width: 640px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .profile-completion-banner {
            text-align: center;
        }

        .profile-completion-banner .flex {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .profile-completion-banner .w-64 {
            width: 100%;
        }

        .page-header {
            flex-direction: column;
            align-items: stretch;
        }

        .page-header .profile-dropdown {
            align-self: flex-end;
        }

        .skill-tag {
            font-size: 0.65rem;
            padding: 2px 8px;
        }

        /* Applications table - Card layout on mobile */
        .applications-table thead {
            display: none;
        }

        .applications-table tbody tr {
            display: block;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            margin-bottom: 12px;
            padding: 14px;
            background: #fff;
        }

        .applications-table tbody td {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f3f4f6;
            gap: 12px;
        }

        .applications-table tbody td:last-child {
            border-bottom: none;
        }

        .applications-table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            min-width: 90px;
        }

        .applications-table tbody td:first-child,
        .applications-table tbody td:last-child {
            padding-left: 0;
            padding-right: 0;
        }

        .applications-table tbody td:first-child a {
            font-size: 0.875rem;
            text-align: right;
            flex: 1;
        }

        .status-badge {
            white-space: nowrap;
        }
    }

    @media (max-width: 480px) {
        .tab-btn span {
            display: none;
        }

        .tab-btn svg,
        .tab-btn lord-icon {
            width: 18px !important;
            height: 18px !important;
        }

        .stat-value {
            font-size: 1.25rem;
        }

        .stat-title {
            font-size: 0.875rem;
        }

        .applications-table tbody tr {
            padding: 12px;
        }

        .applications-table tbody td {
            padding: 8px 0;
        }

        .applications-table tbody td::before {
            min-width: 75px;
            font-size: 0.6rem;
        }

        .status-badge {
            font-size: 0.6rem;
            padding: 2px 6px;
        }

        .job-title {
            font-size: 1rem;
        }

        .job-desc {
            font-size: 0.75rem;
        }
    }
</style>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="page-sub">Find your dream job and track your applications</p>
        </div>

        <!-- Profile Dropdown -->
        <div class="profile-dropdown" id="profileDropdown">
            <button class="profile-btn" id="profileBtn">
                <div class="profile-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span class="profile-name">{{ auth()->user()->name }}</span>
                <svg class="profile-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="dropdown-menu">
                <div class="dropdown-header">
                    <div class="dropdown-user-name">{{ auth()->user()->name }}</div>
                    <div class="dropdown-user-email">{{ auth()->user()->email }}</div>
                </div>
                <div class="dropdown-divider"></div>

                <a href="{{ route('jobseeker.profile.show') }}" class="dropdown-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    My Profile
                </a>

                <a href="{{ route('jobseeker.profile.edit') }}" class="dropdown-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit Profile
                </a>

                <div class="dropdown-divider"></div>

                <button type="button" class="dropdown-item danger" id="logoutBtn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div class="modal-overlay" id="logoutModal">
        <div class="modal-container">
            <div class="modal-header">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h3>Confirm Logout</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to log out? You will need to sign in again to access your account.</p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-cancel" id="cancelLogoutBtn">Cancel</button>
                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit" class="modal-btn modal-btn-confirm">Yes, Logout</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Profile Completion Banner -->
    @if($profileCompletion < 100)
    <div class="profile-completion-banner">
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
            <div style="display: flex; align-items: flex-start; gap: 12px; flex: 1;">
                <div style="font-size: 1.5rem;">⭐</div>
                <div style="flex: 1;">
                    <h3 style="font-weight: 600; color: #111827; margin: 0 0 4px;">Complete your profile</h3>
                    <p style="font-size: 0.813rem; color: #6b7280; margin: 0 0 8px;">
                        Your profile is {{ $profileCompletion }}% complete. A complete profile increases your chances of getting hired by 40%
                    </p>
                    <div style="width: 100%; max-width: 256px; background: #e5e7eb; border-radius: 999px; height: 6px;">
                        <div style="width: {{ $profileCompletion }}%; background: #7c3aed; border-radius: 999px; height: 6px;"></div>
                    </div>
                </div>
            </div>
            <a href="{{ route('jobseeker.profile.show') }}" class="btn-primary">Complete Profile →</a>
        </div>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <lord-icon src="https://cdn.lordicon.com/lbcxnxti.json" trigger="loop" stroke="bold" state="loop-cycle"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:32px;height:32px">
                </lord-icon>
                <span class="stat-value" style="color: #111827;">{{ $applicationsCount }}</span>
            </div>
            <div class="stat-title">Applied Jobs</div>
            <div class="stat-sub">{{ $applicationsCount > 0 ? '+' . min(3, $applicationsCount) : '0' }} this week</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <lord-icon src="https://cdn.lordicon.com/warimioc.json" trigger="hover" stroke="bold"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:32px;height:32px">
                </lord-icon>
                <span class="stat-value" style="color: #111827;">{{ $underReviewCount }}</span>
            </div>
            <div class="stat-title">Under Review</div>
            <div class="stat-sub">Awaiting response</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <lord-icon src="https://cdn.lordicon.com/weqkkuwt.json" trigger="hover" stroke="bold"
                    state="hover-enlarge" colors="primary:#110a5c,secondary:#3080e8" style="width:32px;height:32px">
                </lord-icon>
                <span class="stat-value" style="color: #111827;">{{ $interviewsCount }}</span>
            </div>
            <div class="stat-title">Interviews</div>
            <div class="stat-sub">Scheduled</div>
        </div>
    </div>

    <!-- Tab Controller -->
    <div class="tab-controller">
        <div class="tab-headers">
            <button class="tab-btn active" onclick="switchTab('find-jobs')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span>Find Jobs</span>
            </button>
            <button class="tab-btn" onclick="switchTab('my-applications')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>My Applications</span>
            </button>
        </div>

        <!-- Find Jobs Tab -->
        <div id="find-jobs-tab" class="tab-content active">
            <!-- Search Card -->
            <div class="search-card">
                <form method="GET" action="{{ route('jobseeker.jobs.index') }}" class="search-form">
                    <div class="search-input-wrapper">
                        <input type="text" name="search" placeholder="Search by job title, skills, or keywords..."
                            class="search-input" value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn-primary">Search Jobs</button>
                </form>
            </div>

            <!-- Job Listings -->
            @forelse($recommendedJobs as $job)
            <div class="job-card">
                <div class="job-top">
                    <div style="flex: 1;">
                        <h3 class="job-title">
                            <a href="{{ route('jobseeker.jobs.show', $job) }}">{{ $job->title }}</a>
                        </h3>
                        <p class="job-desc">{{ Str::limit($job->description ?? 'No description available', 120) }}</p>
                    </div>
                    <div>
                        <a href="{{ route('jobseeker.jobs.apply.form', $job) }}" class="btn-primary">Apply Now →</a>
                    </div>
                </div>

                <div class="job-meta-icon" style="display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 12px;">
                    <span style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.75rem; color: #6b7280;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $job->location ?? 'Remote' }}
                    </span>
                    <span style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.75rem; color: #6b7280;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        {{ ucfirst($job->experience_level ?? 'Any') }}
                    </span>
                    @if($job->salary)
                    <span style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.75rem; color: #6b7280;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        ${{ number_format($job->salary) }}/year
                    </span>
                    @endif
                    <span style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.75rem; color: #6b7280;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $job->created_at->diffForHumans() }}
                    </span>
                </div>

                @if($job->skills_required && count($job->skills_required) > 0)
                <div class="skills-wrap">
                    @foreach($job->skills_required as $skill)
                        <span class="skill-tag">{{ $skill }}</span>
                    @endforeach
                </div>
                @endif
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">🔍</div>
                <div class="empty-title">No jobs found</div>
                <p class="empty-sub">Try adjusting your search or check back later for new opportunities</p>
                <a href="{{ route('jobseeker.profile.show') }}" class="btn-outline" style="margin-top: 1rem;">Update your profile</a>
            </div>
            @endforelse
        </div>

        <!-- My Applications Tab -->
        <div id="my-applications-tab" class="tab-content">
            <div class="table-wrapper">
                <table class="applications-table">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Applied On</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentApplications as $application)
                        <tr>
                            <td data-label="Job Title">
                                <a href="{{ route('jobseeker.jobs.show', $application->job) }}"
                                    style="font-weight: 500; color: #111827; text-decoration: none;">
                                    {{ $application->job->title }}
                                </a>
                            </div>
                            <td>
                                {{ $application->job->employer->employerProfile->company_name ?? 'N/A' }}
                            </div>
                            <td>{{ $application->created_at->format('M d, Y') }}</div>
                            <td>
                                @php
                                    $statusClass = match ($application->status) {
                                        'pending' => 'status-pending',
                                        'reviewing' => 'status-reviewing',
                                        'interview', 'interview_scheduled' => 'status-interview',
                                        'offered' => 'status-offered',
                                        'rejected' => 'status-rejected',
                                        default => 'status-pending'
                                    };
                                    $statusLabel = match ($application->status) {
                                        'pending' => 'Pending',
                                        'reviewing' => 'Reviewing',
                                        'interview' => 'Interview',
                                        'interview_scheduled' => 'Interview Scheduled',
                                        'offered' => 'Offered',
                                        'rejected' => 'Rejected',
                                        default => ucfirst($application->status)
                                    };
                                @endphp
                                <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                            </div>
                            <td>
                                @if(in_array($application->status, ['interview_scheduled', 'interview']))
                                    <a href="{{ route('jobseeker.interviews.join', $application->interview_session_id ?? '#') }}"
                                        style="color: #2563eb; font-size: 0.813rem; font-weight: 500; text-decoration: none;">Join →</a>
                                @elseif($application->status == 'offered')
                                    <a href="{{ route('jobseeker.applications.show', $application) }}"
                                        style="color: #10b981; font-size: 0.813rem; font-weight: 500; text-decoration: none;">View →</a>
                                @else
                                    <a href="{{ route('jobseeker.applications.show', $application) }}"
                                        style="color: #6b7280; font-size: 0.813rem; font-weight: 500; text-decoration: none;">View →</a>
                                @endif
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 48px 24px; color: #9ca3af;">
                                No applications yet. Start browsing jobs!
                            </div>
                        </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(count($recentApplications) > 0)
            <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #f3f4f6; text-align: center;">
                <a href="{{ route('jobseeker.applications.index') }}" class="btn-ghost">View All Applications →</a>
            </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.lordicon.com/lordicon.js"></script>
<script>
    // Profile Dropdown Toggle
    const profileDropdown = document.getElementById('profileDropdown');
    const profileBtn = document.getElementById('profileBtn');

    if (profileBtn && profileDropdown) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle('active');
        });

        document.addEventListener('click', (e) => {
            if (!profileDropdown.contains(e.target)) {
                profileDropdown.classList.remove('active');
            }
        });
    }

    // Logout Modal
    const logoutBtn = document.getElementById('logoutBtn');
    const logoutModal = document.getElementById('logoutModal');
    const cancelLogoutBtn = document.getElementById('cancelLogoutBtn');

    if (logoutBtn) {
        logoutBtn.addEventListener('click', () => {
            logoutModal.classList.add('active');
            profileDropdown.classList.remove('active');
        });
    }

    if (cancelLogoutBtn) {
        cancelLogoutBtn.addEventListener('click', () => {
            logoutModal.classList.remove('active');
        });
    }

    if (logoutModal) {
        logoutModal.addEventListener('click', (e) => {
            if (e.target === logoutModal) {
                logoutModal.classList.remove('active');
            }
        });
    }

    // Tab switching
    function switchTab(tabName) {
        const findTab = document.getElementById('find-jobs-tab');
        const appsTab = document.getElementById('my-applications-tab');
        const buttons = document.querySelectorAll('.tab-btn');

        findTab.classList.remove('active');
        appsTab.classList.remove('active');
        buttons.forEach(btn => btn.classList.remove('active'));

        if (tabName === 'find-jobs') {
            findTab.classList.add('active');
            buttons[0].classList.add('active');
        } else {
            appsTab.classList.add('active');
            buttons[1].classList.add('active');
        }

        localStorage.setItem('activeDashboardTab', tabName);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const savedTab = localStorage.getItem('activeDashboardTab');
        if (savedTab === 'my-applications') switchTab('my-applications');
    });
</script>
@endsection