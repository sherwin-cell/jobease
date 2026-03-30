<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'JobEase') }} - Smart Job Matching</title>

    <!-- Fonts: Premium typefaces -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700|playfair-display:700" rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            --color-bg: #fafaf8;
            --color-bg-dark: #0f0f0d;
            --color-text: #1a1a17;
            --color-text-light: #6b6b67;
            --color-accent: #1a1a17;
            --color-accent-light: #e8e8e5;
            --color-primary: #0066ff;
            --color-primary-hover: #0052cc;
        }

        @media (prefers-color-scheme: dark) {
            * {
                --color-bg: #0f0f0d;
                --color-bg-dark: #1a1a17;
                --color-text: #f5f5f0;
                --color-text-light: #a8a8a3;
                --color-accent: #ffffff;
                --color-accent-light: #2a2a27;
                --color-primary: #4d9eff;
                --color-primary-hover: #6dafff;
            }
        }

        html {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: var(--color-bg);
            color: var(--color-text);
            transition: background-color 0.3s ease;
        }

        .display-font {
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.02em;
        }

        /* Animated gradient background */
        .gradient-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(0, 102, 255, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(0, 102, 255, 0.04) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        /* Navigation styles */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .nav-brand {
            font-size: 1.125rem;
            font-weight: 600;
            letter-spacing: -0.01em;
            color: var(--color-text);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            position: relative;
            font-size: 0.95rem;
            color: var(--color-text);
            text-decoration: none;
            font-weight: 500;
            overflow: hidden;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--color-primary);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .nav-link:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .btn {
            padding: 0.625rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 0.5rem;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: var(--color-primary);
            color: white;
            box-shadow: 0 4px 12px rgba(0, 102, 255, 0.25);
        }

        .btn-primary:hover {
            background: var(--color-primary-hover);
            box-shadow: 0 6px 20px rgba(0, 102, 255, 0.35);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--color-accent-light);
            color: var(--color-text);
            border: 1px solid rgba(0, 102, 255, 0.2);
        }

        .btn-secondary:hover {
            background: var(--color-accent-light);
            border-color: var(--color-primary);
            transform: translateY(-2px);
        }

        /* Main content animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .hero-title {
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .hero-subtitle {
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        .feature-grid {
            animation: fadeInUp 0.8s ease-out 0.6s both;
        }

        .cta-buttons {
            animation: fadeInUp 0.8s ease-out 0.8s both;
        }

        .feature-card {
            background: var(--color-accent-light);
            padding: 2rem;
            border-radius: 0.75rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 102, 255, 0.1);
        }

        .feature-card:hover {
            border-color: var(--color-primary);
            box-shadow: 0 8px 24px rgba(0, 102, 255, 0.12);
            transform: translateY(-4px);
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .feature-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--color-text);
        }

        .feature-desc {
            font-size: 0.95rem;
            color: var(--color-text-light);
        }

        /* Divider */
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--color-accent-light), transparent);
            margin: 4rem 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                width: 100%;
                justify-content: center;
            }

            .display-font {
                font-size: 2.5rem;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
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
                    Find Your Perfect <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400">Opportunity</span>
                </h1>

                <p class="text-lg lg:text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-10 hero-subtitle leading-relaxed">
                    JobEase matches qualified professionals with meaningful opportunities. Powered by intelligent matching and designed for success.
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