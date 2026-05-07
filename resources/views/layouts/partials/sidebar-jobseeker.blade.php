<!-- Sidebar Menu for Job Seeker -->
<div class="sidebar-menu">
    <div class="menu-section">
        <div class="menu-label">Main</div>
        <a href="{{ route('jobseeker.dashboard') }}" data-tooltip="Dashboard"
            class="menu-item {{ request()->routeIs('jobseeker.dashboard') ? 'active' : '' }}">
            <span class="menu-icon">
                <lord-icon src="https://cdn.lordicon.com/jeuxydnh.json" trigger="hover" stroke="bold"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:24px;height:24px">
                </lord-icon>
            </span>
            <span class="menu-text">Dashboard</span>
        </a>

        <a href="{{ route('jobseeker.jobs.index') }}" data-tooltip="Browse Jobs"
            class="menu-item {{ request()->routeIs('jobseeker.jobs.*') ? 'active' : '' }}">
            <span class="menu-icon">
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon src="https://cdn.lordicon.com/zhiiqoue.json" trigger="loop" stroke="bold" state="loop-cycle"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:250px;height:250px">
                </lord-icon>
            </span>
            <span class="menu-text">Browse Jobs</span>
        </a>

        <a href="{{ route('jobseeker.jobs.index') }}" data-tooltip="Browse Jobs"
            class="menu-item {{ request()->routeIs('jobseeker.jobs.*') ? 'active' : '' }}">
            <span class="menu-icon">
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon src="https://cdn.lordicon.com/hmpomorl.json" trigger="hover" stroke="bold"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:250px;height:250px">
                </lord-icon>
            </span>
            <span class="menu-text">Browse Jobs</span>
        </a>

        <a href="{{ route('jobseeker.profile.show') }}" data-tooltip="My Profile"
            class="menu-item {{ request()->routeIs('jobseeker.profile.*') ? 'active' : '' }}">
            <span class="menu-icon">
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon src="https://cdn.lordicon.com/shcfcebj.json" trigger="hover" stroke="bold"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:250px;height:250px">
                </lord-icon>
            </span>
            <span class="menu-text">My Profile</span>
        </a>
    </div>
</div>