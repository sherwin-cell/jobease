<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'JobEase') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col items-center p-6 lg:p-8">

    <!-- HEADER -->
    <header class="w-full max-w-4xl text-sm mb-6">
        <nav class="flex justify-end gap-4">
            <!-- Always show Login / Register -->
            <a href="{{ route('login') }}"
                class="px-5 py-1.5 border border-transparent hover:border-gray-400 rounded-sm">
                Log in
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="px-5 py-1.5 border border-gray-300 hover:border-black rounded-sm">
                    Register
                </a>
            @endif
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main class="w-full max-w-4xl text-center mt-10">
        <h1 class="text-3xl lg:text-5xl font-bold mb-6">
            Welcome to JobEase
        </h1>

        <p class="text-lg text-gray-600 mb-8">
            Your smart job matching and recruitment platform.
        </p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}" class="px-6 py-2 bg-black text-white rounded-md">
                Get Started
            </a>

            <a href="{{ route('login') }}" class="px-6 py-2 border border-black rounded-md">
                Sign In
            </a>
        </div>
    </main>

</body>
</html>