<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'JobEase') }} - Smart Job Matching</title>

    <!-- Fonts: Premium typefaces -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700|playfair-display:700"
        rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>
    <div class="gradient-bg"></div>

    <!-- HEADER -->
    <header class="w-full px-6 lg:px-8 py-6 lg:py-8">
        <nav class="max-w-6xl mx-auto">
            <div class="nav-brand">{{ config('app.name', 'JobEase') }}</div>
            <div class="nav-links">
                <a href="{{ route('login') }}" class="nav-link">
                    Log in
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-secondary">
                        Sign up
                    </a>
                @endif
            </div>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main class="w-full flex-1 flex items-center justify-center px-6 lg:px-8 py-12">
        <div class="max-w-4xl w-full">

            <!-- Hero Section -->
            <section class="text-center mb-16">
                <h1 class="display-font text-5xl lg:text-7xl font-bold mb-6 hero-title leading-tight">
                    Find Your Perfect <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400">Opportunity</span>
                </h1>

                <p
                    class="text-lg lg:text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-10 hero-subtitle leading-relaxed">
                    JobEase matches qualified professionals with meaningful opportunities. Powered by intelligent
                    matching and designed for success.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center cta-buttons">
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        Get Started for Free
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-secondary">
                        Already have an account?
                    </a>
                </div>
            </section>

            <!-- Features Section -->
            <div class="divider"></div>

            <section class="feature-grid">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                    <div class="feature-card">
                        <div class="feature-icon">🎯</div>
                        <h3 class="feature-title">Smart Matching</h3>
                        <p class="feature-desc">AI-powered recommendations tailored to your skills and aspirations</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">⚡</div>
                        <h3 class="feature-title">Quick Apply</h3>
                        <p class="feature-desc">One-click applications and instant employer responses</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">📊</div>
                        <h3 class="feature-title">Career Growth</h3>
                        <p class="feature-desc">Track your progress and access career development resources</p>
                    </div>
                </div>

            </section>

        </div>
    </main>

</body>

</html>