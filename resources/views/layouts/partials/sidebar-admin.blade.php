<div class="sidebar-menu">
    <div class="menu-section">
        <p class="menu-label">Main</p>
        <a href="{{ route('admin.dashboard') }}" data-tooltip="Dashboard"
            class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="menu-icon">
                <lord-icon src="https://cdn.lordicon.com/jeuxydnh.json" trigger="hover" stroke="bold"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:20px;height:20px">
                </lord-icon>
            </span>
            <span class="menu-text">Dashboard</span>
        </a>

        <a href="{{ route('admin.users') }}" data-tooltip="Manage Users"
            class="menu-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <span class="menu-icon">
                <lord-icon src="https://cdn.lordicon.com/jdgfsfzr.json" trigger="hover" stroke="bold"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:20px;height:20px">
                </lord-icon>
            </span>
            <span class="menu-text">Users</span>
        </a>

        <a href="{{ route('admin.jobs.index') }}" data-tooltip="Job Postings"
            class="menu-item {{ request()->routeIs('admin.jobs*') ? 'active' : '' }}">
            <span class="menu-icon">
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon src="https://cdn.lordicon.com/zhiiqoue.json" trigger="loop" stroke="bold" state="loop-cycle"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:250px;height:250px">
                </lord-icon>
            </span>
            <span class="menu-label">Job Postings</span>
        </a>
    </div>

    <div class="menu-section">
        <p class="menu-label">Management</p>
        <a href="{{ route('admin.employer-profiles.index') }}" data-tooltip="Employer Approvals"
            class="menu-item {{ request()->routeIs('admin.employer-profiles*') ? 'active' : '' }}">
            <span class="menu-icon">
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon src="https://cdn.lordicon.com/shcfcebj.json" trigger="hover" stroke="bold" state="hover-wave"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:250px;height:250px">
                </lord-icon>
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
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon src="https://cdn.lordicon.com/hmpomorl.json" trigger="hover" stroke="bold"
                    colors="primary:#110a5c,secondary:#3080e8" style="width:250px;height:250px">
                </lord-icon>
            </span>
            <span class="menu-label">Activity Logs</span>
        </a>
    </div>
</div>