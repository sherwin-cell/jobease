<!-- Sidebar Menu for Job Seeker -->
<div class="sidebar-menu">
    <div class="menu-section">
        <div class="menu-label">Main</div>
        
        <a href="{{ route('jobseeker.dashboard') }}" data-tooltip="Dashboard"
           class="menu-item {{ request()->routeIs('jobseeker.dashboard') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2h-5v-7H9v7H5a2 2 0 0 1-2-2z"/>
                </svg>
            </span>
            <span class="menu-text">Dashboard</span>
        </a>

        <a href="{{ route('jobseeker.jobs.index') }}" data-tooltip="Browse Jobs"
           class="menu-item {{ request()->routeIs('jobseeker.jobs.*') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                </svg>
            </span>
            <span class="menu-text">Browse Jobs</span>
        </a>

        <a href="{{ route('jobseeker.applications.index') }}" data-tooltip="My Applications"
           class="menu-item {{ request()->routeIs('jobseeker.applications.*') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2z"/>
                </svg>
            </span>
            <span class="menu-text">My Applications</span>
        </a>

        <a href="{{ route('jobseeker.profile.show') }}" data-tooltip="My Profile"
           class="menu-item {{ request()->routeIs('jobseeker.profile.*') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </span>
            <span class="menu-text">My Profile</span>
        </a>
    </div>
</div>

<footer class="sidebar-footer">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn" onclick="return confirm('Are you sure you want to log out?');">
            <span class="btn-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
            </span>
            <span class="btn-label">Logout</span>
        </button>
    </form>
</footer>