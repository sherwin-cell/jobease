<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Jobease') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head')
</head>

<body class="bg-gray-50 text-gray-800">

    @auth
        @if(Auth::user()->isJobSeeker())

            <div class="min-h-screen">

                <!-- SIDEBAR -->
                <aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 flex flex-col">

                    <!-- Logo -->
                    <div class="flex items-center gap-3 px-6 py-5 border-b">
                        <div class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-xl text-lg">
                            💼
                        </div>
                        <span class="text-xl font-bold text-gray-800">JobEase</span>
                    </div>

                    <!-- User Info -->
                    <div class="px-6 py-5 border-b">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-full text-xl">
                                👤
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">
                                    {{ auth()->user()->name }}
                                </div>
                                <div class="text-sm text-gray-500">Job Seeker</div>
                            </div>
                        </div>

                        <a href="{{ route('jobseeker.profile.show') }}"
                            class="mt-4 block text-center bg-blue-600 text-white text-sm py-2 rounded-lg hover:bg-blue-700 transition">
                            View Profile
                        </a>
                    </div>

                    <!-- Navigation -->
                    <nav class="flex-1 px-4 py-6 space-y-2">

                        <a href="{{ route('jobseeker.dashboard') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('jobseeker.dashboard') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                            🏠 <span>Dashboard</span>
                        </a>

                        <a href="{{ route('jobseeker.jobs.index') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('jobseeker.jobs.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                            💼 <span>Browse Jobs</span>
                        </a>

                        <a href="{{ route('skill-qa.index') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('skill-qa.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                            ❓ <span>Skill Q&amp;A</span>
                        </a>

                        <a href="{{ route('jobseeker.applications.index') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('jobseeker.applications.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                            📋 <span>Applications</span>
                        </a>

                        <a href="{{ route('jobseeker.profile.show') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('jobseeker.profile.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                            👤 <span>My Profile</span>
                        </a>

                    </nav>

                    <!-- Logout -->
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
                <!-- MAIN CONTENT -->
                <main class="ml-64 min-h-screen">
                    <div class="mx-auto w-full max-w-7xl px-6 py-8">

                    @if(session('success'))
                        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="mb-6 rounded-lg border border-blue-200 bg-blue-50 px-4 py-3 text-blue-800">
                            {{ session('info') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')

                    </div>
                </main>

            </div>

        @elseif(Auth::user()->isAdmin())

            <div class="min-h-screen">

                <!-- SIDEBAR (Admin) -->
                <aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 flex flex-col">

                    <!-- Logo -->
                    <div class="flex items-center gap-3 px-6 py-5 border-b">
                        <div class="w-10 h-10 flex items-center justify-center bg-gray-900 text-white rounded-xl text-lg">
                            🛡️
                        </div>
                        <span class="text-xl font-bold text-gray-800">Admin Panel</span>
                    </div>

                    <!-- User Info -->
                    <div class="px-6 py-5 border-b">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-full text-xl">
                                👤
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">
                                    {{ auth()->user()->name }}
                                </div>
                                <div class="text-sm text-gray-500">Administrator</div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="flex-1 px-4 py-6 space-y-2">
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                            🏠 <span>Dashboard</span>
                        </a>

                        <a href="{{ route('admin.users') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('admin.users*') ? 'bg-gray-900 text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                            👥 <span>Manage Users</span>
                        </a>

                        <a href="{{ route('admin.jobs') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('admin.jobs*') ? 'bg-gray-900 text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                            💼 <span>Manage Jobs</span>
                        </a>

                        <a href="{{ route('admin.reports') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('admin.reports*') ? 'bg-gray-900 text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
                            📊 <span>View Reports</span>
                        </a>
                    </nav>

                    <!-- Logout -->
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

                <!-- MAIN CONTENT -->
                <main class="ml-64 min-h-screen">
                    <div class="mx-auto w-full max-w-7xl px-6 py-8">

                        @if(session('success'))
                            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('info'))
                            <div class="mb-6 rounded-lg border border-blue-200 bg-blue-50 px-4 py-3 text-blue-800">
                                {{ session('info') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                                <ul class="list-disc pl-5">
                                    @foreach($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </main>
            </div>

        @else
            {{-- NON-JOBSEEKER USERS (Employer) --}}
            <div class="min-h-screen">

                <!-- SIDEBAR (Employer) -->
                <aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 flex flex-col">

                    <!-- Logo -->
                    <div class="flex items-center gap-3 px-6 py-5 border-b">
                        <div class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-xl text-lg">
                            🏢
                        </div>
                        <span class="text-xl font-bold text-gray-800">Employer</span>
                    </div>

                    <!-- User Info -->
                    <div class="px-6 py-5 border-b">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-full text-xl">
                                👤
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">
                                    {{ auth()->user()->name }}
                                </div>
                                <div class="text-sm text-gray-500">Employer</div>
                            </div>
                        </div>

                        <a href="{{ route('employer.jobs.create') }}"
                            class="mt-4 block text-center bg-blue-600 text-white text-sm py-2 rounded-lg hover:bg-blue-700 transition">
                            Create Job
                        </a>
                    </div>

                    <!-- Navigation -->
                    <nav class="flex-1 px-4 py-6 space-y-2">

                        <a href="{{ route('employer.dashboard') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('employer.dashboard') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                            🏠 <span>Dashboard</span>
                        </a>

                        <a href="{{ route('employer.jobs.index') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('employer.jobs.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                            💼 <span>My Jobs</span>
                        </a>

                        <a href="{{ route('employer.live-skill-qa.index') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('employer.live-skill-qa.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                            ❓ <span>Live Skill Q&amp;A</span>
                        </a>

                        <a href="{{ route('employer.applications.index') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('employer.applications.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                            📋 <span>Applications</span>
                        </a>

                        <a href="{{ route('employer.profile.edit') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->routeIs('employer.profile.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                            👤 <span>Company Profile</span>
                        </a>

                    </nav>

                    <!-- Logout -->
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

                <!-- MAIN CONTENT -->
                <main class="ml-64 min-h-screen">
                    <div class="mx-auto w-full max-w-7xl px-6 py-8">
                        @if(session('success'))
                            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('info'))
                            <div class="mb-6 rounded-lg border border-blue-200 bg-blue-50 px-4 py-3 text-blue-800">
                                {{ session('info') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                                <ul class="list-disc pl-5">
                                    @foreach($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </main>
            </div>
        @endif
    @endauth

</body>

</html>