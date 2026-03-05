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

    <!-- Header / Navbar -->
    <header class="bg-white shadow">
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                @auth
                    @if(Auth::user()->isJobSeeker())
                        <a href="{{ route('jobseeker.dashboard') }}" class="hover:underline">Job Seeker Dashboard</a>
                        <a href="{{ route('profile.edit') }}" class="hover:underline">Profile</a>

                        <!-- Notifications Button -->
                        <a href="{{ route('job_seeker.notifications') }}"
                            class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                            🔔 Notifications ({{ auth()->user()->unreadNotifications->count() }})
                        </a>
                    @elseif(Auth::user()->isEmployer())
                        <a href="{{ route('employer.dashboard') }}" class="hover:underline">Employer Dashboard</a>
                        <a href="{{ route('employer.profile.edit') }}" class="hover:underline">Company Profile</a>
                    @elseif(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hover:underline">Admin Dashboard</a>
                    @endif

                    @auth
                        @if(Auth::user()->isEmployer())
                            <a href="{{ route('candidates.index') }}"
                                class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                Candidates
                            </a>
                        @endif
                    @endauth
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

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-6">
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