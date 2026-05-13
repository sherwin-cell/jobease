<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>JobEase — Login</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&family=playfair-display:400,500,600,700i" rel="stylesheet">

    <style>
        :root {
            --blue-600: #2563eb;
            --blue-700: #1d4ed8;
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
            --label-color: #0f172a;
            --sub-color: #64748b;
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

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        html, body { width: 100%; height: 100%; overflow: hidden; }

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

        /* ── LEFT ── */
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
            background: rgba(255,255,255,0.07);
            border-radius: 50%;
            top: -80px; right: -80px;
            pointer-events: none;
        }

        .left::after {
            content: '';
            position: absolute;
            width: clamp(100px, 18vw, 200px);
            height: clamp(100px, 18vw, 200px);
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            bottom: -50px; left: -50px;
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
            background: rgba(255,255,255,0.4);
            border-radius: 2px;
            margin-bottom: clamp(16px, 3vh, 28px);
            position: relative;
            z-index: 2;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: clamp(10px, 1.5vh, 18px);
            position: relative;
            z-index: 2;
        }

        .feature-icon {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-icon svg {
            width: 18px;
            height: 18px;
            stroke: white;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
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
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
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
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.3); }
        }

        /* ── RIGHT ── */
        .right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: clamp(24px, 4vh, 48px) clamp(24px, 4vw, 52px);
            overflow: hidden;
        }

        .form-header { margin-bottom: clamp(16px, 2.5vh, 26px); }

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

        .input-group { margin-bottom: 16px; }

        .input-label {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            margin-bottom: 5px;
            color: var(--slate-700);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .input-label svg {
            width: 13px;
            height: 13px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            opacity: 0.6;
        }

        @media (prefers-color-scheme: dark) {
            .input-label { color: #94a3b8; }
        }

        .input-wrap { position: relative; }

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

        input::placeholder { color: var(--slate-400); }

        input:focus {
            border-color: var(--blue-600);
            background: white;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
        }

        @media (prefers-color-scheme: dark) {
            input:focus { background: #0f172a; }
        }

        /* Password Toggle */
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

        @media (min-width: 769px) {
            .pw-toggle { display: none !important; }
            input { padding-right: clamp(10px, 1.5vw, 14px); }
        }

        @media (max-width: 768px) {
            .pw-toggle { display: flex; width: 44px; height: 44px; right: 8px; }
            .eye-icon { width: 22px; height: 22px; }
            input { padding-right: 52px; font-size: 16px; }
        }

        .pw-toggle:hover { color: var(--slate-700); }
        .pw-toggle:active { transform: translateY(-50%) scale(0.95); }

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

        .pw-toggle.active .eye-icon { stroke: var(--blue-600); }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin: 8px 0 16px;
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
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit svg {
            width: 16px;
            height: 16px;
            stroke: white;
            fill: none;
            stroke-width: 2.2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .btn-submit::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.12), transparent);
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(37,99,235,0.32);
        }

        .btn-submit:active:not(:disabled) { transform: translateY(0); }
        .btn-submit:disabled { opacity: 0.65; cursor: not-allowed; }

        /* Divider */
        .or-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 16px 0;
        }

        .or-divider::before,
        .or-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--input-border);
        }

        .or-divider span {
            font-size: 11px;
            font-weight: 700;
            color: var(--sub-color);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* Google Button */
        .btn-google {
            width: 100%;
            padding: clamp(10px, 1.4vh, 13px) 14px;
            border: 1.5px solid var(--input-border);
            border-radius: 10px;
            background: var(--input-bg);
            color: var(--label-color);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(13px, 1.3vw, 14px);
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
        }

        .btn-google:hover {
            border-color: #4285F4;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(66,133,244,0.15);
        }

        .btn-google:active { transform: translateY(0); }

        .footer {
            margin-top: 14px;
            text-align: center;
            font-size: clamp(11px, 1.2vw, 13px);
            color: var(--sub-color);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .footer a {
            color: var(--blue-600);
            font-weight: 700;
            text-decoration: none;
        }

        .footer svg {
            width: 13px;
            height: 13px;
            stroke: var(--sub-color);
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .error-msg {
            margin-top: 6px;
            font-size: 11px;
            font-weight: 600;
            color: var(--red-500);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .error-msg svg {
            width: 12px;
            height: 12px;
            stroke: var(--red-500);
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        /* MOBILE */
        @media (max-width: 768px) {
            html, body { overflow: hidden; }
            .card {
                grid-template-columns: 1fr;
                max-height: 100vh;
                border-radius: 0;
                height: 100%;
            }
            .left { display: none; }
            .right {
                padding: clamp(20px, 4vw, 32px) clamp(18px, 4vw, 28px);
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }
            .form-title, .form-subtitle { text-align: center; }
        }

        /* TABLET */
        @media (min-width: 769px) and (max-width: 1024px) {
            .card { max-width: 900px; }
            .left { padding: 40px 36px; }
            .right { padding: 32px 36px; }
            .brand-logo { font-size: 36px; }
        }

        :focus-visible { outline: 2px solid var(--blue-600); outline-offset: 2px; }
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
                <div class="feature-icon">
                    <!-- Sparkles / AI icon -->
                    <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>
                </div>
                <div class="feature-text">AI-powered career opportunities</div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <!-- Bolt / fast icon -->
                    <svg viewBox="0 0 24 24"><polyline points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <div class="feature-text">Fast, secure job applications</div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <!-- Shield / trusted icon -->
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
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
                    <label class="input-label">
                        <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        Email Address
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        placeholder="you@example.com" autocomplete="email" required>
                    @error('email')
                        <div class="error-msg">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label class="input-label">
                        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Password
                    </label>
                    <div class="input-wrap">
                        <input type="password" name="password" id="password"
                            placeholder="Enter your password" autocomplete="current-password" required>
                        <button type="button" class="pw-toggle" id="togglePw" aria-label="Toggle password visibility">
                            <svg class="eye-icon" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="error-msg">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </div>
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

                <!-- Submit -->
                <button type="submit" class="btn-submit" id="submitBtn">
                    <svg viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    Sign In
                </button>
            </form>

            <!-- Google Login -->
            <div class="or-divider"><span>or</span></div>

            <a href="{{ route('google.login') }}" class="btn-google">
                <svg width="18" height="18" viewBox="0 0 48 48">
                    <path fill="#4285F4" d="M44.5 20H24v8.5h11.7C34.2 33.6 29.7 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3 0 5.7 1.1 7.8 2.9l6.1-6.1C34.4 6.1 29.5 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20c11 0 19.7-8 19.7-20 0-1.3-.1-2.7-.2-4z"/>
                    <path fill="#34A853" d="M6.3 14.7l7 5.1C15 16.1 19.1 13 24 13c3 0 5.7 1.1 7.8 2.9l6.1-6.1C34.4 6.1 29.5 4 24 4 16.2 4 9.5 8.4 6.3 14.7z"/>
                    <path fill="#FBBC05" d="M24 44c5.4 0 10.2-1.8 13.9-4.8l-6.4-5.3C29.6 35.6 27 36.5 24 36.5c-5.6 0-10.4-3.8-12.1-9l-7 5.4C8.3 39.7 15.5 44 24 44z"/>
                    <path fill="#EA4335" d="M43.6 20H24v8.5h11.3c-.8 2.8-2.6 5.1-5 6.6l6.4 5.3C41.1 36.7 44 30.8 44 24c0-1.4-.1-2.7-.4-4z"/>
                </svg>
                Continue with Google
            </a>

            <div class="footer">
                <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Don't have an account?
                <a href="{{ route('register') }}">Create one</a>
            </div>

        </section>
    </div>

    <script>
        (function () {
            'use strict';

            let currentToggleListener = null;

            function attachToggleListener() {
                const toggleBtn = document.getElementById('togglePw');
                const passwordField = document.getElementById('password');
                if (!toggleBtn || !passwordField) return false;
                if (currentToggleListener) toggleBtn.removeEventListener('click', currentToggleListener);

                const handler = function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);
                    toggleBtn.classList.toggle('active');
                    toggleBtn.style.color = type === 'text' ? '#2563eb' : '';
                };

                toggleBtn.addEventListener('click', handler);
                currentToggleListener = handler;
                toggleBtn.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); handler(e); }
                });
                return true;
            }

            function updateToggleState() {
                const toggleBtn = document.getElementById('togglePw');
                if (!toggleBtn) return;
                const isMobile = window.innerWidth <= 768;
                if (isMobile) {
                    toggleBtn.style.display = 'flex';
                    attachToggleListener();
                } else {
                    toggleBtn.style.display = 'none';
                    const passwordField = document.getElementById('password');
                    if (passwordField && passwordField.getAttribute('type') === 'text') {
                        passwordField.setAttribute('type', 'password');
                    }
                    toggleBtn.classList.remove('active');
                    toggleBtn.style.color = '';
                }
            }

            const form = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            if (form && submitBtn) {
                form.addEventListener('submit', function () {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = `<svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:white;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;animation:spin 0.7s linear infinite"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> Signing In...`;
                });
            }

            updateToggleState();

            let resizeTimeout;
            window.addEventListener('resize', function () {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(updateToggleState, 150);
            });
            window.addEventListener('orientationchange', function () {
                setTimeout(updateToggleState, 100);
            });
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', updateToggleState);
            } else {
                updateToggleState();
            }
        })();
    </script>

    <style>
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</body>
</html>