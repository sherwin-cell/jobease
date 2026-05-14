<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>JobEase — Create Account</title>

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
            --green-500: #22c55e;
            --amber-500: #f59e0b;

            --bg-gradient-from: #dbeafe;
            --bg-gradient-to: #f8fafc;
            --card-bg: #ffffff;
            --input-bg: #f8fafc;
            --input-border: #dbe2ea;
            --label-color: #0f172a;
            --sub-color: #64748b;
            --footer-color: #64748b;
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
                --footer-color: #94a3b8;
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

        .form-header { margin-bottom: clamp(12px, 2vh, 20px); }

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

        /* ── FORM GRID ── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(8px, 1.2vh, 12px) clamp(10px, 1.5vw, 16px);
        }

        .col-span-2 { grid-column: 1 / -1; }

        /* ── INPUT GROUP ── */
        .input-group { display: flex; flex-direction: column; }

        .input-label {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            color: var(--slate-700);
            margin-bottom: 5px;
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

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
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
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            -webkit-appearance: none;
            appearance: none;
        }

        input::placeholder { color: var(--slate-400); }

        input:focus, select:focus {
            border-color: var(--blue-600);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
        }

        @media (prefers-color-scheme: dark) {
            input:focus, select:focus { background: #0f172a; }
        }

        .select-wrap::after {
            content: '';
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 5px solid var(--slate-400);
            pointer-events: none;
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
            input[type="password"], input.pw-field { padding-right: clamp(10px, 1.5vw, 14px); }
        }

        @media (max-width: 768px) {
            .pw-toggle { display: flex; width: 44px; height: 44px; right: 8px; }
            .eye-icon { width: 22px; height: 22px; }
            input[type="password"], input.pw-field { padding-right: 52px; font-size: 16px; }
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
        }

        .pw-toggle.active .eye-icon { stroke: var(--blue-600); }

        /* Company wrap */
        .company-wrap {
            overflow: hidden;
            max-height: 0;
            opacity: 0;
            transition: max-height 0.35s ease, opacity 0.3s ease;
        }

        .company-wrap.visible { max-height: 80px; opacity: 1; }

        /* Strength bar */
        .strength-bar-row { display: flex; gap: 4px; margin-top: 6px; }

        .strength-seg {
            height: 3px;
            flex: 1;
            border-radius: 3px;
            background: var(--input-border);
            transition: background 0.3s;
        }

        .strength-label {
            font-size: 11px;
            font-weight: 600;
            margin-top: 3px;
            color: var(--slate-400);
            transition: color 0.3s;
        }

        /* Error */
        .error-msg {
            font-size: 11px;
            font-weight: 600;
            color: var(--red-500);
            margin-top: 4px;
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

        /* Checkbox */
        .checkbox-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 2px;
        }

        .checkbox-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            min-width: 16px;
            border-radius: 4px;
            cursor: pointer;
            padding: 0;
            margin-top: 2px;
            accent-color: var(--blue-600);
        }

        .checkbox-row label {
            font-size: clamp(11px, 1.2vw, 13px);
            color: var(--sub-color);
            font-weight: 500;
            line-height: 1.5;
            cursor: pointer;
            text-transform: none;
            letter-spacing: 0;
        }

        .checkbox-row label a {
            color: var(--blue-600);
            font-weight: 700;
            text-decoration: none;
        }

        .checkbox-row label a:hover { text-decoration: underline; }

        /* Submit Button */
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
            margin-top: clamp(8px, 1.2vh, 14px);
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

        /* OR Divider */
        .or-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 12px 0;
        }

        .or-divider::before, .or-divider::after {
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

        /* Footer */
        .form-footer {
            text-align: center;
            margin-top: 12px;
            font-size: clamp(11px, 1.2vw, 13px);
            color: var(--footer-color);
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .form-footer svg {
            width: 13px;
            height: 13px;
            stroke: var(--sub-color);
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .form-footer a {
            color: var(--blue-600);
            font-weight: 700;
            text-decoration: none;
        }

        .form-footer a:hover { text-decoration: underline; }

        @keyframes spin { to { transform: rotate(360deg); } }

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
            .form-grid { grid-template-columns: 1fr; }
            .col-span-2 { grid-column: 1; }
        }

        /* TABLET */
        @media (min-width: 769px) and (max-width: 1024px) {
            .card { max-width: 900px; }
            .left { padding: 40px 36px; }
            .right { padding: 32px 36px; }
            .brand-logo { font-size: 36px; }
            .form-grid { gap: 10px 12px; }
        }

        :focus-visible { outline: 2px solid var(--blue-600); outline-offset: 2px; }
    </style>
</head>

<body>
    <div class="card" role="main">

        <!-- LEFT -->
        <aside class="left" aria-label="JobEase branding">
            <div class="brand-logo">JobEase</div>
            <div class="brand-tagline">Start your career journey<br>with confidence.</div>
            <div class="divider"></div>

            <div class="feature">
                <div class="feature-icon">
                    <!-- Target / smart matching -->
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                </div>
                <div class="feature-text">Smart job matching</div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <!-- Bolt / streamlined -->
                    <svg viewBox="0 0 24 24"><polyline points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <div class="feature-text">Quick &amp; streamlined hiring process</div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <!-- Shield check / trusted -->
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                </div>
                <div class="feature-text">Secure &amp; trusted by users</div>
            </div>

            <div class="brand-badge">
                <div class="brand-badge-dot"></div>
                Hiring is live now
            </div>
        </aside>

        <!-- RIGHT -->
        <section class="right" aria-label="Registration form">
            <div class="form-header">
                <div class="form-title">Create Account</div>
                <div class="form-subtitle">Join thousands of professionals on JobEase</div>
            </div>

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <div class="form-grid">

                    <!-- Full Name -->
                    <div class="input-group col-span-2">
                        <label class="input-label" for="name">
                            <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Full Name
                        </label>
                        <input type="text" id="name" name="name" placeholder="Maria Santos"
                            value="{{ old('name') }}" autocomplete="name" required>
                        @error('name')
                            <div class="error-msg">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="input-group col-span-2">
                        <label class="input-label" for="email">
                            <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            Email Address
                        </label>
                        <input type="email" id="email" name="email" placeholder="you@example.com"
                            value="{{ old('email') }}" autocomplete="email" required>
                        @error('email')
                            <div class="error-msg">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Account Type -->
                    <div class="input-group col-span-2">
                        <label class="input-label" for="roleSelect">
                            <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                            Account Type
                        </label>
                        <div class="input-wrap select-wrap">
                            <select id="roleSelect" name="role_id" required>
                                <option value="">Select your role…</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        @if($role->name === 'job_seeker')
                                            Job Seeker
                                        @elseif($role->name === 'employer')
                                            Employer
                                        @else
                                            {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('role_id')
                            <div class="error-msg">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Company Name (employer only) -->
                    <div class="col-span-2">
                        <div class="company-wrap" id="companyWrap">
                            <div class="input-group">
                                <label class="input-label" for="company_name">
                                    <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                                    Company Name
                                </label>
                                <input type="text" id="company_name" name="company_name"
                                    placeholder="Acme Corp." value="{{ old('company_name') }}"
                                    autocomplete="organization">
                                @error('company_name')
                                    <div class="error-msg">
                                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="input-group">
                        <label class="input-label" for="password">
                            <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Password
                        </label>
                        <div class="input-wrap">
                            <input type="password" id="password" name="password" class="pw-field"
                                placeholder="Create password" autocomplete="new-password" required>
                            <button type="button" class="pw-toggle" id="togglePassword" aria-label="Toggle password visibility">
                                <svg class="eye-icon" viewBox="0 0 24 24">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                        <div class="strength-bar-row" aria-hidden="true">
                            <div class="strength-seg" id="seg1"></div>
                            <div class="strength-seg" id="seg2"></div>
                            <div class="strength-seg" id="seg3"></div>
                            <div class="strength-seg" id="seg4"></div>
                        </div>
                        <div class="strength-label" id="strengthLabel">8+ chars, uppercase, number</div>
                        @error('password')
                            <div class="error-msg">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="input-group">
                        <label class="input-label" for="password_confirmation">
                            <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/><polyline points="9 16 11 18 15 14"/></svg>
                            Confirm Password
                        </label>
                        <div class="input-wrap">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="pw-field" placeholder="Repeat password" autocomplete="new-password" required>
                            <button type="button" class="pw-toggle" id="toggleConfirmPassword" aria-label="Toggle confirm password visibility">
                                <svg class="eye-icon" viewBox="0 0 24 24">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                        <div class="strength-label" id="matchLabel"></div>
                        @error('password_confirmation')
                            <div class="error-msg">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Terms -->
                    <div class="col-span-2">
                        <div class="checkbox-row">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">
                                I agree to the
                                <a href="{{ route('terms') }}" target="_blank" rel="noopener noreferrer">Terms of Service</a>
                                and
                                <a href="{{ route('privacy') }}" target="_blank" rel="noopener noreferrer">Privacy Policy</a>
                            </label>
                            @error('terms')
                                <div class="error-msg">
                                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit" id="submitBtn">
                    <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                    Create Account
                </button>
            </form>

            <!-- Google Register -->
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

            <div class="form-footer">
                <svg viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                Already have an account?
                <a href="{{ route('login') }}">Sign in</a>
            </div>
        </section>
    </div>

    <script>
        (function () {
            'use strict';

            let currentToggleListeners = {};

            const roleSelect = document.getElementById('roleSelect');
            const companyWrap = document.getElementById('companyWrap');
            const companyInput = document.getElementById('company_name');
            const registerForm = document.getElementById('registerForm');

            function syncCompany() {
                const text = roleSelect.options[roleSelect.selectedIndex]?.text.toLowerCase() ?? '';
                const isEmployer = text.includes('employer');
                companyWrap.classList.toggle('visible', isEmployer);
                companyInput.required = isEmployer;
                if (!isEmployer) companyInput.value = '';
            }

            function updateFormAction() {
                const text = roleSelect.options[roleSelect.selectedIndex]?.text.toLowerCase() ?? '';
                const isEmployer = text.includes('employer');
                registerForm.action = isEmployer ? "{{ route('employer.register') }}" : "{{ route('register') }}";
            }

            roleSelect.addEventListener('change', function () { syncCompany(); updateFormAction(); });
            syncCompany();
            updateFormAction();

            function attachToggleListener(toggleButtonId, passwordFieldId) {
                const toggleBtn = document.getElementById(toggleButtonId);
                const passwordField = document.getElementById(passwordFieldId);
                if (!toggleBtn || !passwordField) return false;
                if (currentToggleListeners[toggleButtonId]) {
                    toggleBtn.removeEventListener('click', currentToggleListeners[toggleButtonId]);
                }
                const handler = function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);
                    toggleBtn.classList.toggle('active');
                    toggleBtn.style.color = type === 'text' ? '#2563eb' : '';
                };
                toggleBtn.addEventListener('click', handler);
                currentToggleListeners[toggleButtonId] = handler;
                toggleBtn.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); handler(e); }
                });
                return true;
            }

            function updatePasswordToggles() {
                const isMobile = window.innerWidth <= 768;
                ['togglePassword', 'toggleConfirmPassword'].forEach(btnId => {
                    const toggleBtn = document.getElementById(btnId);
                    if (!toggleBtn) return;
                    if (isMobile) {
                        toggleBtn.style.display = 'flex';
                        attachToggleListener(btnId, btnId === 'togglePassword' ? 'password' : 'password_confirmation');
                    } else {
                        toggleBtn.style.display = 'none';
                        const fieldId = btnId === 'togglePassword' ? 'password' : 'password_confirmation';
                        const f = document.getElementById(fieldId);
                        if (f && f.getAttribute('type') === 'text') f.setAttribute('type', 'password');
                        toggleBtn.classList.remove('active');
                        toggleBtn.style.color = '';
                    }
                });
            }

            const pwInput = document.getElementById('password');
            const pwConfirm = document.getElementById('password_confirmation');
            const segs = [1,2,3,4].map(i => document.getElementById('seg' + i));
            const strengthLabel = document.getElementById('strengthLabel');
            const matchLabel = document.getElementById('matchLabel');
            const COLORS = ['#ef4444','#f59e0b','#3b82f6','#22c55e'];
            const LABELS = ['Too short','Weak','Good','Strong'];

            function calcStrength(pw) {
                let score = 0;
                if (pw.length >= 8) score++;
                if (/[A-Z]/.test(pw)) score++;
                if (/[0-9]/.test(pw)) score++;
                if (/[^A-Za-z0-9]/.test(pw)) score++;
                return Math.max(0, score - 1);
            }

            pwInput.addEventListener('input', function () {
                const pw = this.value;
                const idx = pw.length === 0 ? -1 : calcStrength(pw);
                segs.forEach((seg, i) => { seg.style.background = (pw.length && i <= idx) ? COLORS[idx] : 'var(--input-border)'; });
                strengthLabel.textContent = pw.length ? LABELS[idx] : '8+ chars, uppercase, number';
                strengthLabel.style.color = pw.length ? COLORS[idx] : 'var(--slate-400)';
                checkMatch();
            });

            function checkMatch() {
                const pw = pwInput.value;
                const pc = pwConfirm.value;
                if (!pc) { matchLabel.textContent = ''; return; }
                const ok = pw === pc;
                matchLabel.textContent = ok ? '✔ Passwords match' : '✗ Passwords do not match';
                matchLabel.style.color = ok ? '#22c55e' : '#ef4444';
            }

            pwConfirm.addEventListener('input', checkMatch);

            const submitBtn = document.getElementById('submitBtn');
            const termsCheckbox = document.getElementById('terms');

            function validateTerms() {
                if (!termsCheckbox.checked) {
                    let termsError = document.getElementById('terms-error');
                    if (!termsError) {
                        termsError = document.createElement('div');
                        termsError.id = 'terms-error';
                        termsError.className = 'error-msg';
                        termsError.style.marginTop = '8px';
                        termsCheckbox.closest('.checkbox-row').appendChild(termsError);
                    }
                    termsError.innerHTML = '<svg viewBox="0 0 24 24" style="width:12px;height:12px;stroke:#ef4444;fill:none;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> You must agree to the Terms of Service and Privacy Policy';
                    return false;
                }
                const existingError = document.getElementById('terms-error');
                if (existingError) existingError.remove();
                return true;
            }

            if (registerForm && submitBtn) {
                registerForm.addEventListener('submit', function (e) {
                    if (!validateTerms()) {
                        e.preventDefault();
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:white;fill:none;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg> Create Account';
                        return false;
                    }
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:white;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;animation:spin 0.7s linear infinite"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> Creating Account…';
                });
            }

            updatePasswordToggles();

            let resizeTimeout;
            window.addEventListener('resize', function () {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(updatePasswordToggles, 150);
            });
            window.addEventListener('orientationchange', function () { setTimeout(updatePasswordToggles, 100); });
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', updatePasswordToggles);
            } else {
                updatePasswordToggles();
            }
        })();
    </script>
</body>
</html>