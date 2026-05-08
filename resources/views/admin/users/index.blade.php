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

    /* ===== BUTTONS ===== */
    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #2563eb;
        color: #fff;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.625rem 1.25rem;
        border-radius: 0.75rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.15s;
        white-space: nowrap;
        gap: 0.5rem;
    }
    .btn-primary:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }

    /* ===== STATS CARDS ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
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
        box-shadow: 0 4px 16px rgba(0,0,0,0.07);
        border-color: #d1d5db;
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
        box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
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
    }
    .users-table {
        width: 100%;
        border-collapse: collapse;
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
    .user-badge {
        font-size: 0.6875rem;
        color: #6b21a5;
        margin-top: 0.125rem;
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
    .status-active { background: #dcfce7; color: #15803d; }
    .status-banned { background: #fee2e2; color: #b91c1c; }
    .status-dot {
        width: 0.375rem;
        height: 0.375rem;
        border-radius: 50%;
    }
    .status-active .status-dot { background: #15803d; }
    .status-banned .status-dot { background: #b91c1c; }

    /* ===== ROLE BADGES ===== */
    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    .role-jobseeker { background: #dbeafe; color: #1d4ed8; }
    .role-employer { background: #dcfce7; color: #15803d; }
    .role-admin { background: #f3e8ff; color: #6b21a5; }

    /* ===== ACTION BUTTONS ===== */
    .action-buttons {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.15s;
        border: none;
    }
    .action-view {
        background: #fff;
        color: #6b7280;
        border: 1px solid #e5e7eb;
    }
    .action-view:hover {
        background: #f9fafb;
        color: #2563eb;
        border-color: #d1d5db;
    }
    .action-ban {
        background: #fef3c7;
        color: #d97706;
    }
    .action-ban:hover {
        background: #fde68a;
    }
    .action-unban {
        background: #dcfce7;
        color: #15803d;
    }
    .action-unban:hover {
        background: #bbf7d0;
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

    /* ===== PAGINATION ===== */
    .pagination-wrapper {
        padding: 1rem;
        border-top: 1px solid #e5e7eb;
        background: #f9fafb;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }
        .stat-value {
            font-size: 1.5rem;
        }
        .page-header {
            flex-direction: column;
        }
        .users-table th,
        .users-table td {
            padding: 0.75rem;
        }
        .action-buttons {
            flex-direction: column;
            align-items: flex-start;
        }
        .action-btn {
            padding: 0.25rem 0.5rem;
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
            <div class="flex gap-3">
                <div class="search-wrapper">
                    <input type="text" id="searchUsers" placeholder="Search users..." class="search-input">
                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Stats Cards - 3 Cards Only -->
        <div class="stats-grid">
            <!-- Total Users Card -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-gray-900">{{ $users->count() }}</div>
                    <div class="stat-icon bg-blue-100">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Total Users</div>
            </div>

            <!-- Active Users Card -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-green-600">{{ $users->where('is_banned', false)->count() }}</div>
                    <div class="stat-icon bg-green-100">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-label">Active Users</div>
            </div>

            <!-- Banned Users Card -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-value text-red-600">{{ $users->where('is_banned', true)->count() }}</div>
                    <div class="stat-icon bg-red-100">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert-error">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                                    @if($user->role_id == 3)
                                        <span class="user-badge">Administrator</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td><span class="text-gray-600">{{ $user->email }}</span></td>
                        <td>
                            @php
                                $roleClass = match($user->role_id) {
                                    1 => 'role-jobseeker',
                                    2 => 'role-employer',
                                    3 => 'role-admin',
                                    default => 'role-jobseeker'
                                };
                                $roleLabel = match($user->role_id) {
                                    1 => 'Job Seeker',
                                    2 => 'Employer',
                                    3 => 'Admin',
                                    default => 'User'
                                };
                            @endphp
                            <span class="role-badge {{ $roleClass }}">{{ $roleLabel }}</span>
                        </td>
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
                        </td>
                        <td><span class="text-gray-500">{{ $user->created_at->format('M d, Y') }}</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn action-view" title="View Details">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View
                                </button>

                                @if($user->is_banned)
                                    <form action="{{ route('admin.users.unban', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="action-btn action-unban" title="Unban User">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Unban
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.ban', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="action-btn action-ban" title="Ban User" onclick="return confirm('Are you sure you want to ban this user?')">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                            </svg>
                                            Ban
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div class="empty-title">No users found</div>
                                <p class="empty-sub">Users will appear here as they register on the platform</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($users) && method_exists($users, 'hasPages') && $users->hasPages())
        <div class="pagination-wrapper">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchUsers');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('.users-table tbody tr');
                rows.forEach(row => {
                    if (row.querySelector('td')) {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchTerm) ? '' : 'none';
                    }
                });
            });
        }
    });
</script>
@endsection