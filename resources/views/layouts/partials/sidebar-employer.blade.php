<!-- Sidebar Menu for Employer -->
<div class="sidebar-menu">
    <div class="menu-section">
        <div class="menu-label">Main</div>

        <a href="{{ route('employer.dashboard') }}" data-tooltip="Dashboard"
            class="menu-item {{ request()->routeIs('employer.dashboard') ? 'active' : '' }}">
            <span class="menu-icon">
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon src="https://cdn.lordicon.com/jeuxydnh.json" trigger="hover" stroke="bold"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:250px;height:250px">
                </lord-icon>
            </span>
            <span class="menu-text">Dashboard</span>
        </a>

        <a href="{{ route('employer.jobs.index') }}" data-tooltip="My Jobs"
            class="menu-item {{ request()->routeIs('employer.jobs.*') ? 'active' : '' }}">
            <span class="menu-icon">
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon src="https://cdn.lordicon.com/zhiiqoue.json" trigger="loop" stroke="bold" state="loop-cycle"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:250px;height:250px">
                </lord-icon>
            </span>
            <span class="menu-text">My Jobs</span>
        </a>

        <a href="{{ route('employer.applications.index') }}" data-tooltip="Applications"
            class="menu-item {{ request()->routeIs('employer.applications.*') ? 'active' : '' }}">
            <span class="menu-icon">
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon src="https://cdn.lordicon.com/hmpomorl.json" trigger="hover" stroke="bold"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:250px;height:250px">
                </lord-icon>
            </span>
            <span class="menu-text">Applications</span>
        </a>

        <a href="{{ route('employer.profile.edit') }}" data-tooltip="Company Profile"
            class="menu-item {{ request()->routeIs('employer.profile.*') ? 'active' : '' }}">
            <span class="menu-icon">
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon src="https://cdn.lordicon.com/rpviwvwn.json" trigger="hover" stroke="bold"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:250px;height:250px">
                </lord-icon>
            </span>
            <span class="menu-text">Company Profile</span>
        </a>
    </div>

    <div class="menu-section">
        <div class="menu-label">Quick Actions</div>

        <a href="{{ route('employer.jobs.create') }}" data-tooltip="Post a Job"
            class="menu-item {{ request()->routeIs('employer.jobs.create') ? 'active' : '' }}">
            <span class="menu-icon">
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon src="https://cdn.lordicon.com/vjgknpfx.json" trigger="hover" stroke="bold"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:250px;height:250px">
                </lord-icon>
            </span>
            <span class="menu-text">Post a Job</span>
        </a>
    </div>
</div>