<!-- SIDEBAR: Admin -->
<aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 flex flex-col">
    <div class="flex items-center gap-3 px-6 py-5 border-b">
        <div class="w-10 h-10 flex items-center justify-center bg-gray-900 text-white rounded-xl text-lg">🛡️</div>
        <span class="text-xl font-bold text-gray-800">Admin Panel</span>
    </div>
    <div class="px-6 py-5 border-b">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-full text-xl">👤</div>
            <div>
                <div class="font-semibold text-gray-800">{{ auth()->user()->name }}</div>
                <div class="text-sm text-gray-500">Administrator</div>
            </div>
        </div>
    </div>
    <nav class="flex-1 px-4 py-6 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
            🏠 <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.users') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('admin.users*') ? 'bg-gray-900 text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
            👥 <span>Manage Users</span>
        </a>
        <a href="{{ route('admin.jobs') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('admin.jobs*') ? 'bg-gray-900 text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
            💼 <span>Manage Jobs</span>
        </a>
        <a href="{{ route('admin.reports') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('admin.reports*') ? 'bg-gray-900 text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
            📊 <span>View Reports</span>
        </a>
        <a href="{{ route('admin.employer-profiles.index') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
    {{ request()->routeIs('admin.employer-profiles.*') ? 'bg-gray-900 text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
            🏢 <span>Employer Profiles</span>
        </a>
    </nav>
    <div class="p-4 border-t">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-red-600 hover:bg-red-50 transition"
                onclick="return confirm('Are you sure you want to log out?');">
                🚪 <span>Logout</span>
            </button>
        </form>
    </div>
</aside>