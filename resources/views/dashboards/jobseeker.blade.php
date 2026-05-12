@extends('layouts.app')

@section('title', 'Job Seeker Dashboard')

@section('content')
    <style>
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
            padding: 9px 18px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
            white-space: nowrap;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            justify-content: center;
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

        /* ===== LOGOUT CONFIRMATION MODAL ===== */
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
            transition: box-shadow 0.15s, border-color 0.15s;
        }

        .stat-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
            border-color: #d1d5db;
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
        }

        .tab-content.active {
            display: block;
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
            transition: border-color 0.15s;
        }

        .search-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
        }

        /* ===== JOB CARD ===== */
        .job-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 12px;
            transition: box-shadow 0.15s, border-color 0.15s;
        }

        .job-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
            border-color: #d1d5db;
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

        /* ===== APPLICATIONS TABLE ===== */
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

        .status-badge {
            display: inline-flex;
            padding: 4px 10px;
            font-size: 0.75rem;
            font-weight: 500;
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

        /* ===== RESPONSIVE STYLES ===== */

        /* Tablet styles */
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

            .job-top {
                flex-direction: column;
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

        /* Mobile phones (640px and below) */
        @media (max-width: 640px) {

            /* Stats Cards - Stack vertically */
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            /* Profile Completion Banner */
            .bg-gradient-to-r {
                text-align: center;
            }

            .bg-gradient-to-r .flex.items-start.gap-3 {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .bg-gradient-to-r .w-64 {
                width: 100%;
            }

            /* Job Cards - Full width buttons */
            .job-card .btn-primary {
                width: 100%;
                justify-content: center;
            }

            /* Search Form - Full width button */
            .search-form .btn-primary {
                width: 100%;
                justify-content: center;
            }

            /* Page Header - Stack on mobile */
            .page-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                flex-wrap: nowrap;
                margin-bottom: 24px;
            }

            .page-header>div:first-child {
                flex: 1;
                min-width: 0;
            }

            .page-header .profile-dropdown {
                flex-shrink: 0;
            }

            /* Job Card Badges - Smaller text */
            .job-card .inline-flex.items-center {
                font-size: 0.7rem;
                padding: 0.25rem 0.5rem;
            }

            /* Skills Tags - Smaller */
            .skill-tag {
                font-size: 0.65rem;
                padding: 2px 8px;
            }

            /* ===== APPLICATIONS TABLE - MOBILE CARD LAYOUT ===== */
            /* Hide table headers on mobile */
            .applications-table thead {
                display: none;
            }

            /* Make each row a card */
            .applications-table tbody tr {
                display: block;
                border: 1px solid #e5e7eb;
                border-radius: 16px;
                margin-bottom: 16px;
                padding: 16px;
                background: #fff;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            }

            /* Make each cell a flex row with label on left, value on right */
            .applications-table tbody td {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 12px 0;
                border-bottom: 1px solid #f3f4f6;
                gap: 12px;
            }

            /* Remove border from last cell */
            .applications-table tbody td:last-child {
                border-bottom: none;
            }

            /* Add label before each cell content using data-label attribute */
            .applications-table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                font-size: 0.7rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                color: #6b7280;
                min-width: 90px;
            }

            /* Remove default padding that conflicts with new layout */
            .applications-table tbody td:first-child,
            .applications-table tbody td:last-child {
                padding-left: 0;
                padding-right: 0;
            }

            /* Job title styling in card view */
            .applications-table tbody td:first-child a {
                font-weight: 600;
                font-size: 0.875rem;
                color: #1f2937;
                text-align: right;
                flex: 1;
            }

            /* Status badge alignment */
            .applications-table tbody td .status-badge {
                white-space: nowrap;
            }

            /* Action link styling */
            .applications-table tbody td:last-child a {
                font-weight: 500;
            }
        }

        /* Very small phones (400px and below) */
        @media (max-width: 400px) {

            /* Tab buttons - Hide text, show only icons */
            .tab-btn span {
                display: none;
            }

            .tab-btn svg {
                width: 18px;
                height: 18px;
            }

            /* Stats - Smaller font */
            .stat-value {
                font-size: 1.25rem;
            }

            .stat-title {
                font-size: 0.875rem;
            }

            /* Card layout - Smaller padding */
            .applications-table tbody tr {
                padding: 12px;
            }

            .applications-table tbody td {
                padding: 8px 0;
            }

            .applications-table tbody td::before {
                min-width: 75px;
                font-size: 0.65rem;
            }

            .applications-table tbody td:first-child a {
                font-size: 0.75rem;
            }

            /* Status badge - Smaller */
            .status-badge {
                padding: 2px 6px;
                font-size: 0.6rem;
            }
        }
    </style>

    <div class="space-y-6">
        <!-- Page Header with Profile Dropdown -->
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

                    <!-- Profile Link -->
                    <a href="{{ route('jobseeker.profile.show') }}" class="dropdown-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        My Profile
                    </a>

                    <!-- Settings Link -->
                    <a href="{{ route('jobseeker.profile.edit') }}" class="dropdown-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Edit Profile
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- Logout Button (triggers modal) -->
                    <button type="button" class="dropdown-item danger" id="logoutBtn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
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
            <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-2xl border border-purple-100 p-5">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div class="text-2xl">⭐</div>
                        <div>
                            <h2 class="font-semibold text-gray-900">Complete your profile</h2>
                            <p class="text-sm text-gray-600 mt-0.5">
                                Your profile is {{ $profileCompletion }}% complete. A complete profile increases your chances of
                                getting hired by 40%
                            </p>
                            <div class="w-64 mt-2 bg-gray-200 rounded-full h-1.5">
                                <div class="bg-purple-600 h-1.5 rounded-full" style="width: {{ $profileCompletion }}%"></div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('jobseeker.profile.show') }}" class="btn-primary">
                        Complete Profile →
                    </a>
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <lord-icon src="https://cdn.lordicon.com/lbcxnxti.json" trigger="loop" stroke="bold" state="loop-cycle"
                        colors="primary:#110a5c,secondary:#3080e8" style="width:40px;height:40px">
                    </lord-icon>
                    <span class="stat-value text-black">{{ $applicationsCount }}</span>
                </div>
                <div class="stat-title">Applied Jobs</div>
                <div class="stat-sub font-bold text-black ">
                    {{ $applicationsCount > 0 ? '+' . min(3, $applicationsCount) : '0' }} this week
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <lord-icon src="https://cdn.lordicon.com/warimioc.json" trigger="hover" stroke="bold"
                        colors="primary:#110a5c,secondary:#3080e8" style="width:40px;height:40px">
                    </lord-icon>
                    <span class="stat-value text-black">{{ $underReviewCount }}</span>
                </div>
                <div class="stat-title">Under Review</div>
                <div class="stat-sub font-bold text-black ">Awaiting response</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <lord-icon src="https://cdn.lordicon.com/weqkkuwt.json" trigger="hover" stroke="bold"
                        state="hover-enlarge" colors="primary:#110a5c,secondary:#3080e8" style="width:40px;height:40px">
                    </lord-icon>
                    <span class="stat-value text-black">{{ $interviewsCount }}</span>
                </div>
                <div class="stat-title">Interviews</div>
                <div class="stat-sub font-bold text-black ">Scheduled</div>
            </div>
        </div>

        <!-- Tab Controller -->
        <div class="tab-controller">
            <div class="tab-headers">
                <button class="tab-btn active inline-flex items-center gap-2" onclick="switchTab('find-jobs')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 12h.01" />
                        <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                        <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                        <rect width="20" height="14" x="2" y="6" rx="2" />
                    </svg>
                    <span>Find Jobs</span>
                </button>
                <button class="tab-btn" onclick="switchTab('my-applications')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        style="display: inline-block; vertical-align: middle;">
                        <path d="M15 12h-5" />
                        <path d="M15 8h-5" />
                        <path d="M19 17V5a2 2 0 0 0-2-2H4" />
                        <path
                            d="M8 21h12a2 2 0 0 0 2-2v-1a1 1 0 0 0-1-1H11a1 1 0 0 0-1 1v1a2 2 0 1 1-4 0V5a2 2 0 1 0-4 0v2a1 1 0 0 0 1 1h3" />
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

                <!-- Jobs List -->
                @forelse($recommendedJobs as $job)
                    <div class="job-card">
                        <div class="job-top">
                            <div class="flex-1">
                                <h3 class="job-title">
                                    <a href="{{ route('jobseeker.jobs.show', $job) }}">{{ $job->title }}</a>
                                </h3>
                                <p class="job-desc">{{ Str::limit($job->description ?? 'No description available', 120) }}</p>
                            </div>
                            <div>
                                <a href="{{ route('jobseeker.jobs.apply.form', $job) }}" class="btn-primary">Apply Now →</a>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="#cb0b3b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-map-pin-icon lucide-map-pin">
                                    <path
                                        d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                <span>{{ $job->location ?? 'N/A' }}</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="#050505" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-building2-icon lucide-building-2">
                                    <path d="M10 12h4" />
                                    <path d="M10 8h4" />
                                    <path d="M14 21v-3a2 2 0 0 0-4 0v3" />
                                    <path d="M6 10H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2" />
                                    <path d="M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16" />
                                </svg>
                                <span>{{ ucfirst($job->experience_level ?? 'Any') }}</span>
                            </span>
                            @if($job->salary)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="#050505" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-philippine-peso-icon lucide-philippine-peso">
                                        <path d="M20 11H4" />
                                        <path d="M20 7H4" />
                                        <path d="M7 21V4a1 1 0 0 1 1-1h4a1 1 0 0 1 0 12H7" />
                                    </svg>
                                    <span class="text-black">${{ number_format($job->salary) }}/year</span>
                                </span>
                            @endif
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="#050505" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-clock3-icon lucide-clock-3">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 6v6h4" />
                                </svg>
                                <span>{{ $job->created_at->diffForHumans() }}</span>
                            </span>
                            @if($job->is_remote ?? false)
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-teal-50 text-teal-700">
                                    <svg class="w-3.5 h-3.5 text-teal-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.66 0 3-4 3-9s-1.34-9-3-9m0 18c-1.66 0-3-4-3-9s1.34-9 3-9" />
                                    </svg>
                                    <span>Remote</span>
                                </span>
                            @endif
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
                        <a href="{{ route('jobseeker.profile.show') }}" class="btn-outline mt-4">Update your profile</a>
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
                                            class="font-medium text-gray-900 hover:text-blue-600">
                                            {{ $application->job->title }}
                                        </a>
                                    </td>
                                    <td data-label="Company">
                                        {{ $application->job->employer->employerProfile->company_name ?? 'N/A' }}
                                    </td>
                                    <td data-label="Applied On">{{ $application->created_at->format('M d, Y') }}</td>
                                    <td data-label="Status">
                                        @php
                                            $statusClass = match ($application->status) {
                                                'pending' => 'status-pending',
                                                'reviewing' => 'status-reviewing',
                                                'interview', 'interview_scheduled' => 'status-interview',
                                                'offered' => 'status-offered',
                                                'rejected' => 'status-rejected',
                                                default => 'status-pending'
                                            };
                                        @endphp
                                        <span class="status-badge {{ $statusClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                        </span>
                                    </td>
                                    <td data-label="Action">
                                        @if(in_array($application->status, ['interview_scheduled', 'interview']))
                                            <a href="{{ route('jobseeker.interviews.join', $application->interview_session_id ?? '#') }}"
                                                class="text-blue-600 text-sm font-medium">Join →</a>
                                        @elseif($application->status == 'offered')
                                            <a href="{{ route('jobseeker.applications.show', $application) }}"
                                                class="text-green-600 text-sm font-medium">View →</a>
                                        @else
                                            <a href="{{ route('jobseeker.applications.show', $application) }}"
                                                class="text-gray-500 text-sm font-medium hover:text-blue-600">View →</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-12 text-gray-500">No applications yet. Start browsing
                                        jobs!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if(count($recentApplications) > 0)
                    <div class="mt-4 pt-4 border-t border-gray-100 text-center">
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

            // Close dropdown when clicking outside
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

        // Close modal when clicking outside
        if (logoutModal) {
            logoutModal.addEventListener('click', (e) => {
                if (e.target === logoutModal) {
                    logoutModal.classList.remove('active');
                }
            });
        }

        // Tab Switching
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