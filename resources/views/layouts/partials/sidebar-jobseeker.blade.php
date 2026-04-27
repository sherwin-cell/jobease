<aside class="sidebar-wrapper">

    <!-- TOGGLE -->
    <input type="checkbox" id="sidebar-toggle" class="sidebar-toggle" checked>

    <nav class="sidebar">

        <!-- HEADER -->
        <header class="sidebar-header">

            <label for="sidebar-toggle" class="toggle-btn">☰</label>

            <div class="user">
                <div class="avatar">👤</div>

                <div class="user-meta">
                    <p class="name">{{ auth()->user()->name }}</p>
                    <p class="role">Job Seeker</p>
                </div>
            </div>

        </header>

        <!-- MENU -->
        <div class="menu">

            <a href="{{ route('jobseeker.dashboard') }}" data-tooltip="Dashboard">
                🏠 <span>Dashboard</span>
            </a>

            <a href="{{ route('jobseeker.jobs.index') }}" data-tooltip="Browse Jobs">
                💼 <span>Browse Jobs</span>
            </a>

            <a href="{{ route('jobseeker.applications.index') }}" data-tooltip="Applications">
                📋 <span>Applications</span>
            </a>

            <a href="{{ route('jobseeker.profile.show') }}" data-tooltip="Profile">
                👤 <span>My Profile</span>
            </a>

        </div>

        <!-- FOOTER -->
        <footer class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    🚪 <span>Logout</span>
                </button>
            </form>
        </footer>

    </nav>

</aside>

<style>
/* ===== WRAPPER ===== */
.sidebar-wrapper {
    --open: 240px;
    --closed: 70px;

    position: fixed;
    inset: 0 auto 0 0;
}

/* HIDE CHECKBOX */
.sidebar-toggle {
    display: none;
}

/* ===== SIDEBAR ===== */
.sidebar {
    width: var(--open);
    height: 100vh;
    background: #ffffff;
    border-right: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    transition: 0.25s ease;
    overflow: hidden;
}

/* COLLAPSED */
.sidebar-toggle:not(:checked) ~ nav {
    width: var(--closed);
}

/* ===== HEADER ===== */
.sidebar-header {
    padding: 14px;
    border-bottom: 1px solid #eee;
}

.toggle-btn {
    font-size: 18px;
    cursor: pointer;
    display: inline-block;
    margin-bottom: 10px;
}

.user {
    display: flex;
    align-items: center;
    gap: 10px;
}

.avatar {
    width: 38px;
    height: 38px;
    background: #e5e7eb;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.user-meta .name {
    font-size: 13px;
    font-weight: 600;
}

.user-meta .role {
    font-size: 11px;
    color: #6b7280;
}

/* ===== MENU ===== */
.menu {
    padding: 10px;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    border-radius: 10px;
    text-decoration: none;
    color: #374151;
    font-size: 13px;
    position: relative;
    transition: 0.2s;
}

.menu a:hover {
    background: #f3f4f6;
}

/* HIDE TEXT WHEN COLLAPSED */
.sidebar-toggle:not(:checked) ~ nav a span {
    display: none;
}

/* TOOLTIP */
.menu a[data-tooltip]::before {
    content: attr(data-tooltip);
    position: absolute;
    left: 65px;
    background: #111827;
    color: #fff;
    font-size: 11px;
    padding: 4px 8px;
    border-radius: 6px;
    opacity: 0;
    transform: scale(0.9);
    transition: 0.2s;
    pointer-events: none;
    white-space: nowrap;
}

.sidebar-toggle:not(:checked) ~ nav a:hover::before {
    opacity: 1;
    transform: scale(1);
}

/* ===== FOOTER ===== */
.sidebar-footer {
    margin-top: auto;
    padding: 12px;
    border-top: 1px solid #eee;
}

.sidebar-footer button {
    width: 100%;
    padding: 10px;
    border: none;
    background: transparent;
    color: #dc2626;
    display: flex;
    gap: 10px;
    align-items: center;
    border-radius: 10px;
    cursor: pointer;
    font-size: 13px;
}

.sidebar-footer button:hover {
    background: #fef2f2;
}

/* COLLAPSED ICON ONLY */
.sidebar-toggle:not(:checked) ~ nav .user-meta,
.sidebar-toggle:not(:checked) ~ nav .sidebar-footer span {
    display: none;
}
</style>