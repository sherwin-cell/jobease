<!-- =========================================================
JobEase — Premium Login Page (Matching Register Design)
Responsive | Dark Mode | Laravel Blade Ready
========================================================= -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobEase — Login</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&family=playfair-display:400,500,600,700i" rel="stylesheet">

    <style>
        :root {
            --blue-600:#2563eb;
            --blue-700:#1d4ed8;
            --blue-800:#1e40af;
            --blue-900:#1e3a8a;

            --slate-50:#f8fafc;
            --slate-100:#f1f5f9;
            --slate-200:#e2e8f0;
            --slate-400:#94a3b8;
            --slate-500:#64748b;
            --slate-700:#334155;
            --slate-900:#0f172a;

            --white:#ffffff;
            --red-500:#ef4444;

            --bg-gradient-from:#dbeafe;
            --bg-gradient-to:#f8fafc;
            --card-bg:#ffffff;
            --input-bg:#f8fafc;
            --input-border:#dbe2ea;
            --label-color:var(--slate-900);
            --sub-color:var(--slate-500);
            --shadow-color:rgba(0,0,0,0.12);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg-gradient-from:#0f172a;
                --bg-gradient-to:#1e293b;
                --card-bg:#1e293b;
                --input-bg:#0f172a;
                --input-border:#334155;
                --label-color:#e2e8f0;
                --sub-color:#94a3b8;
                --shadow-color:rgba(0,0,0,0.5);
            }
        }

        * {
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        html, body {
            width:100%;
            min-height:100%;
            overflow-x:hidden;
        }

        body {
            font-family:'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(ellipse at 30% 0%, var(--bg-gradient-from), var(--bg-gradient-to) 70%);
            display:flex;
            align-items:center;
            justify-content:center;
            padding:clamp(10px,2vh,24px);
            color:var(--label-color);
        }

        .card {
            width:100%;
            max-width:1080px;
            min-height:min(92vh,760px);
            display:grid;
            grid-template-columns:1fr 1fr;
            background:var(--card-bg);
            border-radius:24px;
            overflow:hidden;
            box-shadow:0 24px 64px var(--shadow-color);
        }

        /* LEFT */
        .left {
            background: linear-gradient(145deg, var(--blue-600) 0%, var(--blue-900) 100%);
            color:white;
            padding:clamp(32px,5vh,60px) clamp(28px,4vw,56px);
            display:flex;
            flex-direction:column;
            justify-content:center;
            position:relative;
            overflow:hidden;
        }

        .left::before {
            content:'';
            position:absolute;
            width:320px;
            height:320px;
            background:rgba(255,255,255,0.07);
            border-radius:50%;
            top:-80px;
            right:-80px;
        }

        .left::after {
            content:'';
            position:absolute;
            width:200px;
            height:200px;
            background:rgba(255,255,255,0.05);
            border-radius:50%;
            bottom:-50px;
            left:-50px;
        }

        .brand-logo {
            font-family:'Playfair Display', serif;
            font-size:clamp(34px,5vw,48px);
            font-weight:700;
            margin-bottom:8px;
            position:relative;
            z-index:2;
        }

        .brand-tagline {
            font-family:'Playfair Display', serif;
            font-style:italic;
            font-size:clamp(14px,2vw,17px);
            line-height:1.7;
            opacity:0.9;
            margin-bottom:28px;
            position:relative;
            z-index:2;
        }

        .divider {
            width:48px;
            height:2px;
            background:rgba(255,255,255,0.4);
            margin-bottom:28px;
            border-radius:2px;
            position:relative;
            z-index:2;
        }

        .feature {
            display:flex;
            align-items:center;
            gap:12px;
            margin-bottom:16px;
            position:relative;
            z-index:2;
        }

        .feature-icon {
            width:28px;
            height:28px;
            border-radius:8px;
            background:rgba(255,255,255,0.15);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:13px;
        }

        .feature-text {
            font-size:14px;
            font-weight:500;
            opacity:0.95;
        }

        .brand-badge {
            margin-top:32px;
            display:inline-flex;
            align-items:center;
            gap:8px;
            background:rgba(255,255,255,0.12);
            border:1px solid rgba(255,255,255,0.2);
            border-radius:100px;
            padding:6px 14px 6px 8px;
            font-size:12px;
            font-weight:700;
            width:fit-content;
            position:relative;
            z-index:2;
        }

        .brand-badge-dot {
            width:8px;
            height:8px;
            border-radius:50%;
            background:#4ade80;
            animation:pulse 2s infinite;
        }

        @keyframes pulse {
            0%,100% {transform:scale(1);opacity:1;}
            50% {transform:scale(1.3);opacity:0.6;}
        }

        /* RIGHT */
        .right {
            display:flex;
            flex-direction:column;
            justify-content:center;
            padding:clamp(28px,4vh,48px) clamp(24px,4vw,52px);
        }

        .form-title {
            font-size:clamp(26px,3vw,34px);
            font-weight:800;
            margin-bottom:6px;
        }

        .form-subtitle {
            color:var(--sub-color);
            font-size:14px;
            margin-bottom:30px;
            font-weight:500;
        }

        .input-group {
            margin-bottom:18px;
        }

        .input-label {
            display:block;
            font-size:12px;
            font-weight:700;
            letter-spacing:0.4px;
            text-transform:uppercase;
            margin-bottom:6px;
            color:var(--slate-700);
        }

        @media (prefers-color-scheme: dark) {
            .input-label { color:#94a3b8; }
        }

        .input-wrap {
            position:relative;
        }

        input {
            width:100%;
            padding:14px 45px 14px 14px;
            border-radius:12px;
            border:1.5px solid var(--input-border);
            background:var(--input-bg);
            color:var(--label-color);
            outline:none;
            font-size:14px;
            font-weight:500;
            transition:0.25s;
        }

        input:focus {
            border-color:var(--blue-600);
            background:white;
            box-shadow:0 0 0 4px rgba(37,99,235,0.1);
        }

        @media (prefers-color-scheme: dark) {
            input:focus { background:#0f172a; }
        }

        .pw-toggle {
            position:absolute;
            right:14px;
            top:50%;
            transform:translateY(-50%);
            cursor:pointer;
            color:var(--slate-400);
            font-size:18px;
        }

        .options {
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            gap:10px;
            margin:8px 0 18px;
        }

        .remember {
            display:flex;
            align-items:center;
            gap:8px;
            font-size:13px;
            color:var(--sub-color);
        }

        .remember input {
            width:16px;
            height:16px;
            accent-color:var(--blue-600);
            padding:0;
        }

        .options a {
            color:var(--blue-600);
            text-decoration:none;
            font-size:13px;
            font-weight:700;
        }

        .btn-submit {
            width:100%;
            padding:14px;
            border:none;
            border-radius:12px;
            background:linear-gradient(135deg, var(--blue-600), var(--blue-800));
            color:white;
            font-size:15px;
            font-weight:700;
            cursor:pointer;
            transition:0.25s;
            margin-top:8px;
        }

        .btn-submit:hover {
            transform:translateY(-2px);
            box-shadow:0 10px 28px rgba(37,99,235,0.28);
        }

        .btn-submit:disabled {
            opacity:0.7;
            cursor:not-allowed;
        }

        .footer {
            margin-top:22px;
            text-align:center;
            font-size:13px;
            color:var(--sub-color);
        }

        .footer a {
            color:var(--blue-600);
            text-decoration:none;
            font-weight:700;
        }

        .error-msg {
            margin-top:6px;
            color:var(--red-500);
            font-size:12px;
            font-weight:600;
        }

        /* MOBILE */
        @media (max-width:768px) {
            .card {
                grid-template-columns:1fr;
                min-height:100vh;
                border-radius:0;
            }

            .left {
                display:none;
            }

            .right {
                padding:30px 22px 80px;
            }

            .form-title,
            .form-subtitle {
                text-align:center;
            }
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

        <div class="form-title">Welcome Back</div>
        <div class="form-subtitle">Sign in to continue your JobEase journey</div>

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <!-- Email -->
            <div class="input-group">
                <label class="input-label">Email Address</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="you@example.com"
                    autocomplete="email"
                    required>

                @error('email')
                    <div class="error-msg">⚠ {{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-group">
                <label class="input-label">Password</label>
                <div class="input-wrap">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required>

                    <span class="pw-toggle" id="togglePw">👁️</span>
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

            <!-- Submit -->
            <button type="submit" class="btn-submit" id="submitBtn">
                Sign In
            </button>

        </form>

        <div class="footer">
            Don’t have an account?
            <a href="{{ route('register') }}">Create one</a>
        </div>

    </section>

</div>

<script>
(function () {
    'use strict';

    // Password toggle
    const password = document.getElementById('password');
    const togglePw = document.getElementById('togglePw');

    togglePw.addEventListener('click', function () {
        const isHidden = password.type === 'password';
        password.type = isHidden ? 'text' : 'password';
        togglePw.textContent = isHidden ? '🙈' : '👁️';
    });

    // Submit loading
    const form = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Signing In...';
    });
})();
</script>

</body>
</html>