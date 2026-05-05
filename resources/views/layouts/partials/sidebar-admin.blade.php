<aside class="sidebar-wrapper">
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <!-- Mobile Burger Button -->
    <button class="burger-btn" id="burger-btn">
        <span class="burger-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </button>

    <nav class="sidebar" id="app-sidebar">
        <header class="sidebar-header">
            <div class="sidebar-brand">
                <div class="brand-icon">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="32" height="32" rx="8" fill="url(#gradient)" />
                        <path d="M16 8L20 12L16 16L12 12L16 8Z" fill="white" stroke="white" stroke-width="1" />
                        <path d="M16 14L20 18L16 22L12 18L16 14Z" fill="white" stroke="white" stroke-width="1" />
                        <defs>
                            <linearGradient id="gradient" x1="0" y1="0" x2="32" y2="32" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#4361ee" />
                                <stop offset="1" stop-color="#7209b7" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <span class="brand-name">JobEase Admin</span>
            </div>
            <button class="sidebar-close" id="sidebar-close">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </header>

        <div class="sidebar-menu">
            <div class="menu-section">
                <p class="menu-label">Main</p>
                <a href="{{ route('admin.dashboard') }}" data-tooltip="Dashboard"
                    class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2h-5v-7H9v7H5a2 2 0 0 1-2-2z" />
                        </svg>
                    </span>
                    <span class="menu-label">Dashboard</span>
                    @if(request()->routeIs('admin.dashboard'))
                    @endif
                </a>

                <a href="{{ route('admin.users') }}" data-tooltip="Manage Users"
                    class="menu-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </span>
                    <span class="menu-label">Users</span>
                </a>

                <a href="{{ route('admin.jobs') }}" data-tooltip="Job Postings"
                    class="menu-item {{ request()->routeIs('admin.jobs*') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
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
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2h-5v-7H9v7H5a2 2 0 0 1-2-2z" />
                            <path d="M9 22h6" />
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
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                            <polyline points="10 9 9 9 8 9" />
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
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" y1="12" x2="9" y2="12" />
                        </svg>
                    </span>
                    <span class="btn-label">Logout</span>
                </button>
            </form>
        </footer>
    </nav>
</aside>

<style>
    /* Sidebar Styles */
    .sidebar-wrapper {
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        z-index: 1000;
    }

    /* Burger Button */
    .burger-btn {
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 1001;
        width: 45px;
        height: 45px;
        background: white;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .burger-btn:hover {
        background: #f8f9fa;
        transform: scale(1.05);
    }

    .burger-icon {
        width: 24px;
        height: 18px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .burger-icon span {
        width: 100%;
        height: 2px;
        background: #4361ee;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 280px;
        height: 100vh;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        color: #fff;
        display: flex;
        flex-direction: column;
        transform: translateX(0);
        transition: transform 0.3s ease;
        z-index: 1000;
        overflow-y: auto;
    }

    .sidebar-header {
        padding: 24px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .brand-name {
        font-size: 18px;
        font-weight: 600;
        background: linear-gradient(135deg, #fff, #a8b2ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .sidebar-close {
        display: none;
        background: none;
        border: none;
        color: #fff;
        cursor: pointer;
        padding: 5px;
    }

    .sidebar-menu {
        flex: 1;
        padding: 20px 16px;
    }

    .menu-section {
        margin-bottom: 28px;
    }

    .menu-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.5;
        margin-bottom: 12px;
        padding-left: 12px;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 16px;
        margin: 4px 0;
        border-radius: 12px;
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
    }

    .menu-item:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .menu-item.active {
        background: linear-gradient(135deg, #4361ee, #7209b7);
        color: white;
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
    }

    .menu-icon {
        width: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .menu-badge {
        margin-left: auto;
        font-size: 11px;
        background: #ef476f;
        padding: 2px 8px;
        border-radius: 20px;
        color: white;
    }

    .menu-badge.pending {
        background: #ff9f1c;
    }

    .sidebar-footer {
        padding: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .logout-btn {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 16px;
        background: rgba(255, 255, 255, 0.05);
        border: none;
        border-radius: 12px;
        color: rgba(255, 255, 255, 0.7);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        background: rgba(239, 71, 111, 0.2);
        color: #ef476f;
    }

    /* Overlay */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 999;
        display: none;
    }

    /* Mobile Styles */
    @media (max-width: 768px) {
        .burger-btn {
            display: flex;
        }

        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar-close {
            display: block;
        }

        .sidebar-overlay.active {
            display: block;
        }
    }
</style>

<script>
    // Sidebar Toggle for Mobile
    const burgerBtn = document.getElementById('burger-btn');
    const sidebar = document.getElementById('app-sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const sidebarClose = document.getElementById('sidebar-close');

    function openSidebar() {
        sidebar.classList.add('open');
        sidebarOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (burgerBtn) {
        burgerBtn.addEventListener('click', openSidebar);
    }

    if (sidebarClose) {
        sidebarClose.addEventListener('click', closeSidebar);
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    // Close sidebar on escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && sidebar.classList.contains('open')) {
            closeSidebar();
        }
    });
</script>