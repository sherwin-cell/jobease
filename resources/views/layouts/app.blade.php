<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Jobease') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head')

    <style>
        /* ============================================================
           GLOBAL DESIGN SYSTEM
        ============================================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #eff6ff;
            --secondary: #64748b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;

            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;

            --sidebar-open: 260px;
            --sidebar-closed: 72px;
            --sidebar-transition: 0.25s cubic-bezier(0.4, 0, 0.2, 1);

            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(73, 136, 196, 0.12), transparent 35%),
                radial-gradient(circle at bottom right, rgba(15, 40, 84, 0.10), transparent 40%),
                linear-gradient(135deg, #f8fafc 0%, #eef6ff 45%, #ffffff 100%);
            color: var(--gray-800);
            min-height: 100vh;
        }

        /* ============================================================
           SIDEBAR STYLES
        ============================================================ */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 998;
            opacity: 0;
            transition: opacity var(--sidebar-transition);
        }

        .sidebar-overlay.active {
            opacity: 1;
            pointer-events: all;
        }

        .sidebar-wrapper {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1000;
            pointer-events: none;
        }

        .sidebar {
            width: var(--sidebar-closed);
            height: 100vh;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(18px);
            border-right: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1000;
            pointer-events: all;
            transition: width var(--sidebar-transition);
            box-shadow: var(--shadow-lg);
        }

        .sidebar.expanded {
            width: var(--sidebar-open);
        }

        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar,
        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track,
        .sidebar-menu::-webkit-scrollbar-track {
            background: var(--gray-100);
        }

        .sidebar::-webkit-scrollbar-thumb,
        .sidebar-menu::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 10px;
        }

        /* Header */
        .sidebar-header {
            padding: 20px 16px;
            border-bottom: 1px solid var(--gray-200);
            flex-shrink: 0;
        }

        .sidebar-header-inline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            overflow: hidden;
            flex: 1;
        }

        .brand-icon {
            background: linear-gradient(135deg, #0F2854 0%, #1C4D8D 45%, #4988C4 100%);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            box-shadow: var(--shadow-md);
        }

        .brand-name {
            font-size: 18px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--gray-800) 0%, var(--primary) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            white-space: nowrap;
            transition: opacity var(--sidebar-transition);
        }

        /* Hamburger button inside sidebar - ALWAYS VISIBLE */
        .sidebar-hamburger {
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 10px;
            display: flex !important; /* Always show */
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            flex-shrink: 0;
            color: var(--gray-600);
        }

        .sidebar-hamburger:hover {
            background: var(--gray-100);
            color: var(--primary);
            transform: scale(1.05);
        }

        .sidebar-hamburger svg {
            width: 22px;
            height: 22px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
            transition: transform 0.3s ease;
        }

        /* Rotate icon when expanded */
        .sidebar.expanded .sidebar-hamburger svg {
            transform: rotate(90deg);
        }

        /* Menu */
        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .menu-section {
            padding: 16px 12px;
            border-bottom: 1px solid var(--gray-100);
            transition: padding var(--sidebar-transition);
        }

        .menu-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--gray-500);
            margin-bottom: 12px;
            padding-left: 12px;
            transition: opacity var(--sidebar-transition);
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            margin: 4px 0;
            border-radius: 12px;
            text-decoration: none;
            color: var(--gray-700);
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            white-space: nowrap;
            overflow: hidden;
            position: relative;
        }

        .menu-item:hover {
            background: var(--gray-100);
            color: var(--primary);
            transform: translateX(4px);
        }

        .menu-item.active {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.1), rgba(37, 99, 235, 0.05));
            color: var(--primary);
            font-weight: 600;
            border-right: 3px solid var(--primary);
        }

        .menu-text {
            transition: opacity var(--sidebar-transition);
        }

        .menu-icon {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-icon svg {
            width: 20px;
            height: 20px;
        }

        .menu-badge {
            margin-left: auto;
            font-size: 11px;
            background: #ef476f;
            padding: 2px 8px;
            border-radius: 20px;
            color: white;
            transition: all var(--sidebar-transition);
        }

        .menu-badge.pending {
            background: #ff9f1c;
        }

        /* ============================================================
           COLLAPSED SIDEBAR STYLES - HIDE TEXT (Hamburger OFF)
        ============================================================ */
        
        /* Hide brand name when collapsed */
        .sidebar.collapsed .brand-name {
            display: none;
        }

        /* Center brand icon when collapsed */
        .sidebar.collapsed .sidebar-brand {
            justify-content: center;
        }

        /* Hide all menu labels/section headers when collapsed */
        .sidebar.collapsed .menu-label {
            display: none;
        }

        /* Hide menu text and badges when collapsed */
        .sidebar.collapsed .menu-text,
        .sidebar.collapsed .menu-badge {
            display: none;
        }

        /* Adjust menu section padding when collapsed */
        .sidebar.collapsed .menu-section {
            padding: 12px 0;
        }

        /* Center menu items and remove gap when collapsed */
        .sidebar.collapsed .menu-item {
            justify-content: center;
            padding: 12px;
            gap: 0;
        }

        /* Remove translate effect on hover when collapsed */
        .sidebar.collapsed .menu-item:hover {
            transform: translateX(0);
        }

        /* Adjust active indicator for collapsed mode */
        .sidebar.collapsed .menu-item.active {
            border-right: none;
            border-left: 3px solid var(--primary);
        }

        /* Hide logout button text when collapsed */
        .sidebar.collapsed .logout-btn .btn-label {
            display: none;
        }

        /* Center logout button icon when collapsed */
        .sidebar.collapsed .logout-btn {
            justify-content: center;
            padding: 12px;
            gap: 0;
        }

        /* Tooltips for collapsed mode - show on hover */
        .sidebar.collapsed .menu-item[data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            left: calc(var(--sidebar-closed) + 8px);
            top: 50%;
            transform: translateY(-50%);
            background: var(--gray-900);
            color: white;
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 8px;
            white-space: nowrap;
            z-index: 9999;
            box-shadow: var(--shadow-lg);
            pointer-events: none;
            animation: fadeIn 0.2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-50%) translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(-50%) translateX(0);
            }
        }

        /* ============================================================
           EXPANDED SIDEBAR STYLES - SHOW TEXT (Hamburger ON)
        ============================================================ */
        .sidebar.expanded .brand-name {
            display: block;
        }

        .sidebar.expanded .sidebar-brand {
            justify-content: flex-start;
        }

        .sidebar.expanded .menu-label {
            display: block;
        }

        .sidebar.expanded .menu-text {
            display: inline;
        }

        .sidebar.expanded .menu-badge {
            display: inline-block;
        }

        .sidebar.expanded .menu-item {
            justify-content: flex-start;
            padding: 10px 12px;
            gap: 12px;
        }

        .sidebar.expanded .logout-btn .btn-label {
            display: inline;
        }

        .sidebar.expanded .logout-btn {
            justify-content: flex-start;
            padding: 10px 12px;
            gap: 12px;
        }

        /* Footer */
        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid var(--gray-200);
            flex-shrink: 0;
        }

        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            background: transparent;
            border: none;
            border-radius: 12px;
            color: var(--danger);
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            white-space: nowrap;
            overflow: hidden;
        }

        .logout-btn:hover {
            background: #fef2f2;
            transform: translateX(4px);
        }

        .logout-btn .btn-icon {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
        }

        /* ============================================================
           MAIN CONTENT LAYOUT
        ============================================================ */
        .app-shell {
            min-height: 100vh;
            display: flex;
        }

        .app-main {
            flex: 1;
            min-height: 100vh;
            margin-left: var(--sidebar-closed);
            transition: margin-left var(--sidebar-transition);
        }

        .app-main.sidebar-open {
            margin-left: var(--sidebar-open);
        }

        .app-content {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 24px 32px;
        }

        /* Mobile hamburger button (visible only on mobile) */
        .mobile-hamburger {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1100;
            width: 44px;
            height: 44px;
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            transition: all 0.2s;
            color: var(--gray-700);
        }

        .mobile-hamburger:hover {
            background: var(--gray-100);
            transform: scale(1.05);
        }

        .mobile-hamburger svg {
            width: 24px;
            height: 24px;
            stroke: currentColor;
            stroke-width: 2;
        }

        /* ============================================================
           RESPONSIVE DESIGN
        ============================================================ */
        @media (max-width: 1024px) {
            .app-content {
                padding: 20px 24px;
            }
        }

        @media (max-width: 768px) {
            .sidebar-overlay {
                display: block;
            }

            .mobile-hamburger {
                display: flex;
            }

            .sidebar {
                width: 280px !important;
                transform: translateX(-100%);
                transition: transform var(--sidebar-transition);
            }

            .sidebar.expanded {
                transform: translateX(0);
                width: 280px !important;
            }

            .app-main,
            .app-main.sidebar-open {
                margin-left: 0 !important;
            }

            .app-content {
                padding: 80px 16px 24px;
            }
        }

        @media (max-width: 640px) {
            .app-content {
                padding: 76px 12px 20px;
            }
        }

        /* Loading Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .app-content > * {
            animation: fadeInUp 0.4s ease-out;
        }
    </style>
</head>

<body>
    @auth
        @php
            $isJobSeeker = Auth::user()->isJobSeeker();
            $isAdmin = Auth::user()->isAdmin();
        @endphp

        <!-- Mobile hamburger button (visible only on mobile) -->
        <button class="mobile-hamburger" id="mobile-hamburger" aria-label="Toggle Sidebar">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M3 12h18M3 6h18M3 18h18"/>
            </svg>
        </button>

        <div class="app-shell">
            <!-- Sidebar Structure -->
            <aside class="sidebar-wrapper">
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <nav class="sidebar" id="app-sidebar">
                    <header class="sidebar-header">
                        <div class="sidebar-header-inline">
                            <div class="sidebar-brand">
                                <div class="brand-icon">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                        <rect width="32" height="32" rx="8" fill="url(#gradient)" />
                                        <path d="M16 8L20 12L16 16L12 12L16 8Z" fill="white" />
                                        <path d="M16 14L20 18L16 22L12 18L16 14Z" fill="white" />
                                        <defs>
                                            <linearGradient id="gradient" x1="0" y1="0" x2="32" y2="32">
                                                <stop stop-color="#4361ee" />
                                                <stop offset="1" stop-color="#7209b7" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>
                                <span class="brand-name">JobEase</span>
                            </div>
                            <button class="sidebar-hamburger" id="sidebar-hamburger" aria-label="Toggle Sidebar">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M4 6L20 6M4 12L20 12M4 18L20 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </button>
                        </div>
                    </header>

                    <!-- Dynamic Sidebar Content -->
                    @if ($isJobSeeker)
                        @include('layouts.partials.sidebar-jobseeker')
                    @elseif ($isAdmin)
                        @include('layouts.partials.sidebar-admin')
                    @else
                        @include('layouts.partials.sidebar-employer')
                    @endif
                </nav>
            </aside>

            <main class="app-main" id="app-main">
                <div class="app-content">
                    @include('layouts.partials.alerts')
                    @yield('content')
                </div>
            </main>
        </div>

        <script>
            // DOM Elements
            const mobileHamburger = document.getElementById('mobile-hamburger');
            const sidebarHamburger = document.getElementById('sidebar-hamburger');
            const sidebar = document.getElementById('app-sidebar');
            const main = document.getElementById('app-main');
            const overlay = document.getElementById('sidebar-overlay');

            // State variables
            let isOpen = false;
            let isMobileView = window.innerWidth <= 768;

            // Helper functions
            const isMobile = () => window.innerWidth <= 768;

            function updateSidebarState() {
                const mobile = isMobile();
                
                if (mobile) {
                    // Mobile behavior - sidebar slides in/out
                    if (isOpen) {
                        sidebar.classList.add('expanded');
                        sidebar.classList.remove('collapsed');
                        overlay.classList.add('active');
                        document.body.style.overflow = 'hidden';
                    } else {
                        sidebar.classList.remove('expanded');
                        sidebar.classList.remove('collapsed');
                        overlay.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                    main.classList.remove('sidebar-open');
                } else {
                    // Desktop behavior - sidebar expands/collapses in place
                    if (isOpen) {
                        sidebar.classList.add('expanded');
                        sidebar.classList.remove('collapsed');
                        main.classList.add('sidebar-open');
                    } else {
                        sidebar.classList.remove('expanded');
                        sidebar.classList.add('collapsed');
                        main.classList.remove('sidebar-open');
                    }
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }

            function openSidebar() {
                isOpen = true;
                updateSidebarState();
                saveSidebarState();
            }

            function closeSidebar() {
                isOpen = false;
                updateSidebarState();
                saveSidebarState();
            }

            function toggleSidebar() {
                if (isOpen) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            }

            // Save sidebar state to localStorage
            function saveSidebarState() {
                localStorage.setItem('sidebarOpen', isOpen);
            }

            // Load sidebar state from localStorage
            function loadSidebarState() {
                const saved = localStorage.getItem('sidebarOpen');
                const mobile = isMobile();
                
                if (saved !== null) {
                    isOpen = saved === 'true';
                } else {
                    // Default: closed on desktop
                    isOpen = false;
                }
                
                updateSidebarState();
            }

            // Event Listeners
            if (sidebarHamburger) {
                sidebarHamburger.addEventListener('click', (e) => {
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            if (mobileHamburger) {
                mobileHamburger.addEventListener('click', () => {
                    toggleSidebar();
                });
            }

            if (overlay) {
                overlay.addEventListener('click', () => {
                    if (isMobile()) {
                        closeSidebar();
                    }
                });
            }

            // Handle window resize
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    const wasMobile = isMobileView;
                    isMobileView = isMobile();
                    
                    if (wasMobile !== isMobileView) {
                        updateSidebarState();
                    }
                }, 150);
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', (e) => {
                if (isMobile() && isOpen) {
                    const isClickInsideSidebar = sidebar.contains(e.target);
                    const isClickOnHamburger = mobileHamburger.contains(e.target);
                    
                    if (!isClickInsideSidebar && !isClickOnHamburger) {
                        closeSidebar();
                    }
                }
            });

            // Keyboard shortcut: Ctrl/Cmd + B to toggle sidebar
            document.addEventListener('keydown', (e) => {
                if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
                    e.preventDefault();
                    toggleSidebar();
                }
                
                // Escape key to close sidebar
                if (e.key === 'Escape' && isOpen) {
                    closeSidebar();
                }
            });

            // Initialize
            loadSidebarState();
        </script>
    @endauth

    @guest
        <div class="app-shell">
            <main class="app-main" style="margin-left: 0;">
                <div class="app-content">
                    @yield('content')
                </div>
            </main>
        </div>
    @endguest
</body>

</html>