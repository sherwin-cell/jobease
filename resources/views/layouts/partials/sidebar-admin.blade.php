<div class="sidebar-menu">
    <div class="menu-section">
        <p class="menu-label">Main</p>
        <a href="{{ route('admin.dashboard') }}" data-tooltip="Dashboard" 
           class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2h-5v-7H9v7H5a2 2 0 0 1-2-2z"/>
                </svg>
            </span>
            <span class="menu-label">Dashboard</span>
        </a>

        <a href="{{ route('admin.users') }}" data-tooltip="Manage Users" 
           class="menu-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </span>
            <span class="menu-label">Users</span>
        </a>

        <a href="{{ route('admin.jobs') }}" data-tooltip="Job Postings" 
           class="menu-item {{ request()->routeIs('admin.jobs*') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                </svg>
            </span>
            <span class="menu-label">Job Postings</span>
        </a>
    </div>

    <div class="menu-section">
        <p class="menu-label">Management</p>
        <a href="{{ route('admin.employer-profiles.index') }}" data-tooltip="Employer Approvals" 
           class="menu-item {{ request()->routeIs('admin.employer-profiles*') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2h-5v-7H9v7H5a2 2 0 0 1-2-2z"/>
                    <path d="M9 22h6"/>
                </svg>
            </span>
            <span class="menu-label">Employer Approvals</span>
            @php
                $pendingCount = App\Models\EmployerProfile::where('approval_status', 'pending')->count();
            @endphp
            @if($pendingCount > 0)
                <span class="menu-badge pending">{{ $pendingCount }}</span>
            @endif
        </a>

        <a href="{{ route('admin.activity-logs') }}" data-tooltip="Activity Logs" 
           class="menu-item {{ request()->routeIs('admin.activity-logs*') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
            </span>
            <span class="menu-label">Activity Logs</span>
        </a>
    </div>
</div>

<footer class="sidebar-footer">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn" onclick="return confirm('Are you sure you want to log out?');">
            <span class="btn-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
            </span>
            <span class="btn-label">Logout</span>
        </button>
    </form>
</footer>