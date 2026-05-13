<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'JobEase') }} - Smart Job Matching Platform</title>
    <meta name="description" content="Find your perfect job opportunity with JobEase - Intelligent job matching for professionals">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #1f2937;
            line-height: 1.5;
            overflow-x: hidden;
        }

        /* Animated Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .animated-bg::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%);
            animation: rotate 30s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            animation: float 20s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); }
            33% { transform: translateY(-30px) translateX(20px); }
            66% { transform: translateY(20px) translateX(-15px); }
        }

        /* Header */
        .header {
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
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
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: #667eea;
        }

        .btn-outline {
            padding: 0.5rem 1.25rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            text-decoration: none;
            color: #4b5563;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-outline:hover {
            border-color: #667eea;
            color: #667eea;
            transform: translateY(-1px);
        }

        .btn-primary {
            padding: 0.5rem 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(102,126,234,0.3);
        }

        /* Mobile Menu Button */
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
            transition: 0.3s;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            .mobile-menu-btn {
                display: block;
            }
            .nav-container {
                padding: 1rem;
            }
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            background: white;
            padding: 1rem;
            border-top: 1px solid #e5e7eb;
        }

        .mobile-menu.active {
            display: block;
        }

        .mobile-nav-link {
            display: block;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: #4b5563;
            font-weight: 500;
            border-radius: 8px;
        }

        .mobile-nav-link:hover {
            background: #f3f4f6;
            color: #667eea;
        }

        /* Main Content */
        .main {
            max-width: 1280px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            margin-bottom: 6rem;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(102,126,234,0.1);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            color: #667eea;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #1f2937 0%, #4b5563 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-title span {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-large {
            padding: 0.875rem 2rem;
            font-size: 1rem;
        }

        /* Stats Section */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 6rem;
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            color: #6b7280;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        /* Features Grid */
        .features {
            margin-bottom: 6rem;
        }

        .section-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 3rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: 1px solid #e5e7eb;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
            border-color: #667eea;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 28px;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .feature-desc {
            color: #6b7280;
            line-height: 1.6;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 30px;
            padding: 4rem;
            text-align: center;
            color: white;
            margin-bottom: 4rem;
        }

        .cta-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .cta-subtitle {
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .btn-cta {
            background: white;
            color: #667eea;
            padding: 0.875rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.2s;
            display: inline-block;
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 2rem;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main {
                padding: 2rem 1rem;
            }
            .hero-title {
                font-size: 2rem;
            }
            .hero-subtitle {
                font-size: 1rem;
            }
            .cta-section {
                padding: 2rem;
            }
            .cta-title {
                font-size: 1.5rem;
            }
            .features-grid {
                gap: 1rem;
            }
        }

        @media (max-width: 640px) {
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            .btn-large {
                width: 100%;
                max-width: 280px;
            }
            .stats {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            .header {
                background: rgba(17,24,39,0.98);
            }
            .feature-card {
                background: #1f2937;
                border-color: #374151;
            }
            .hero-title {
                background: linear-gradient(135deg, #f3f4f6 0%, #9ca3af 100%);
                -webkit-background-clip: text;
            }
            .mobile-menu {
                background: #1f2937;
            }
        }
    </style>
</head>

<body>
    <div class="animated-bg"></div>
    
    <!-- Particles -->
    <div class="particles" id="particles"></div>

    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <div class="logo">
                <div class="logo-icon">JE</div>
                {{ config('app.name', 'JobEase') }}
            </div>
            
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

    <!-- Main Content -->
    <main class="main">
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-badge">✨ Trusted by 10,000+ professionals</div>
            <h1 class="hero-title">
                Find Your <span>Dream Job</span><br>
                Faster Than Ever
            </h1>
            <p class="hero-subtitle">
                Join thousands of professionals who found their perfect career match through JobEase's intelligent matching platform.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('register') }}" class="btn-primary btn-large">Get Started Free</a>
                <a href="#features" class="btn-outline btn-large">Learn More</a>
            </div>
        </section>

        <!-- Stats Section -->
        <div class="stats">
            <div>
                <div class="stat-number">10K+</div>
                <div class="stat-label">Active Jobs</div>
            </div>
            <div>
                <div class="stat-number">5K+</div>
                <div class="stat-label">Companies</div>
            </div>
            <div>
                <div class="stat-number">50K+</div>
                <div class="stat-label">Happy Professionals</div>
            </div>
            <div>
                <div class="stat-number">95%</div>
                <div class="stat-label">Success Rate</div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="features" id="features">
            <h2 class="section-title">Why Choose JobEase?</h2>
            <p class="section-subtitle">Powerful features designed to accelerate your career growth</p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3 class="feature-title">Smart Matching</h3>
                    <p class="feature-desc">AI-powered job recommendations tailored to your skills, experience, and career aspirations.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3 class="feature-title">Quick Apply</h3>
                    <p class="feature-desc">Apply to multiple jobs with one click. Save time and get noticed faster by employers.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3 class="feature-title">Career Analytics</h3>
                    <p class="feature-desc">Track your applications, get insights, and understand your market value.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3 class="feature-title">Secure & Verified</h3>
                    <p class="feature-desc">All companies and jobs are verified to ensure a safe job search experience.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">💬</div>
                    <h3 class="feature-title">Direct Messaging</h3>
                    <p class="feature-desc">Communicate directly with employers and get real-time updates on your applications.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3 class="feature-title">Mobile Friendly</h3>
                    <p class="feature-desc">Access JobEase anywhere, anytime with our fully responsive platform.</p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="cta-section">
            <h2 class="cta-title">Ready to Start Your Journey?</h2>
            <p class="cta-subtitle">Join thousands of professionals who found their dream job through JobEase</p>
            <a href="{{ route('register') }}" class="btn-cta">Create Free Account →</a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'JobEase') }}. All rights reserved.</p>
        <p style="margin-top: 0.5rem; font-size: 0.875rem;">
            <a href="#" style="color: inherit; text-decoration: none;">Privacy Policy</a> • 
            <a href="#" style="color: inherit; text-decoration: none;">Terms of Service</a> • 
            <a href="#" style="color: inherit; text-decoration: none;">Contact Us</a>
        </p>
    </footer>

    <script>
        // Mobile Menu Toggle
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        mobileBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            mobileBtn.classList.toggle('active');
        });
        
        // Close mobile menu on link click
        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
            });
        });
        
        // Create particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                const size = Math.random() * 5 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 20 + 's';
                particle.style.animationDuration = (Math.random() * 20 + 10) + 's';
                particlesContainer.appendChild(particle);
            }
        }
        
        createParticles();
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
        
        // Add intersection observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.feature-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });
    </script>
</body>

</html>