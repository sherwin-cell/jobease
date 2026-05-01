<aside class="sidebar-wrapper">
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <nav class="sidebar" id="app-sidebar">
        <header class="sidebar-header">
            <div class="sidebar-brand">
                <div class="brand-icon" style="background: linear-gradient(135deg, #1f2937 0%, #111827 100%);">🛡️</div>
                <span class="brand-name">Admin Portal</span>
            </div>
            <div class="user">
                <div class="avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div class="user-meta">
                    <p class="name">{{ auth()->user()->name }}</p>
                    <p class="role">Administrator</p>
                </div>
            </div>
        </header>

        <div class="menu">
            <a href="{{ route('admin.dashboard') }}" data-tooltip="Dashboard"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="icon">🏠</span>
                <span class="label">Dashboard</span>
            </a>
            <a href="{{ route('admin.users') }}" data-tooltip="Manage Users"
                class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <span class="icon">👥</span>
                <span class="label">Manage Users</span>
            </a>
            <a href="{{ route('admin.employer-profiles.index') }}" data-tooltip="Employer Profiles"
                class="{{ request()->routeIs('admin.employer-profiles.*') ? 'active' : '' }}">
                <span class="icon">🏢</span>
                <span class="label">Employer Profiles</span>
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