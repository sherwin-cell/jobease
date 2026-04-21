<!-- SIDEBAR: Job Seeker -->
<aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 flex flex-col">
    <div class="flex items-center gap-3 px-6 py-5 border-b">
        <div class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-xl text-lg">💼</div>
        <span class="text-xl font-bold text-gray-800">JobEase</span>
    </div>
    <div class="px-6 py-5 border-b">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-full text-xl">👤</div>
            <div>
                <div class="font-semibold text-gray-800">{{ auth()->user()->name }}</div>
                <div class="text-sm text-gray-500">Job Seeker</div>
            </div>
        </div>
        <a href="{{ route('jobseeker.profile.show') }}"
            class="mt-4 block text-center bg-blue-600 text-white text-sm py-2 rounded-lg hover:bg-blue-700 transition">
            View Profile
        </a>
    </div>
    <nav class="flex-1 px-4 py-6 space-y-2">
        <a href="{{ route('jobseeker.dashboard') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('jobseeker.dashboard') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
            🏠 <span>Dashboard</span>
        </a>
        <a href="{{ route('jobseeker.jobs.index') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('jobseeker.jobs.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
            💼 <span>Browse Jobs</span>
        </a>
        <a href="{{ route('jobseeker.applications.index') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('jobseeker.applications.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
            📋 <span>Applications</span>
        </a>
        <a href="{{ route('jobseeker.profile.show') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('jobseeker.profile.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
            👤 <span>My Profile</span>
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
