@extends('layouts.app')

@section('title', 'Manage Users')

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

        /* ===== PAGE HEADER ===== */
        .page-header {
            display: flex;
            align-items: center;
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

        /* ===== STATS CARDS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            padding: 1.25rem;
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
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.875rem;
            font-weight: 700;
        }

        .stat-label {
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
        }

        .stat-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ===== SEARCH BAR ===== */
        .search-wrapper {
            position: relative;
            min-width: 250px;
        }

        .search-input {
            width: 100%;
            padding: 0.625rem 1rem 0.625rem 2.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            outline: none;
            transition: all 0.15s;
            background: #fff;
        }

        .search-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1rem;
            height: 1rem;
            color: #9ca3af;
        }

        /* ===== TABLE ===== */
        .table-wrapper {
            overflow-x: auto;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .users-table th {
            text-align: left;
            padding: 0.875rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .users-table td {
            padding: 1rem;
            font-size: 0.875rem;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }

        .users-table tr:hover td {
            background: #f9fafb;
        }

        .users-table tr:last-child td {
            border-bottom: none;
        }

        /* ===== USER INFO ===== */
        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
            color: #fff;
            flex-shrink: 0;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: #111827;
            line-height: 1.4;
        }

        /* ===== STATUS BADGES ===== */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-active {
            background: #dcfce7;
            color: #15803d;
        }

        .status-banned {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-dot {
            width: 0.375rem;
            height: 0.375rem;
            border-radius: 50%;
        }

        .status-active .status-dot {
            background: #15803d;
        }

        .status-banned .status-dot {
            background: #b91c1c;
        }

        /* ===== ROLE BADGES ===== */
        .role-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .role-jobseeker {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .role-employer {
            background: #dcfce7;
            color: #15803d;
        }

        .role-admin {
            background: #f3e8ff;
            color: #6b21a5;
        }

        /* ===== ACTION BUTTONS ===== */
        .action-buttons {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: nowrap;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.375rem 0.875rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            text-decoration: none;
            background: transparent;
            white-space: nowrap;
        }

        .action-view {
            background: #f3f4f6;
            color: #4b5563;
            border: 1px solid #e5e7eb;
        }

        .action-view:hover {
            background: #e5e7eb;
            color: #2563eb;
            transform: translateY(-1px);
        }

        .action-ban {
            background: #fef3c7;
            color: #d97706;
            border: 1px solid #fde68a;
        }

        .action-ban:hover {
            background: #fde68a;
            transform: translateY(-1px);
        }

        .action-unban {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .action-unban:hover {
            background: #bbf7d0;
            transform: translateY(-1px);
        }

        .action-delete {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .action-delete:hover {
            background: #fecaca;
            transform: translateY(-1px);
        }

        /* ===== MODAL STYLES ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            max-width: 500px;
            width: 90%;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.3s;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
            padding: 0;
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            transition: all 0.15s;
        }

        .modal-close:hover {
            background: #f3f4f6;
            color: #111827;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .detail-row {
            display: flex;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .detail-label {
            width: 100px;
            font-weight: 600;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .detail-value {
            flex: 1;
            color: #111827;
            font-size: 0.875rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.15s;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
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

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
        }

        .empty-icon {
            width: 4rem;
            height: 4rem;
            background: #f3f4f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .empty-title {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
        }

        .empty-sub {
            font-size: 0.875rem;
            color: #6b7280;
        }

        /* Inline form fix */
        .inline {
            display: inline-flex;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-wrapper {
                width: 100%;
            }
            
            .stats-grid {
                gap: 0.75rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .users-table th,
            .users-table td {
                padding: 0.75rem;
            }

            .action-buttons {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .action-btn {
                padding: 0.375rem 0.75rem;
                font-size: 0.6875rem;
            }
        }
    </style>

    <div class="full-page-container">
        <div class="content-wrapper">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Manage Users</h1>
                    <p class="page-sub">View and manage all registered users in the system</p>
                </div>
                <div class="search-wrapper">
                    <input type="text" id="searchUsers" placeholder="Search by name, email, or role..." class="search-input">
                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <!-- Total Users Card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-value text-gray-900">{{ $users->count() }}</div>
                        <div class="stat-icon bg-blue-100">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-label">Total Users</div>
                </div>

                <!-- Job Seekers Card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-value text-blue-600">{{ $users->where('role_id', 1)->count() }}</div>
                        <div class="stat-icon bg-indigo-100">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-label">Job Seekers</div>
                </div>

                <!-- Employers Card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-value text-green-600">{{ $users->where('role_id', 2)->count() }}</div>
                        <div class="stat-icon bg-emerald-100">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-label">Employers</div>
                </div>

                <!-- Banned Users Card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-value text-red-600">{{ $users->where('is_banned', true)->count() }}</div>
                        <div class="stat-icon bg-red-100">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-label">Banned Users</div>
                </div>
            </div>

            <!-- Alerts -->
            @if(session('success'))
                <div class="alert-success">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-error">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Users Table -->
            <div class="table-wrapper">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                        <div class="user-details">
                                            <span class="user-name">{{ $user->name }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <td><span class="text-gray-600">{{ $user->email }}</span></td>
                                
                                <td>
                                    @php
                                        $roleClass = match ($user->role_id) {
                                            1 => 'role-jobseeker',
                                            2 => 'role-employer',
                                            3 => 'role-admin',
                                            default => 'role-jobseeker'
                                        };
                                        $roleLabel = match ($user->role_id) {
                                            1 => 'Job Seeker',
                                            2 => 'Employer',
                                            3 => 'Admin',
                                            default => 'User'
                                        };
                                    @endphp
                                    <span class="role-badge {{ $roleClass }}">{{ $roleLabel }}</span>
                                </div>
                                
                                <td>
                                    @if($user->is_banned)
                                        <span class="status-badge status-banned">
                                            <span class="status-dot"></span>
                                            Banned
                                        </span>
                                    @else
                                        <span class="status-badge status-active">
                                            <span class="status-dot"></span>
                                            Active
                                        </span>
                                    @endif
                                </div>
                                
                                <td><span class="text-gray-500">{{ $user->created_at->format('M d, Y') }}</span></div>
                                
                                <td>
                                    <div class="action-buttons">
                                        <!-- View Button -->
                                        <button class="action-btn action-view" title="View Details" onclick='viewUserDetails({
                                            id: {{ $user->id }},
                                            name: "{{ addslashes($user->name) }}",
                                            email: "{{ $user->email }}",
                                            role_id: {{ $user->role_id }},
                                            role_label: "{{ $roleLabel }}",
                                            is_banned: {{ $user->is_banned ? 'true' : 'false' }},
                                            joined: "{{ $user->created_at->format('F d, Y') }}"
                                        })'>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </button>

                                        <!-- Ban/Unban Button -->
                                        @if($user->is_banned)
                                            <form action="{{ route('admin.users.unban', $user) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="action-btn action-unban" title="Unban User"
                                                    onclick="return confirm('Are you sure you want to unban this user?')">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Unban
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.ban', $user) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="action-btn action-ban" title="Ban User"
                                                    onclick="return confirm('Are you sure you want to ban this user? Banned users cannot access the platform.')">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                    </svg>
                                                    Ban
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn action-delete" title="Delete User"
                                                onclick="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone. All associated data will be removed.')">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                        <div class="empty-title">No users found</div>
                                        <p class="empty-sub">Users will appear here as they register on the platform</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- User Details Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>User Details</h2>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detail-row">
                    <div class="detail-label">Name:</div>
                    <div class="detail-value" id="modalUserName"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Email:</div>
                    <div class="detail-value" id="modalUserEmail"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Role:</div>
                    <div class="detail-value" id="modalUserRole"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value" id="modalUserStatus"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Joined:</div>
                    <div class="detail-value" id="modalUserJoined"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">User ID:</div>
                    <div class="detail-value" id="modalUserId"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-secondary" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>

    <script>
        // User details modal functionality
        function viewUserDetails(user) {
            document.getElementById('modalUserName').textContent = user.name;
            document.getElementById('modalUserEmail').textContent = user.email;
            document.getElementById('modalUserRole').textContent = user.role_label;
            document.getElementById('modalUserStatus').innerHTML = user.is_banned ?
                '<span class="status-badge status-banned"><span class="status-dot"></span>Banned</span>' :
                '<span class="status-badge status-active"><span class="status-dot"></span>Active</span>';
            document.getElementById('modalUserJoined').textContent = user.joined;
            document.getElementById('modalUserId').textContent = '#' + user.id;

            document.getElementById('userModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('userModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('userModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchUsers');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    const rows = document.querySelectorAll('.users-table tbody tr');
                    
                    rows.forEach(row => {
                        if (row.querySelector('td')) {
                            const text = row.textContent.toLowerCase();
                            const shouldShow = text.includes(searchTerm);
                            row.style.display = shouldShow ? '' : 'none';
                        }
                    });
                });
            }
        });
    </script>
@endsection