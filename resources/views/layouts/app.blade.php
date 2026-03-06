<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Jobease') }}</title>
    <!-- CSS -->
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-800">

    @unless(request()->routeIs('login', 'register', 'register.employer'))
        <!-- Header / Navbar -->
        <header class="bg-white shadow">
            <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    @auth
                        @if(Auth::user()->isJobSeeker())
                            <a href="{{ route('jobseeker.dashboard') }}" class="hover:underline">Dashboard</a>
                            <a href="{{ route('profile.show') }}" class="hover:underline">My Profile</a>
                            <a href="{{ route('profile.edit') }}" class="hover:underline">Edit Profile</a>

                            <a href="{{ route('job_seeker.notifications') }}"
                                class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Notifications ({{ auth()->user()->unreadNotifications->count() }})
                            </a>
                        @elseif(Auth::user()->isEmployer())
                            <a href="{{ route('employer.dashboard') }}" class="hover:underline">Dashboard</a>
                            <a href="{{ route('employer.profile.edit') }}" class="hover:underline">Company Profile</a>
                            <a href="{{ route('employer.jobs.index') }}" class="hover:underline">My Jobs</a>
                            <a href="{{ route('employer.applications.index') }}" class="hover:underline">Applications</a>
                            <a href="{{ route('candidates.index') }}"
                                class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                Candidates
                            </a>
                        @elseif(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="hover:underline">Admin</a>
                        @endif
                    @endauth
                </div>

                <div class="flex items-center space-x-2">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
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

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-6">
        @if (session('success'))
            <div class="mb-4 rounded border border-green-200 bg-green-50 p-3 text-green-800">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 rounded border border-red-200 bg-red-50 p-3 text-red-800">
                {{ session('error') }}
            </div>
        @endif
        @if (session('info'))
            <div class="mb-4 rounded border border-blue-200 bg-blue-50 p-3 text-blue-800">
                {{ session('info') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-4 rounded border border-red-200 bg-red-50 p-3 text-red-800">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow mt-12">
        <div class="container mx-auto px-6 py-4 text-center text-gray-600">
            &copy; {{ date('Y') }} Jobease
        </div>
    </footer>

    <!-- JS -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>