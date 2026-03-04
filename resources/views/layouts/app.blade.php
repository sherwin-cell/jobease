<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Jobease') }}</title>
    <!-- Add CSS here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <a href="{{ url('/') }}">Home</a>

            @auth
                @if(Auth::user()->isJobSeeker())
                    <a href="{{ route('profile.edit') }}">Profile</a>
                @elseif(Auth::user()->isEmployer())
                    <a href="{{ route('employer.profile.edit') }}">Company Profile</a>
                @endif
                @if(Auth::user()->isJobSeeker())
                    <a href="{{ route('jobseeker.dashboard') }}">Job Seeker Dashboard</a>
                @elseif(Auth::user()->isEmployer())
                    <a href="{{ route('employer.dashboard') }}">Employer Dashboard</a>
                @elseif(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Jobease</p>
    </footer>

    <!-- Add JS here -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>