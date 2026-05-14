<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'JobEase') }} - Smart Job Matching Platform</title>
    <meta name="description" content="Find your perfect job opportunity with JobEase - Intelligent job matching for professionals">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">

    <style>
        :root {
            --blue-dark:  #1a1aff;
            --blue-mid:   #1C4D8D;
            --blue-light: #00cfff;
            --blue-cyan:  #00e5ff;
            --grad-main:  linear-gradient(135deg, #0F2854 0%, #1C4D8D 40%, #4988C4 75%, #00cfff 100%);
            --grad-btn:   linear-gradient(135deg, #1a1aff, #0099cc);
            --white: #ffffff;
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--grad-main);
            color: #1f2937;
            line-height: 1.5;
            overflow-x: hidden;
        }

        /* ── Animated BG ── */
        .animated-bg {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .animated-bg::before {
            content: '';
            position: absolute;
            width: 200%; height: 200%;
            background: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.08) 0%, transparent 50%);
            animation: rotateBg 30s linear infinite;
        }

        @keyframes rotateBg {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }

        .particles { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; }

        .particle {
            position: absolute;
            background: rgba(0, 229, 255, 0.15);
            border-radius: 50%;
            animation: floatP 20s infinite ease-in-out;
        }

        @keyframes floatP {
            0%,100% { transform: translateY(0) translateX(0); }
            33%      { transform: translateY(-30px) translateX(20px); }
            66%      { transform: translateY(20px) translateX(-15px); }
        }

        /* ── Header ── */
        .header {
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .logo img {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #0F2854, #1a1aff, #0099cc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: #4b5563;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .nav-link:hover { color: var(--blue-dark); }

        .btn-outline {
            padding: 0.5rem 1.25rem;
            border: 2px solid #d1d5db;
            border-radius: 10px;
            text-decoration: none;
            color: #374151;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .btn-outline:hover {
            border-color: var(--blue-dark);
            color: var(--blue-dark);
            transform: translateY(-1px);
        }

        .btn-primary {
            padding: 0.5rem 1.5rem;
            background: var(--grad-btn);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(26,26,255,0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26,26,255,0.35);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
        }

        .mobile-menu-btn span {
            display: block;
            width: 25px;
            height: 3px;
            background: #4b5563;
            margin: 5px 0;
            border-radius: 2px;
            transition: 0.3s;
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .mobile-menu-btn { display: block; }
            .nav-container { padding: 0.75rem 1rem; }
        }

        .mobile-menu {
            display: none;
            background: white;
            padding: 0.75rem;
            border-top: 1px solid #e5e7eb;
        }

        .mobile-menu.active { display: block; }

        .mobile-nav-link {
            display: block;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: #4b5563;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.15s;
        }

        .mobile-nav-link:hover {
            background: #eff6ff;
            color: var(--blue-dark);
        }

        /* ── Main ── */
        .main {
            max-width: 1280px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        /* ── Hero ── */
        .hero {
            text-align: center;
            margin-bottom: 6rem;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(8px);
            padding: 0.45rem 1.1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            color: white;
            font-weight: 600;
            margin-bottom: 1.75rem;
        }

        .hero-badge-dot {
            width: 7px;
            height: 7px;
            background: #4ade80;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%,100% { opacity:1; transform:scale(1); }
            50%      { opacity:0.6; transform:scale(1.3); }
        }

        .hero-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .hero-logo img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            filter: drop-shadow(0 8px 24px rgba(0,229,255,0.4));
            animation: floatLogo 4s ease-in-out infinite;
        }

        @keyframes floatLogo {
            0%,100% { transform: translateY(0); }
            50%      { transform: translateY(-10px); }
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 3.75rem);
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 1.5rem;
            color: white;
            letter-spacing: -1px;
        }

        .hero-title span {
            background: linear-gradient(135deg, #00e5ff, #00cfff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.15rem;
            color: rgba(255,255,255,0.82);
            max-width: 580px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            padding: 0.9rem 2.2rem;
            background: white;
            color: #0F2854;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.2s;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.25);
        }

        .btn-hero-outline {
            padding: 0.9rem 2.2rem;
            border: 2px solid rgba(255,255,255,0.5);
            border-radius: 12px;
            text-decoration: none;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.2s;
            backdrop-filter: blur(4px);
        }

        .btn-hero-outline:hover {
            background: rgba(255,255,255,0.12);
            border-color: white;
            transform: translateY(-2px);
        }

        /* ── Stats ── */
        .stats-wrapper {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            margin-bottom: 6rem;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 2rem;
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            line-height: 1;
        }

        .stat-number span {
            background: linear-gradient(135deg, #00e5ff, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            color: rgba(255,255,255,0.72);
            font-weight: 500;
            margin-top: 0.5rem;
            font-size: 0.9rem;
        }

        /* ── Features ── */
        .features { margin-bottom: 6rem; }

        .section-title {
            text-align: center;
            font-size: clamp(1.5rem, 3vw, 2.25rem);
            font-weight: 800;
            margin-bottom: 0.75rem;
            color: white;
        }

        .section-subtitle {
            text-align: center;
            color: rgba(255,255,255,0.72);
            margin-bottom: 3rem;
            font-size: 1rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .feature-card {
            background: rgba(255,255,255,0.96);
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.8);
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .feat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #0F2854, #1a1aff);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
        }

        .feat-icon svg {
            width: 28px;
            height: 28px;
            stroke: white;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .feature-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 0.6rem;
            color: #0F2854;
        }

        .feature-desc {
            color: #6b7280;
            line-height: 1.6;
            font-size: 0.93rem;
        }

        /* ── CTA ── */
        .cta-section {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.25);
            backdrop-filter: blur(16px);
            border-radius: 30px;
            padding: 4rem 2rem;
            text-align: center;
            color: white;
            margin-bottom: 4rem;
        }

        .cta-title {
            font-size: clamp(1.5rem, 3vw, 2.25rem);
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .cta-subtitle {
            margin-bottom: 2rem;
            opacity: 0.82;
            font-size: 1rem;
        }

        .btn-cta {
            background: white;
            color: #0F2854;
            padding: 0.9rem 2.2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.2s;
            display: inline-block;
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.2);
        }

        /* ── Footer ── */
        .footer {
            text-align: center;
            padding: 2rem;
            border-top: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.6);
            font-size: 0.875rem;
        }

        .footer a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer a:hover { color: white; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .main { padding: 2rem 1rem; }
            .cta-section { padding: 2.5rem 1.5rem; }
            .stats-wrapper { padding: 1.75rem 1rem; }
            .features-grid { gap: 1rem; }
        }

        @media (max-width: 640px) {
            .hero-buttons { flex-direction: column; align-items: center; }
            .btn-hero-primary, .btn-hero-outline { width: 100%; max-width: 280px; text-align: center; }
            .stats { grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        }
    </style>
</head>

<body>
    <div class="animated-bg"></div>
    <div class="particles" id="particles"></div>

    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/dashboard_logo.png') }}" alt="JobEase Logo">
                <span class="logo-text">JobEase</span>
            </a>

            <div class="nav-links">
                <a href="#features" class="nav-link">Features</a>
                <a href="#about" class="nav-link">About</a>
                <a href="{{ route('login') }}" class="btn-outline">Log In</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-primary">Sign Up Free</a>
                @endif
            </div>

            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <div class="mobile-menu" id="mobileMenu">
            <a href="#features" class="mobile-nav-link">Features</a>
            <a href="#about" class="mobile-nav-link">About</a>
            <a href="{{ route('login') }}" class="mobile-nav-link">Log In</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="mobile-nav-link">Sign Up Free</a>
            @endif
        </div>
    </header>

    <!-- Main -->
    <main class="main">

        <!-- Hero -->
        <section class="hero">
            <div class="hero-badge">
                <div class="hero-badge-dot"></div>
                Trusted by 10,000+ professionals
            </div>

            <div class="hero-logo">
                <img src="{{ asset('images/dashboard_logo.png') }}" alt="JobEase">
            </div>

            <h1 class="hero-title">
                Find Your <span>Dream Job</span><br>
                Faster Than Ever
            </h1>
            <p class="hero-subtitle">
                Join thousands of professionals who found their perfect career match through JobEase's intelligent matching platform.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('register') }}" class="btn-hero-primary">Get Started Free</a>
                <a href="#features" class="btn-hero-outline">Learn More</a>
            </div>
        </section>

        <!-- Stats -->
        <div class="stats-wrapper">
            <div class="stats">
                <div>
                    <div class="stat-number"><span>10K+</span></div>
                    <div class="stat-label">Active Jobs</div>
                </div>
                <div>
                    <div class="stat-number"><span>5K+</span></div>
                    <div class="stat-label">Companies</div>
                </div>
                <div>
                    <div class="stat-number"><span>50K+</span></div>
                    <div class="stat-label">Happy Professionals</div>
                </div>
                <div>
                    <div class="stat-number"><span>95%</span></div>
                    <div class="stat-label">Success Rate</div>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="features" id="features">
            <h2 class="section-title">Why Choose JobEase?</h2>
            <p class="section-subtitle">Powerful features designed to accelerate your career growth</p>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feat-icon">
                        <!-- Target / smart matching -->
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                    </div>
                    <h3 class="feature-title">Smart Matching</h3>
                    <p class="feature-desc">AI-powered job recommendations tailored to your skills, experience, and career aspirations.</p>
                </div>

                <div class="feature-card">
                    <div class="feat-icon">
                        <!-- Bolt / quick apply -->
                        <svg viewBox="0 0 24 24"><polyline points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    </div>
                    <h3 class="feature-title">Quick Apply</h3>
                    <p class="feature-desc">Apply to multiple jobs with one click. Save time and get noticed faster by employers.</p>
                </div>

                <div class="feature-card">
                    <div class="feat-icon">
                        <!-- Bar chart / analytics -->
                        <svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    </div>
                    <h3 class="feature-title">Career Analytics</h3>
                    <p class="feature-desc">Track your applications, get insights, and understand your market value.</p>
                </div>

                <div class="feature-card">
                    <div class="feat-icon">
                        <!-- Shield / secure -->
                        <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                    </div>
                    <h3 class="feature-title">Secure & Verified</h3>
                    <p class="feature-desc">All companies and jobs are verified to ensure a safe job search experience.</p>
                </div>

                <div class="feature-card">
                    <div class="feat-icon">
                        <!-- Message / direct messaging -->
                        <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <h3 class="feature-title">Direct Messaging</h3>
                    <p class="feature-desc">Communicate directly with employers and get real-time updates on your applications.</p>
                </div>

                <div class="feature-card">
                    <div class="feat-icon">
                        <!-- Smartphone / mobile friendly -->
                        <svg viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                    </div>
                    <h3 class="feature-title">Mobile Friendly</h3>
                    <p class="feature-desc">Access JobEase anywhere, anytime with our fully responsive platform.</p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="cta-section" id="about">
            <h2 class="cta-title">Ready to Start Your Journey?</h2>
            <p class="cta-subtitle">Join thousands of professionals who found their dream job through JobEase</p>
            <a href="{{ route('register') }}" class="btn-cta">Create Free Account →</a>
        </div>

    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'JobEase') }}. All rights reserved.</p>
        <p style="margin-top: 0.5rem;">
            <a href="{{ route('privacy') }}">Privacy Policy</a> &bull;
            <a href="{{ route('terms') }}">Terms of Service</a>
        </p>
    </footer>

    <script>
        // Mobile Menu
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        mobileBtn.addEventListener('click', () => mobileMenu.classList.toggle('active'));
        document.querySelectorAll('.mobile-nav-link').forEach(l => l.addEventListener('click', () => mobileMenu.classList.remove('active')));

        // Particles
        const particlesContainer = document.getElementById('particles');
        for (let i = 0; i < 40; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            const size = Math.random() * 6 + 2;
            p.style.cssText = `width:${size}px;height:${size}px;left:${Math.random()*100}%;top:${Math.random()*100}%;animation-delay:${Math.random()*20}s;animation-duration:${Math.random()*20+10}s`;
            particlesContainer.appendChild(p);
        }

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', function(e) {
                e.preventDefault();
                const t = document.querySelector(this.getAttribute('href'));
                if (t) t.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // Fade-in cards
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.style.opacity = '1';
                    e.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.feature-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });
    </script>
</body>
</html>