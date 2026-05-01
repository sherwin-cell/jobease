<aside class="sidebar-wrapper">
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <nav class="sidebar" id="app-sidebar">
        <header class="sidebar-header">
            <div class="sidebar-brand">
                <div class="brand-icon" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);">💼</div>
                <span class="brand-name">JobSeeker</span>
            </div>
            <div class="user">
                <div class="avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div class="user-meta">
                    <p class="name">{{ auth()->user()->name }}</p>
                    <p class="role">Job Seeker</p>
                </div>
            </div>
        </header>

        <div class="menu">
            <a href="{{ route('jobseeker.dashboard') }}" data-tooltip="Dashboard"
                class="{{ request()->routeIs('jobseeker.dashboard') ? 'active' : '' }}">
                <span class="icon">🏠</span>
                <span class="label">Dashboard</span>
            </a>
            <a href="{{ route('jobseeker.jobs.index') }}" data-tooltip="Browse Jobs"
                class="{{ request()->routeIs('jobseeker.jobs.*') ? 'active' : '' }}">
                <span class="icon">💼</span>
                <span class="label">Browse Jobs</span>
            </a>
            <a href="{{ route('jobseeker.applications.index') }}" data-tooltip="My Applications"
                class="{{ request()->routeIs('jobseeker.applications.*') ? 'active' : '' }}">
                <span class="icon">📋</span>
                <span class="label">Applications</span>
            </a>
            <a href="{{ route('jobseeker.profile.show') }}" data-tooltip="My Profile"
                class="{{ request()->routeIs('jobseeker.profile.*') ? 'active' : '' }}">
                <span class="icon">👤</span>
                <span class="label">My Profile</span>
            </a>
        </div>

        <footer class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" onclick="return confirm('Are you sure you want to log out?');">
                    <span class="icon">🚪</span>
                    <span class="label">Logout</span>
                </button>
            </form>
        </footer>
    </nav>
</aside>