<aside class="sidebar-wrapper">
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <nav class="sidebar" id="app-sidebar">
        <header class="sidebar-header">
            <div class="sidebar-brand">
                <div class="brand-icon" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);">🏢</div>
                <span class="brand-name">Employer Hub</span>
            </div>
            <div class="user">
                <div class="avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div class="user-meta">
                    <p class="name">{{ auth()->user()->name }}</p>
                    <p class="role">Employer</p>
                </div>
            </div>
            <a href="{{ route('employer.jobs.create') }}" class="sidebar-create-btn">
                <span class="icon">➕</span>
                <span class="label">Post a Job</span>
            </a>
        </header>

        <div class="menu">
            <a href="{{ route('employer.dashboard') }}" data-tooltip="Dashboard"
                class="{{ request()->routeIs('employer.dashboard') ? 'active' : '' }}">
                <span class="icon">🏠</span>
                <span class="label">Dashboard</span>
            </a>
            <a href="{{ route('employer.jobs.index') }}" data-tooltip="My Jobs"
                class="{{ request()->routeIs('employer.jobs.*') ? 'active' : '' }}">
                <span class="icon">💼</span>
                <span class="label">My Jobs</span>
            </a>
            <a href="{{ route('employer.applications.index') }}" data-tooltip="Applications"
                class="{{ request()->routeIs('employer.applications.*') ? 'active' : '' }}">
                <span class="icon">📋</span>
                <span class="label">Applications</span>
            </a>
            <a href="{{ route('employer.profile.edit') }}" data-tooltip="Company Profile"
                class="{{ request()->routeIs('employer.profile.*') ? 'active' : '' }}">
                <span class="icon">🏢</span>
                <span class="label">Company Profile</span>
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