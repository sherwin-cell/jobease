@extends('layouts.app')

@section('title', 'Job Seeker Dashboard')

@section('head')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0d6efd;
            --primary-dark: #0b5ed7;
            --primary-light: #4c93ff;
            --secondary: #f59e0b;
            --success: #10b981;
            --sidebar-bg: #f8f9fa;
            --sidebar-border: #e9ecef;
            --sidebar-text: #495057;
            --sidebar-hover: #e9ecef;
            --sidebar-accent: #0d6efd;
            --neutral-50: #f9fafb;
            --neutral-100: #f3f4f6;
            --neutral-200: #e5e7eb;
            --neutral-300: #d1d5db;
            --neutral-600: #4b5563;
            --neutral-800: #1f2937;
            --neutral-900: #111827;
        }

        body {
            background: #f5f6f8;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
            gap: 0;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            padding: 1.5rem 1rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--sidebar-border);
            z-index: 1000;
            box-shadow: none;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.2);
        }

        /* Sidebar Logo/Header */
        .sidebar-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--sidebar-border);
        }

        .sidebar-logo {
            font-size: 1.3rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-logo:hover {
            color: var(--primary-dark);
        }

        .sidebar-logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        /* User Info Card */
        .user-info {
            margin-bottom: 2rem;
            padding: 1.25rem;
            background: white;
            border-radius: 10px;
            border: 1px solid var(--sidebar-border);
            transition: all 0.3s ease;
        }

        .user-info:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.08);
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .user-name {
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
            color: var(--neutral-900);
        }

        .user-role {
            font-size: 0.8rem;
            color: var(--sidebar-text);
            margin-bottom: 0.75rem;
        }

        .user-status {
            display: inline-block;
            padding: 0.3rem 0.75rem;
            background: #d4edda;
            color: #155724;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .user-edit-btn {
            margin-top: 0.75rem;
            padding: 0.5rem 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }

        .user-edit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* Sidebar Navigation */
        .sidebar-nav {
            list-style: none;
            flex: 1;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
            border-left: 3px solid transparent;
        }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .nav-link.active {
            background: rgba(13, 110, 253, 0.1);
            color: var(--primary);
            border-left-color: var(--primary);
            font-weight: 600;
        }

        .nav-icon {
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        /* Bottom Navigation */
        .sidebar-bottom {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--sidebar-border);
        }

        .bottom-nav {
            list-style: none;
        }

        .bottom-nav .nav-item {
            margin-bottom: 0.5rem;
        }

        .bottom-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
            border-left: 3px solid transparent;
            width: 100%;
            border: none;
            background: none;
            cursor: pointer;
        }

        .bottom-nav .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--primary);
            border-left-color: var(--primary);
        }

        /* ===== MAIN CONTENT ===== */
        .dashboard-content {
            flex: 1;
            margin-left: 260px;
            padding: 2.5rem;
            width: 100%;
        }

        /* Header Bar */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .dashboard-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--neutral-900);
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2.5rem;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(13, 110, 253, 0.12);
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -5%;
            width: 350px;
            height: 350px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-section h2 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .welcome-section p {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            border: 1px solid var(--sidebar-border);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.08);
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--sidebar-text);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .stat-change {
            font-size: 0.8rem;
            color: var(--success);
            font-weight: 600;
        }

        /* Content Sections */
        .dashboard-section {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid var(--sidebar-border);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--neutral-900);
        }

        .view-all-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .view-all-link:hover {
            color: var(--primary-dark);
            transform: translateX(4px);
        }

        /* Action Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Primary Card (Bigger) */
        .action-card.primary {
            grid-column: span 1;
        }

        .action-card {
            background: white;
            border-radius: 10px;
            padding: 1.75rem;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .action-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .action-card:hover::before {
            transform: scaleX(1);
        }

        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            display: block;
        }

        .action-card h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--neutral-900);
            margin-bottom: 0.5rem;
        }

        .action-card p {
            color: var(--sidebar-text);
            font-size: 0.9rem;
            margin-bottom: 1.25rem;
            line-height: 1.5;
            flex-grow: 1;
        }

        .action-btn {
            display: inline-block;
            padding: 0.75rem 1.25rem;
            background: var(--primary);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: 2px solid var(--primary);
            cursor: pointer;
            align-self: flex-start;
        }

        .action-btn:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        }

        .action-btn:active {
            transform: translateY(0);
        }

        /* Card Variants */
        .card-jobs .action-btn {
            background: var(--primary);
            border-color: var(--primary);
        }

        .card-jobs .action-btn:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .card-profile .action-btn {
            background: #6366f1;
            border-color: #6366f1;
        }

        .card-profile .action-btn:hover {
            background: #4f46e5;
            border-color: #4f46e5;
        }

        .card-applications .action-btn {
            background: var(--success);
            border-color: var(--success);
        }

        .card-applications .action-btn:hover {
            background: #059669;
            border-color: #059669;
        }

        /* Recent Items List */
        .items-list {
            list-style: none;
        }

        .items-list li {
            padding: 1rem 0;
            border-bottom: 1px solid var(--sidebar-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .items-list li:last-child {
            border-bottom: none;
        }

        .item-title {
            font-weight: 600;
            color: var(--neutral-900);
            font-size: 0.95rem;
        }

        .item-meta {
            font-size: 0.8rem;
            color: var(--sidebar-text);
        }

        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome-section,
        .stats-grid,
        .dashboard-section,
        .cards-grid {
            animation: slideInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:nth-child(1) {
            animation-delay: 0.05s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.15s;
        }

        .action-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .action-card:nth-child(2) {
            animation-delay: 0.15s;
        }

        .action-card:nth-child(3) {
            animation-delay: 0.2s;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 240px;
                padding: 1rem;
            }

            .dashboard-content {
                margin-left: 240px;
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 1rem;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                border-right: none;
                border-bottom: 1px solid var(--sidebar-border);
            }

            .dashboard-content {
                margin-left: 0;
                width: 100%;
                padding: 1.5rem 1rem;
            }

            .sidebar-header {
                margin-bottom: 0;
                padding-bottom: 0;
                border-bottom: none;
            }

            .user-info {
                display: none;
            }

            .sidebar-nav {
                display: flex;
                gap: 0.5rem;
                overflow-x: auto;
                flex: 1;
            }

            .nav-link {
                padding: 0.6rem 0.8rem;
                font-size: 0.8rem;
                gap: 0.5rem;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .dashboard-content {
                padding: 1rem;
            }

            .welcome-section {
                padding: 1.5rem 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .action-card {
                padding: 1.5rem;
            }
        }
    </style>
@endsection

@section('content')

    <div class="dashboard-wrapper">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <!-- Logo -->
            <div class="sidebar-header">
                <a href="{{ url('/') }}" class="sidebar-logo">
                    <div class="sidebar-logo-icon">💼</div>
                    <span>JobEase</span>
                </a>
            </div>

            <!-- User Info Card -->
            <div class="user-info">
                <div class="user-avatar">👤</div>
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">Job Seeker</div>
                <span class="user-status">✓ Verified</span>
                <button class="user-edit-btn" onclick="window.location='{{ route('jobseeker.profile.show') }}'">
                    Edit Profile
                </button>
            </div>

            <!-- Navigation -->
            <nav>
                <ul class="sidebar-nav">
                    <li class="nav-item">
                        <a href="{{ route('jobseeker.dashboard') }}" class="nav-link {{ request()->routeIs('jobseeker.dashboard') ? 'active' : '' }}">
                            <span class="nav-icon">🏠</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jobseeker.jobs.index') }}" class="nav-link {{ request()->routeIs('jobseeker.jobs.index') ? 'active' : '' }}">
                            <span class="nav-icon">💼</span>
                            <span>Browse Jobs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jobseeker.applications.index') }}" class="nav-link {{ request()->routeIs('jobseeker.applications.index') ? 'active' : '' }}">
                            <span class="nav-icon">📋</span>
                            <span>Applications</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jobseeker.profile.show') }}" class="nav-link {{ request()->routeIs('jobseeker.profile.show') ? 'active' : '' }}">
                            <span class="nav-icon">👤</span>
                            <span>My Profile</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Bottom Navigation -->
            <div class="sidebar-bottom">
                <ul class="bottom-nav">
                    <li class="nav-item">
                        <a href="{{ route('jobseeker.profile.show') }}" class="nav-link">
                            <span class="nav-icon">⚙️</span>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="nav-link">
                                <span class="nav-icon">🚪</span>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="dashboard-content">

            <!-- Header -->
            <div class="dashboard-header">
                <h1>Dashboard</h1>
                <div class="header-actions">
                    <span style="color: var(--sidebar-text); font-size: 0.9rem;">{{ now()->format('l, F j, Y') }}</span>
                </div>
            </div>

            <!-- Welcome Section -->
            <div class="welcome-section">
                <div class="welcome-content">
                    <h2>Welcome back, {{ auth()->user()->name }}! 👋</h2>
                    <p>You're {{ \Carbon\Carbon::now()->hour < 12 ? 'off to a great morning' : 'doing great today' }}. Here's your job search summary.</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Applications</div>
                    <div class="stat-value">12</div>
                    <div class="stat-change">📈 +3 this month</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Profile Views</div>
                    <div class="stat-value">45</div>
                    <div class="stat-change">📈 +8 this week</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Saved Jobs</div>
                    <div class="stat-value">28</div>
                    <div class="stat-change">🔖 Ready to apply</div>
                </div>
            </div>

            <!-- Primary Action Cards -->
            <div class="cards-grid">
                <!-- Browse Jobs (Primary) -->
                <a href="{{ route('jobseeker.jobs.index') }}" class="action-card card-jobs primary">
                    <span class="card-icon">💼</span>
                    <h3>Browse Jobs</h3>
                    <p>Explore the latest job opportunities that match your skills and preferences. Find your next career move.</p>
                    <div class="action-btn">View All Jobs</div>
                </a>

                <!-- My Applications -->
                <a href="{{ route('jobseeker.applications.index') }}" class="action-card card-applications">
                    <span class="card-icon">📋</span>
                    <h3>My Applications</h3>
                    <p>Track the status of all your job applications and stay updated with employer responses.</p>
                    <div class="action-btn">View Applications</div>
                </a>

                <!-- Edit Profile -->
                <a href="{{ route('jobseeker.profile.create') }}" class="action-card card-profile">
                    <span class="card-icon">✏️</span>
                    <h3>Update Profile</h3>
                    <p>Keep your profile complete and up-to-date. Increase chances of getting hired by employers.</p>
                    <div class="action-btn">Edit Profile</div>
                </a>
            </div>

            <!-- Recent Applications Section -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h3 class="section-title">Recent Applications</h3>
                    <a href="{{ route('jobseeker.applications.index') }}" class="view-all-link">View All →</a>
                </div>
                <ul class="items-list">
                    <li>
                        <div>
                            <div class="item-title">Senior Software Engineer</div>
                            <div class="item-meta">TechCorp Inc. • Applied 2 days ago</div>
                        </div>
                        <span class="status-badge status-pending">Pending</span>
                    </li>
                    <li>
                        <div>
                            <div class="item-title">UI/UX Designer</div>
                            <div class="item-meta">Creative Studios • Applied 1 week ago</div>
                        </div>
                        <span class="status-badge status-active">Reviewed</span>
                    </li>
                    <li>
                        <div>
                            <div class="item-title">Data Analyst</div>
                            <div class="item-meta">Analytics Plus • Applied 2 weeks ago</div>
                        </div>
                        <span class="status-badge status-pending">Pending</span>
                    </li>
                </ul>
            </div>

            <!-- Recommended Jobs Section -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h3 class="section-title">🌟 Recommended For You</h3>
                    <a href="{{ route('jobseeker.jobs.index') }}" class="view-all-link">See More →</a>
                </div>
                <ul class="items-list">
                    <li>
                        <div>
                            <div class="item-title">Full Stack Developer</div>
                            <div class="item-meta">StartUp Hub • Remote • $80K - $120K</div>
                        </div>
                        <a href="{{ route('jobseeker.jobs.index') }}" class="action-btn" style="padding: 0.5rem 1rem; font-size: 0.8rem;">Apply</a>
                    </li>
                    <li>
                        <div>
                            <div class="item-title">Product Manager</div>
                            <div class="item-meta">Global Tech • On-site • $100K - $150K</div>
                        </div>
                        <a href="{{ route('jobseeker.jobs.index') }}" class="action-btn" style="padding: 0.5rem 1rem; font-size: 0.8rem;">Apply</a>
                    </li>
                    <li>
                        <div>
                            <div class="item-title">Marketing Specialist</div>
                            <div class="item-meta">Growth Agency • Hybrid • $60K - $90K</div>
                        </div>
                        <a href="{{ route('jobseeker.jobs.index') }}" class="action-btn" style="padding: 0.5rem 1rem; font-size: 0.8rem;">Apply</a>
                    </li>
                </ul>
            </div>

        </div>

    </div>

@endsection