<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'JobEase') }} - Smart Job Matching</title>

    <!-- Fonts: Premium typefaces -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700|playfair-display:700" rel="stylesheet">

    <style>
        /* Eye-friendly, Simple, Blue-themed Design */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Softer Blue Background Pattern */
        .gradient-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: 
                radial-gradient(circle at 20% 80%, rgba(99, 102, 241, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        }

        /* Subtle Floating Elements */
        .floating-shapes {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: -1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.08;
            animation: float 25s infinite linear;
        }

        .shape-1 { 
            width: 60px; height: 60px; 
            top: 15%; left: 10%; 
            background: rgba(99, 102, 241, 0.3);
            animation-delay: 0s;
        }
        .shape-2 { 
            width: 100px; height: 100px; 
            top: 70%; right: 15%; 
            background: rgba(59, 130, 246, 0.2);
            animation-delay: -8s;
        }
        .shape-3 { 
            width: 40px; height: 40px; 
            bottom: 15%; left: 25%; 
            background: rgba(147, 51, 234, 0.2);
            animation-delay: -15s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-15px) rotate(120deg); }
            66% { transform: translateY(10px) rotate(240deg); }
        }

        /* Header - Clean & Simple */
        header {
            width: 100%;
            padding: 1rem 1.25rem;
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        nav {
            max-width: 90rem;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e40af;
            font-family: 'Playfair Display', serif;
        }

        @media (min-width: 1024px) { .nav-brand { font-size: 2.25rem; } }

        /* Desktop Navigation */
        [class*="hidden md:flex"] {
            display: none;
        }
        @media (min-width: 768px) {
            [class*="hidden md:flex"] { 
                display: flex; 
                align-items: center; 
                gap: 1.5rem; 
            }
        }

        .nav-link {
            color: #475569;
            font-weight: 500;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }

        .nav-link:hover {
            color: #1e40af;
            background: rgba(30, 64, 175, 0.05);
        }

        /* Mobile Hamburger */
        .hamburger {
            display: flex;
            flex-direction: column;
            gap: 4px;
            width: 24px;
            height: 24px;
            padding: 4px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .hamburger span {
            height: 3px;
            background: #475569;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }
        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        /* Mobile Menu */
        .mobile-menu {
            position: absolute;
            top: 100%;
            right: 1.25rem;
            width: 280px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            padding: 12px;
            margin-top: 8px;
            display: none;
        }

        .mobile-nav-link {
            display: block;
            padding: 12px 16px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #374151;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.2s ease;
            margin: 4px 0;
        }

        .mobile-nav-link:hover {
            background: #eff6ff;
            color: #1e40af;
            transform: translateX(4px);
        }

        .mobile-nav-link:last-child {
            background: linear-gradient(135deg, #1e40af, #2563eb);
            color: white;
            margin-top: 8px;
        }

        .mobile-nav-link:last-child:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateX(4px) scale(1.02);
        }

        /* Main Content */
        main {
            max-width: 90rem;
            margin: 0 auto;
            padding: 2rem 1.25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: calc(100vh - 140px);
        }

        @media (min-width: 640px) { main { padding: 3rem 1.5rem; } }
        @media (min-width: 1024px) { main { padding: 4rem 2rem; } }

        /* Hero Section */
        .hero-section {
            text-align: center;
            margin-bottom: 5rem;
            max-width: 48rem;
        }

        @media (min-width: 1024px) { .hero-section { margin-bottom: 7rem; } }

        .display-font {
            font-family: 'Playfair Display', serif;
        }

        .hero-title {
            font-size: clamp(2.25rem, 6vw, 4.5rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: #1e293b;
        }

        .hero-title span {
            display: block;
            background: linear-gradient(135deg, #1e40af, #2563eb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: clamp(1.1rem, 3vw, 1.5rem);
            color: #64748b;
            margin-bottom: 2.5rem;
            padding: 0 1rem;
        }

        /* CTA Buttons */
        .cta-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            max-width: 20rem;
            margin: 0 auto;
        }

        @media (min-width: 480px) {
            .cta-buttons {
                flex-direction: row;
                justify-content: center;
                max-width: none;
            }
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            width: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        @media (min-width: 480px) { .btn { width: auto; } }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        }

        .btn-secondary {
            background: white;
            color: #1e40af;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #eff6ff;
            border-color: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
        }

        /* Scroll Indicator */
        .scroll-indicator {
            margin-top: 3rem;
            padding: 1rem;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
        }

        .scroll-indicator:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Divider */
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #cbd5e1 20%, #cbd5e1 80%, transparent);
            margin: 4rem auto;
            width: 80%;
            max-width: 32rem;
        }

        /* Features Grid */
        .feature-grid {
            width: 100%;
            max-width: 64rem;
            margin: 0 auto;
        }

        .features-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 640px) {
            .features-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 2.5rem;
            }
        }

        @media (min-width: 1024px) {
            .features-container {
                grid-template-columns: repeat(3, 1fr);
                gap: 3rem;
            }
        }

        .feature-card {
            background: white;
            padding: 2.5rem 2rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (min-width: 1024px) { .feature-card { padding: 3rem 2.5rem; } }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
            border-color: #dbeafe;
        }

        .feature-icon {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            display: block;
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #1e293b;
        }

        .feature-desc {
            color: #64748b;
            font-size: 1rem;
            line-height: 1.7;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .feature-card {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .feature-card:nth-child(1) { animation-delay: 0.1s; }
        .feature-card:nth-child(2) { animation-delay: 0.2s; }
        .feature-card:nth-child(3) { animation-delay: 0.3s; }

        /* Responsive Typography */
        @media (max-width: 480px) {
            main { padding: 1.5rem 1rem; }
            .hero-section { margin-bottom: 3rem; }
            .cta-buttons { gap: 0.75rem; }
            .btn { padding: 0.875rem 1.5rem; font-size: 0.95rem; }
        }

        /* Dark Mode */
        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
                color: #f1f5f9;
            }
            .gradient-bg {
                background: 
                    radial-gradient(circle at 20% 80%, rgba(99, 102, 241, 0.2) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                    linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            }
            header {
                background: rgba(15, 23, 42, 0.95);
                border-color: rgba(30, 41, 59, 0.5);
            }
            .nav-brand { color: #60a5fa; }
            .nav-link { color: #94a3b8; }
            .nav-link:hover { color: #60a5fa; background: rgba(96, 165, 250, 0.1); }
            .hero-title { color: #f8fafc; }
            .hero-subtitle { color: #cbd5e1; }
            .feature-card {
                background: rgba(30, 41, 59, 0.8);
                border-color: rgba(51, 65, 85, 0.5);
                color: #f1f5f9;
            }
            .feature-title { color: #f8fafc; }
            .feature-desc { color: #cbd5e1; }
            .btn-secondary {
                background: rgba(30, 41, 59, 0.8);
                color: #60a5fa;
                border-color: rgba(51, 65, 85, 0.5);
            }
        }
    </style>
</head>

<body>
    <!-- Subtle Background -->
    <div class="gradient-bg">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </div>

    <!-- Clean Header -->
    <header>
        <nav>
            <div class="nav-brand">{{ config('app.name', 'JobEase') }}</div>
            
            <div class="hidden md:flex">
                <a href="{{ route('login') }}" class="nav-link">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-secondary">Sign up</a>
                @endif
            </div>
            
            <button class="hamburger" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
        <div class="mobile-menu">
            <a href="{{ route('login') }}" class="mobile-nav-link">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="mobile-nav-link">Sign up</a>
            @endif
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="hero-section">
            <h1 class="display-font hero-title">
                <span>Find Your</span>
                <span>Perfect Opportunity</span>
            </h1>
            <p class="hero-subtitle">
                JobEase matches qualified professionals with meaningful opportunities 
                using intelligent algorithms designed for your success.
            </p>
            <div class="cta-buttons">
                <a href="{{ route('register') }}" class="btn btn-primary">Get Started Free</a>
                <a href="{{ route('login') }}" class="btn btn-secondary">Have an account?</a>
            </div>
            <div class="scroll-indicator" onclick="scrollToFeatures()">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>

        <div class="divider"></div>

        <section class="feature-grid">
            <div class="features-container">
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3 class="feature-title">Smart Matching</h3>
                    <p class="feature-desc">AI-powered recommendations based on your skills, experience, and career goals</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3 class="feature-title">Quick Apply</h3>
                    <p class="feature-desc">One-click applications with instant employer notifications and responses</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📈</div>
                    <h3 class="feature-title">Career Growth</h3>
                    <p class="feature-desc">Track progress, get insights, and access resources for professional development</p>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Mobile Menu Toggle
        const hamburger = document.querySelector('.hamburger');
        const mobileMenu = document.querySelector('.mobile-menu');
        
        hamburger.addEventListener('click', () => {
            mobileMenu.style.display = mobileMenu.style.display === 'block' ? 'none' : 'block';
            hamburger.classList.toggle('active');
        });

        // Close menu on outside click
        document.addEventListener('click', (e) => {
            if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.style.display = 'none';
                hamburger.classList.remove('active');
            }
        });

        // Smooth scroll to features
        function scrollToFeatures() {
            document.querySelector('.feature-grid').scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }

        // Preload animations
        window.addEventListener('load', () => {
            document.body.style.opacity = '1';
        });
    </script>
</body>
</html>