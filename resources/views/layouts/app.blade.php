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
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-right: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
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
        .menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track,
        .menu::-webkit-scrollbar-track {
            background: var(--gray-100);
        }

        .sidebar::-webkit-scrollbar-thumb,
        .menu::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover,
        .menu::-webkit-scrollbar-thumb:hover {
            background: var(--gray-400);
        }

        /* Header */
        .sidebar-header {
            padding: 20px 16px;
            border-bottom: 1px solid var(--gray-200);
            flex-shrink: 0;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            overflow: hidden;
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
        }

        .sidebar.collapsed .brand-name {
            display: none;
        }

        /* User Section */
        .user {
            display: flex;
            align-items: center;
            gap: 12px;
            overflow: hidden;
            padding: 8px 0;
        }

        .avatar {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary-light) 0%, #dbeafe 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 20px;
            box-shadow: var(--shadow-sm);
        }

        .user-meta {
            overflow: hidden;
            min-width: 0;
            flex: 1;
        }

        .user-meta .name {
            font-size: 14px;
            font-weight: 600;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: var(--gray-800);
        }

        .user-meta .role {
            font-size: 11px;
            color: var(--gray-500);
            margin: 2px 0 0;
            white-space: nowrap;
        }

        .sidebar.collapsed .user-meta {
            display: none;
        }

        /* Create Button (Employer) */
        .sidebar-create-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 16px;
            padding: 10px 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 12px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
            white-space: nowrap;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .sidebar-create-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .sidebar-create-btn .icon {
            font-size: 16px;
            flex-shrink: 0;
        }

        .sidebar.collapsed .sidebar-create-btn .label {
            display: none;
        }

        /* Menu */
        .menu {
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 12px;
            text-decoration: none;
            color: var(--gray-600);
            font-size: 14px;
            font-weight: 500;
            position: relative;
            transition: all 0.2s;
            white-space: nowrap;
            overflow: hidden;
        }

        .menu a:hover {
            background: var(--gray-100);
            color: var(--primary);
            transform: translateX(4px);
        }

        .menu a.active {
            background: linear-gradient(135deg, rgba(15, 40, 84, 0.08), rgba(73, 136, 196, 0.12));
            box-shadow: inset 0 0 0 1px rgba(73, 136, 196, 0.12);
            color: var(--primary);
            font-weight: 600;
            border-right: 3px solid var(--primary);
        }

        .menu a .icon {
            font-size: 20px;
            flex-shrink: 0;
            line-height: 1;
        }

        .menu a .label {
            font-weight: 500;
        }

        .sidebar.collapsed .menu a .label {
            display: none;
        }

        /* Tooltips for collapsed mode */
        .menu a[data-tooltip]::after {
            content: attr(data-tooltip);
            position: absolute;
            left: calc(var(--sidebar-closed) + 12px);
            top: 50%;
            transform: translateY(-50%) scale(0.95);
            background: var(--gray-900);
            color: white;
            font-size: 12px;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 8px;
            opacity: 0;
            pointer-events: none;
            white-space: nowrap;
            z-index: 9999;
            transition: opacity 0.2s, transform 0.2s;
            box-shadow: var(--shadow-lg);
        }

        .sidebar.collapsed .menu a:hover::after {
            opacity: 1;
            transform: translateY(-50%) scale(1);
        }

        .sidebar.expanded .menu a::after {
            display: none !important;
        }

        /* Footer */
        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--gray-200);
            flex-shrink: 0;
        }

        .sidebar-footer button {
            width: 100%;
            padding: 12px;
            border: none;
            background: transparent;
            color: var(--danger);
            display: flex;
            gap: 12px;
            align-items: center;
            border-radius: 12px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar-footer button:hover {
            background: #fef2f2;
            transform: translateX(4px) scale(1.015);
        }

        .sidebar-footer button .icon {
            font-size: 20px;
            flex-shrink: 0;
        }

        .sidebar.collapsed .sidebar-footer button .label {
            display: none;
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

        /* Hamburger Button */
        .hamburger-btn {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.35);
            box-shadow: 0 8px 24px rgba(15, 40, 84, 0.12);
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1100;
            width: 44px;
            height: 44px;
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            transition: all 0.2s;
            display: none;
        }

        .hamburger-btn:hover {
            background: var(--gray-100);
            transform: scale(1.05);
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

            .hamburger-btn {
                display: flex;
            }

            .sidebar {
                width: 280px !important;
                transform: translateX(-100%);
                box-shadow: var(--shadow-xl);
                transition: transform var(--sidebar-transition);
            }

            .sidebar.expanded {
                transform: translateX(0);
            }

            /* Always show labels on mobile when expanded */
            .sidebar.expanded .menu a .label,
            .sidebar.expanded .user-meta,
            .sidebar.expanded .brand-name,
            .sidebar.expanded .sidebar-footer button .label,
            .sidebar.expanded .sidebar-create-btn .label {
                display: inline-block !important;
            }

            .menu a[data-tooltip]::after {
                display: none !important;
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

        .app-content>* {
            animation: fadeInUp 0.4s ease-out;
        }

        /* Utility Classes */
        .gradient-text {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
</head>

<body>

    @auth
        @php
            $isJobSeeker = Auth::user()->isJobSeeker();
            $isAdmin = Auth::user()->isAdmin();
        @endphp

        <button class="hamburger-btn" id="hamburger-btn" aria-label="Toggle sidebar">☰</button>

        <div class="app-shell">
            @if ($isJobSeeker)
                @include('layouts.partials.sidebar-jobseeker')
            @elseif ($isAdmin)
                @include('layouts.partials.sidebar-admin')
            @else
                @include('layouts.partials.sidebar-employer')
            @endif

            <main class="app-main" id="app-main">
                <div class="app-content">
                    @include('layouts.partials.alerts')
                    @yield('content')
                </div>
            </main>
        </div>

        <script>
            const btn = document.getElementById('hamburger-btn');
            const sidebar = document.getElementById('app-sidebar');
            const main = document.getElementById('app-main');
            const overlay = document.getElementById('sidebar-overlay');

            const isMobile = () => window.innerWidth <= 768;
            let open = false;

            function openSidebar() {
                open = true;
                btn.textContent = '✕';
                btn.style.transform = 'rotate(90deg)';
                sidebar.classList.remove('collapsed');
                sidebar.classList.add('expanded');

                if (isMobile()) {
                    overlay.classList.add('active');
                } else {
                    main.classList.add('sidebar-open');
                }
            }

            function closeSidebar() {
                open = false;
                btn.textContent = '☰';
                btn.style.transform = 'rotate(0deg)';
                sidebar.classList.remove('expanded');
                overlay.classList.remove('active');

                if (!isMobile()) {
                    sidebar.classList.add('collapsed');
                    main.classList.remove('sidebar-open');
                }
            }

            // Desktop: start collapsed
            if (!isMobile()) {
                sidebar.classList.add('collapsed');
            }

            btn.addEventListener('click', () => open ? closeSidebar() : openSidebar());
            overlay.addEventListener('click', closeSidebar);

            window.addEventListener('resize', () => {
                if (!isMobile()) {
                    overlay.classList.remove('active');
                    if (open) {
                        sidebar.classList.add('expanded');
                        main.classList.add('sidebar-open');
                        sidebar.classList.remove('collapsed');
                    } else {
                        sidebar.classList.add('collapsed');
                        main.classList.remove('sidebar-open');
                        sidebar.classList.remove('expanded');
                    }
                } else {
                    main.classList.remove('sidebar-open');
                    if (!open) {
                        sidebar.classList.remove('expanded');
                    }
                }
            });
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