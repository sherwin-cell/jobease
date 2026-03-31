<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Jobease') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head')
</head>

<body class="bg-gray-50 text-gray-800">

    @unless(request()->routeIs('login', 'register', 'jobseeker.dashboard'))
        <header class="bg-white shadow">
            <nav class="container mx-auto px-6 py-4 flex items-center justify-between">

                <!-- Left: Logo -->
                <a href="/" class="text-xl font-bold text-blue-600">Jobease</a>

                <!-- Middle: Nav Links -->
                <div class="flex items-center space-x-4">
                    @auth
                        @if(Auth::user()->isJobSeeker())
                            <a href="{{ route('jobseeker.dashboard') }}" class="hover:underline">Dashboard</a>
                            <a href="{{ route('jobseeker.jobs.index') }}" class="hover:underline">Browse Jobs</a>
                            <a href="{{ route('jobseeker.profile.show') }}" class="hover:underline">My Profile</a>
                            <a href="{{ route('jobseeker.profile.create') }}" class="hover:underline">Edit Profile</a>
                            <a href="{{ route('jobseeker.applications.index') }}" class="hover:underline">My Applications</a>

                        @elseif(Auth::user()->isEmployer())
                            <a href="{{ route('employer.dashboard') }}" class="hover:underline">Dashboard</a>
                            <a href="{{ route('employer.jobs.index') }}" class="hover:underline">My Jobs</a>
                            <a href="{{ route('employer.applications.index') }}" class="hover:underline">Applications</a>
                            <a href="{{ route('employer.profile.edit') }}" class="hover:underline">Company Profile</a>

                        @elseif(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="hover:underline">Admin Dashboard</a>
                        @endif
                    @endauth
                </div>

                <!-- Right: Auth Buttons -->
                <div class="flex items-center space-x-2">
                    @auth
                        <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Login</a>
                        <a href="{{ route('register') }}"
                            class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Register</a>
                    @endauth
                </div>

            </nav>
        </header>
    @endunless

    <!-- Flash Messages & Content -->
    <main class="@if(request()->routeIs('jobseeker.dashboard')) w-full p-0 m-0 @else container mx-auto px-6 py-6 @endif">
        @if(!request()->routeIs('jobseeker.dashboard'))
            @if(session('success'))
                <div class="mb-4 rounded border border-green-200 bg-green-50 p-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 rounded border border-red-200 bg-red-50 p-3 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('info'))
                <div class="mb-4 rounded border border-blue-200 bg-blue-50 p-3 text-blue-800">
                    {{ session('info') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 rounded border border-red-200 bg-red-50 p-3 text-red-800">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif

        @yield('content')
    </main>

</body>

</html>