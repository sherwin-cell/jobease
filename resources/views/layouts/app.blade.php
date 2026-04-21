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
                @include('layouts.partials.sidebar-jobseeker')
                <main class="ml-64 min-h-screen">
                    <div class="mx-auto w-full max-w-7xl px-6 py-8">
                        @include('layouts.partials.alerts')
                        @yield('content')
                    </div>
                </main>
            </div>
        @elseif(Auth::user()->isAdmin())
            <div class="min-h-screen">
                @include('layouts.partials.sidebar-admin')
                <main class="ml-64 min-h-screen">
                    <div class="mx-auto w-full max-w-7xl px-6 py-8">
                        @include('layouts.partials.alerts')
                        @yield('content')
                    </div>
                </main>
            </div>
        @else
            <div class="min-h-screen">
                @include('layouts.partials.sidebar-employer')
                <main class="ml-64 min-h-screen">
                    <div class="mx-auto w-full max-w-7xl px-6 py-8">
                        @include('layouts.partials.alerts')
                        @yield('content')
                    </div>
                </main>
            </div>
        @endif
    @endauth

</body>

</html>