<!-- =========================================================
JobEase — Premium Login Page (Matching Register Design)
Responsive | Dark Mode | Laravel Blade Ready
Eye Toggle: Mobile Only - FULLY FIXED
========================================================= -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>JobEase — Login</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&family=playfair-display:400,500,600,700i"
        rel="stylesheet">

    <style>
        :root {
            --blue-600: #2563eb;
            --blue-700: #1d4ed8;
            --blue-800: #1e40af;
            --blue-900: #1e3a8a;

            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-700: #334155;
            --slate-900: #0f172a;

            --white: #ffffff;
            --red-500: #ef4444;

            --bg-gradient-from: #dbeafe;
            --bg-gradient-to: #f8fafc;
            --card-bg: #ffffff;
            --input-bg: #f8fafc;
            --input-border: #dbe2ea;
            --label-color: var(--slate-900);
            --sub-color: var(--slate-500);
            --shadow-color: rgba(0, 0, 0, 0.12);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg-gradient-from: #0f172a;
                --bg-gradient-to: #1e293b;
                --card-bg: #1e293b;
                --input-bg: #0f172a;
                --input-border: #334155;
                --label-color: #e2e8f0;
                --sub-color: #94a3b8;
                --shadow-color: rgba(0, 0, 0, 0.5);
            }
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(ellipse at 30% 0%, var(--bg-gradient-from), var(--bg-gradient-to) 70%);
            color: var(--label-color);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(10px, 2vh, 24px) clamp(10px, 2vw, 24px);
        }

        .card {
            width: 100%;
            max-width: 1080px;
            height: 100%;
            max-height: min(96vh, 820px);
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: var(--card-bg);
            border-radius: clamp(16px, 2vw, 24px);
            overflow: hidden;
            box-shadow: 0 24px 64px var(--shadow-color);
        }

        /* LEFT */
        .left {
            background: linear-gradient(135deg, #0F2854, #1C4D8D, #4988C4, #BDE8F5);
            color: white;
            padding: clamp(32px, 5vh, 60px) clamp(28px, 4vw, 56px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .left::before {
            content: '';
            position: absolute;
            width: clamp(160px, 30vw, 320px);
            height: clamp(160px, 30vw, 320px);
            background: rgba(255, 255, 255, 0.07);
            border-radius: 50%;
            top: -80px;
            right: -80px;
            pointer-events: none;
        }

        .left::after {
            content: '';
            position: absolute;
            width: clamp(100px, 18vw, 200px);
            height: clamp(100px, 18vw, 200px);
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            pointer-events: none;
        }

        .brand-logo {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: clamp(6px, 1vh, 10px);
            position: relative;
            z-index: 2;
        }

        .brand-tagline {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: clamp(14px, 2vw, 17px);
            opacity: 0.85;
            margin-bottom: clamp(16px, 3vh, 32px);
            line-height: 1.6;
            position: relative;
            z-index: 2;
        }

        .divider {
            width: 48px;
            height: 2px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 2px;
            margin-bottom: clamp(16px, 3vh, 28px);
            position: relative;
            z-index: 2;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: clamp(10px, 1.5vh, 16px);
            position: relative;
            z-index: 2;
        }

        .feature-icon {
            width: 28px;
            height: 28px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .feature-text {
            font-size: clamp(12px, 1.5vw, 14px);
            opacity: 0.92;
            font-weight: 500;
            line-height: 1.4;
        }

        .brand-badge {
            margin-top: clamp(24px, 4vh, 40px);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 100px;
            padding: 6px 14px 6px 8px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.3px;
            position: relative;
            z-index: 2;
            width: fit-content;
        }

        .brand-badge-dot {
            width: 8px;
            height: 8px;
            background: #4ade80;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.6;
                transform: scale(1.3);
            }
        }

        /* RIGHT */
        .right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: clamp(24px, 4vh, 48px) clamp(24px, 4vw, 52px);
            overflow: hidden;
        }

        .form-header {
            margin-bottom: clamp(16px, 2.5vh, 26px);
        }

        .form-title {
            font-size: clamp(22px, 3vw, 32px);
            font-weight: 800;
            color: var(--label-color);
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }

        .form-subtitle {
            font-size: clamp(12px, 1.4vw, 14px);
            color: var(--sub-color);
            font-weight: 500;
        }

        .input-group {
            margin-bottom: 18px;
        }

        .input-label {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            margin-bottom: 5px;
            color: var(--slate-700);
        }

        @media (prefers-color-scheme: dark) {
            .input-label {
                color: #94a3b8;
            }
        }

        .input-wrap {
            position: relative;
        }

        input {
            width: 100%;
            padding: clamp(9px, 1.3vh, 12px) clamp(10px, 1.5vw, 14px);
            border-radius: 10px;
            border: 1.5px solid var(--input-border);
            background: var(--input-bg);
            color: var(--label-color);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(13px, 1.3vw, 14px);
            font-weight: 500;
            outline: none;
            transition: 0.25s;
        }

        input::placeholder {
            color: var(--slate-400);
        }

        input:focus {
            border-color: var(--blue-600);
            background: white;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        @media (prefers-color-scheme: dark) {
            input:focus {
                background: #0f172a;
            }
        }

        /* Password Toggle - ONLY VISIBLE ON MOBILE */
        .pw-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--slate-400);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s ease, transform 0.2s ease;
            background: transparent;
            border: none;
            z-index: 2;
            -webkit-tap-highlight-color: transparent;
        }

        /* HIDE eye toggle on desktop (screens larger than 768px) */
        @media (min-width: 769px) {
            .pw-toggle {
                display: none !important;
            }

            /* Normal padding on desktop since no eye button */
            input {
                padding-right: clamp(10px, 1.5vw, 14px);
            }
        }

        /* SHOW eye toggle only on mobile (768px and below) */
        @media (max-width: 768px) {
            .pw-toggle {
                display: flex;
            }

            /* Larger touch targets for mobile */
            .pw-toggle {
                width: 44px;
                height: 44px;
                right: 8px;
            }

            .eye-icon {
                width: 22px;
                height: 22px;
            }

            input {
                padding-right: 52px;
                font-size: 16px;
                /* Prevents zoom on iOS */
            }
        }

        .pw-toggle:hover {
            color: var(--slate-700);
        }

        .pw-toggle:active {
            transform: translateY(-50%) scale(0.95);
        }

        .eye-icon {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            display: block;
        }

        .pw-toggle.active .eye-icon {
            stroke: var(--blue-600);
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin: 8px 0 18px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--sub-color);
        }

        .remember input {
            width: 16px;
            height: 16px;
            accent-color: var(--blue-600);
            padding: 0;
        }

        .options a {
            color: var(--blue-600);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
        }

        .btn-submit {
            width: 100%;
            padding: clamp(11px, 1.6vh, 14px);
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: whitesmoke;
            border: none;
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(13px, 1.4vw, 15px);
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 0.2px;
            transition: transform 0.2s, box-shadow 0.2s, opacity 0.2s;
            margin-top: clamp(10px, 1.5vh, 16px);
            position: relative;
            overflow: hidden;
        }

        .btn-submit::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.12), transparent);
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(37, 99, 235, 0.32);
        }

        .btn-submit:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        .footer {
            margin-top: clamp(10px, 1.5vh, 16px);
            text-align: center;
            font-size: clamp(11px, 1.2vw, 13px);
            color: var(--sub-color);
        }

        .footer a {
            color: var(--blue-600);
            font-weight: 700;
            text-decoration: none;
        }

        .error-msg {
            margin-top: 6px;
            font-size: 11px;
            font-weight: 600;
            color: var(--red-500);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* MOBILE */
        @media (max-width: 768px) {

            html,
            body {
                overflow: hidden;
            }

            .card {
                grid-template-columns: 1fr;
                max-height: 100vh;
                border-radius: 0;
                height: 100%;
            }

            .left {
                display: none;
            }

            .right {
                padding: clamp(20px, 4vw, 32px) clamp(18px, 4vw, 28px);
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }

            .form-title,
            .form-subtitle {
                text-align: center;
            }
        }

        /* TABLET */
        @media (min-width: 769px) and (max-width: 1024px) {
            .card {
                max-width: 900px;
            }

            .left {
                padding: 40px 36px;
            }

            .right {
                padding: 32px 36px;
            }

            .brand-logo {
                font-size: 36px;
            }
        }

        /* FOCUS VISIBLE (accessibility) */
        :focus-visible {
            outline: 2px solid var(--blue-600);
            outline-offset: 2px;
        }
    </style>
</head>

<body>

    <div class="card">

        <!-- LEFT -->
        <aside class="left">
            <div class="brand-logo">JobEase</div>
            <div class="brand-tagline">
                Welcome back.<br>
                Continue building your future.
            </div>

            <div class="divider"></div>

            <div class="feature">
                <div class="feature-icon">✦</div>
                <div class="feature-text">AI-powered career opportunities</div>
            </div>

            <div class="feature">
                <div class="feature-icon">⚡</div>
                <div class="feature-text">Fast, secure job applications</div>
            </div>

            <div class="feature">
                <div class="feature-icon">🔒</div>
                <div class="feature-text">Trusted by thousands of professionals</div>
            </div>

            <div class="brand-badge">
                <div class="brand-badge-dot"></div>
                Careers are live now
            </div>
        </aside>

        <!-- RIGHT -->
        <section class="right">

            <div class="form-header">
                <div class="form-title">Welcome Back</div>
                <div class="form-subtitle">Sign in to continue your JobEase journey</div>
            </div>

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email -->
                <div class="input-group">
                    <label class="input-label">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                        autocomplete="email" required>

                    @error('email')
                        <div class="error-msg">⚠ {{ $message }}</div>
                    @enderror
                </div>

                <!-- Password with Eye Toggle (Mobile Only) -->
                <div class="input-group">
                    <label class="input-label">Password</label>
                    <div class="input-wrap">
                        <input type="password" name="password" id="password" placeholder="Enter your password"
                            autocomplete="current-password" required>
                        <button type="button" class="pw-toggle" id="togglePw" aria-label="Toggle password visibility">
                            <svg class="eye-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    </div>

                    @error('password')
                        <div class="error-msg">⚠ {{ $message }}</div>
                    @enderror
                </div>

                <!-- Options -->
                <div class="options">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    Sign In
                </button>

            </form>

            <!-- Google Login -->
            <div style="margin-top: 16px; text-align: center;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 14px;">
                    <div style="flex: 1; height: 1px; background: var(--input-border);"></div>
                    <span style="font-size: 12px; color: var(--sub-color); font-weight: 600;">OR</span>
                    <div style="flex: 1; height: 1px; background: var(--input-border);"></div>
                </div>
                <a href="{{ route('google.login') }}"
                    style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; padding: 11px 14px; border: 1.5px solid var(--input-border); border-radius: 10px; background: var(--input-bg); color: var(--label-color); font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; font-weight: 600; text-decoration: none; transition: box-shadow 0.2s, transform 0.2s;"
                    onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(0,0,0,0.1)'"
                    onmouseout="this.style.transform='';this.style.boxShadow=''">
                    <svg width="18" height="18" viewBox="0 0 48 48">
                        <path fill="#4285F4"
                            d="M44.5 20H24v8.5h11.7C34.2 33.6 29.7 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3 0 5.7 1.1 7.8 2.9l6.1-6.1C34.4 6.1 29.5 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20c11 0 19.7-8 19.7-20 0-1.3-.1-2.7-.2-4z" />
                        <path fill="#34A853"
                            d="M6.3 14.7l7 5.1C15 16.1 19.1 13 24 13c3 0 5.7 1.1 7.8 2.9l6.1-6.1C34.4 6.1 29.5 4 24 4 16.2 4 9.5 8.4 6.3 14.7z" />
                        <path fill="#FBBC05"
                            d="M24 44c5.4 0 10.2-1.8 13.9-4.8l-6.4-5.3C29.6 35.6 27 36.5 24 36.5c-5.6 0-10.4-3.8-12.1-9l-7 5.4C8.3 39.7 15.5 44 24 44z" />
                        <path fill="#EA4335"
                            d="M43.6 20H24v8.5h11.3c-.8 2.8-2.6 5.1-5 6.6l6.4 5.3C41.1 36.7 44 30.8 44 24c0-1.4-.1-2.7-.4-4z" />
                    </svg>
                    Continue with Google
                </a>
            </div>

            <div class="footer">
                Don't have an account?
                <a href="{{ route('register') }}">Create one</a>
            </div>

        </section>

    </div>

    <script>
        (function () {
            'use strict';

            let currentToggleListener = null;

            /* ── Password visibility toggle function ── */
            function attachToggleListener() {
                const toggleBtn = document.getElementById('togglePw');
                const passwordField = document.getElementById('password');

                if (!toggleBtn || !passwordField) return false;

                // Remove existing listener if any
                if (currentToggleListener) {
                    toggleBtn.removeEventListener('click', currentToggleListener);
                }

                // Create new listener
                const handler = function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);
                    toggleBtn.classList.toggle('active');

                    // Change eye icon style when active
                    if (type === 'text') {
                        toggleBtn.style.color = '#2563eb';
                    } else {
                        toggleBtn.style.color = '';
                    }
                };

                toggleBtn.addEventListener('click', handler);
                currentToggleListener = handler;

                // Also handle keyboard events
                toggleBtn.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        handler(e);
                    }
                });

                return true;
            }

            /* ── Check and update toggle state based on screen size ── */
            function updateToggleState() {
                const toggleBtn = document.getElementById('togglePw');
                if (!toggleBtn) return;

                const isMobile = window.innerWidth <= 768;

                if (isMobile) {
                    // Ensure toggle is visible and has listener
                    toggleBtn.style.display = 'flex';
                    attachToggleListener();
                } else {
                    // Hide toggle on desktop
                    toggleBtn.style.display = 'none';
                    // Reset password field type to password if it was visible
                    const passwordField = document.getElementById('password');
                    if (passwordField && passwordField.getAttribute('type') === 'text') {
                        passwordField.setAttribute('type', 'password');
                    }
                    // Remove active class if any
                    toggleBtn.classList.remove('active');
                    toggleBtn.style.color = '';
                }
            }

            /* ── Form submission handling ── */
            const form = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');

            if (form && submitBtn) {
                form.addEventListener('submit', function () {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Signing In...';
                });
            }

            /* ── Initialize on page load ── */
            updateToggleState();

            /* ── Listen for resize events with debounce ── */
            let resizeTimeout;
            window.addEventListener('resize', function () {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function () {
                    updateToggleState();
                }, 150);
            });

            /* ── Also listen for orientation changes on mobile ── */
            window.addEventListener('orientationchange', function () {
                setTimeout(updateToggleState, 100);
            });

            /* ── Re-run after any potential dynamic content loads ── */
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', updateToggleState);
            } else {
                updateToggleState();
            }
        })();
    </script>

</body>

</html>