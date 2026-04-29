<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobEase — Create Account</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&family=playfair-display:400,500,600,700i" rel="stylesheet">

    <style>
        /* ─── CSS VARIABLES ─────────────────────────────────────────── */
        :root {
            --blue-600:   #2563eb;
            --blue-700:   #1d4ed8;
            --blue-800:   #1e40af;
            --blue-900:   #1e3a8a;
            --slate-50:   #f8fafc;
            --slate-100:  #f1f5f9;
            --slate-200:  #e2e8f0;
            --slate-400:  #94a3b8;
            --slate-500:  #64748b;
            --slate-700:  #334155;
            --slate-900:  #0f172a;
            --white:      #ffffff;
            --red-500:    #ef4444;
            --green-500:  #22c55e;
            --amber-500:  #f59e0b;

            /* Dark mode overrides */
            --bg-gradient-from: #dbeafe;
            --bg-gradient-to:   #f8fafc;
            --card-bg:          #ffffff;
            --input-bg:         #f8fafc;
            --input-border:     #dbe2ea;
            --label-color:      var(--slate-900);
            --sub-color:        var(--slate-500);
            --footer-color:     var(--slate-500);
            --shadow-color:     rgba(0,0,0,0.12);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg-gradient-from: #0f172a;
                --bg-gradient-to:   #1e293b;
                --card-bg:          #1e293b;
                --input-bg:         #0f172a;
                --input-border:     #334155;
                --label-color:      #e2e8f0;
                --sub-color:        #94a3b8;
                --footer-color:     #94a3b8;
                --shadow-color:     rgba(0,0,0,0.5);
            }
        }

        /* ─── RESET ─────────────────────────────────────────────────── */
        *, *::before, *::after {
            margin: 0; padding: 0;
            box-sizing: border-box;
        }

        /* ─── BODY ───────────────────────────────────────────────────── */
        html, body {
            width: 100%; height: 100%;
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

        /* ─── CARD ───────────────────────────────────────────────────── */
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

        /* ─── LEFT BRANDING ──────────────────────────────────────────── */
        .left {
            background: linear-gradient(145deg, var(--blue-600) 0%, var(--blue-900) 100%);
            color: var(--white);
            padding: clamp(32px, 5vh, 60px) clamp(28px, 4vw, 56px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* decorative orbs */
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
            position: relative; z-index: 2;
        }

        .brand-tagline {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: clamp(14px, 2vw, 17px);
            opacity: 0.85;
            margin-bottom: clamp(16px, 3vh, 32px);
            line-height: 1.6;
            position: relative; z-index: 2;
        }

        .divider {
            width: 48px;
            height: 2px;
            background: rgba(255,255,255,0.4);
            border-radius: 2px;
            margin-bottom: clamp(16px, 3vh, 28px);
            position: relative; z-index: 2;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: clamp(10px, 1.5vh, 16px);
            position: relative; z-index: 2;
        }

        .feature-icon {
            width: 28px;
            height: 28px;
            background: rgba(255,255,255,0.15);
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
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 100px;
            padding: 6px 14px 6px 8px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.3px;
            position: relative; z-index: 2;
            width: fit-content;
        }
        .brand-badge-dot {
            width: 8px; height: 8px;
            background: #4ade80;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.6; transform: scale(1.3); }
        }

        /* ─── RIGHT FORM ─────────────────────────────────────────────── */
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

        /* ─── FORM GRID ──────────────────────────────────────────────── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(10px, 1.5vh, 14px) clamp(10px, 1.5vw, 16px);
        }

        .col-span-2 { grid-column: 1 / -1; }

        /* ─── INPUT GROUP ────────────────────────────────────────────── */
        .input-group {
            display: flex;
            flex-direction: column;
        }

        .input-label {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            color: var(--slate-700);
            margin-bottom: 5px;
        }
        @media (prefers-color-scheme: dark) {
            .input-label { color: #94a3b8; }
        }

        .input-wrap {
            position: relative;
        }

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

        input:focus,
        select:focus {
            border-color: var(--blue-600);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
        }
        @media (prefers-color-scheme: dark) {
            input:focus, select:focus { background: #0f172a; }
        }

        /* custom select arrow */
        .select-wrap::after {
            content: '▾';
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--slate-400);
            pointer-events: none;
            font-size: 13px;
        }

        /* password toggle */
        .pw-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--slate-400);
            font-size: 16px;
            user-select: none;
            line-height: 1;
        }

        input[type="password"],
        input.pw-field {
            padding-right: 38px;
        }

        /* company field slide */
        .company-wrap {
            overflow: hidden;
            max-height: 0;
            opacity: 0;
            transition: max-height 0.35s ease, opacity 0.3s ease, margin 0.3s ease;
        }
        .company-wrap.visible {
            max-height: 80px;
            opacity: 1;
        }

        /* ─── PASSWORD STRENGTH ──────────────────────────────────────── */
        .strength-bar-row {
            display: flex;
            gap: 4px;
            margin-top: 6px;
        }
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

        /* ─── ERROR TEXT ─────────────────────────────────────────────── */
        .error-msg {
            font-size: 11px;
            font-weight: 600;
            color: var(--red-500);
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ─── CHECKBOX ───────────────────────────────────────────────── */
        .checkbox-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 2px;
        }
        .checkbox-row input[type="checkbox"] {
            width: 16px; height: 16px;
            min-width: 16px;
            border-radius: 4px;
            border: 1.5px solid var(--input-border);
            background: var(--input-bg);
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

        /* ─── SUBMIT BUTTON ──────────────────────────────────────────── */
        .btn-submit {
            width: 100%;
            padding: clamp(11px, 1.6vh, 14px);
            background: linear-gradient(135deg, var(--blue-600) 0%, var(--blue-800) 100%);
            color: white;
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
            background: linear-gradient(135deg, rgba(255,255,255,0.12), transparent);
        }
        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(37,99,235,0.32);
        }
        .btn-submit:active:not(:disabled) {
            transform: translateY(0);
        }
        .btn-submit:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        /* spinner inside button */
        .spinner {
            display: inline-block;
            width: 14px; height: 14px;
            border: 2px solid rgba(255,255,255,0.4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            vertical-align: middle;
            margin-right: 8px;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ─── FOOTER ─────────────────────────────────────────────────── */
        .form-footer {
            text-align: center;
            margin-top: clamp(10px, 1.5vh, 16px);
            font-size: clamp(11px, 1.2vw, 13px);
            color: var(--footer-color);
            font-weight: 500;
        }
        .form-footer a {
            color: var(--blue-600);
            font-weight: 700;
            text-decoration: none;
        }
        .form-footer a:hover { text-decoration: underline; }

        /* ─── MOBILE ─────────────────────────────────────────────────── */
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

            .form-grid {
                grid-template-columns: 1fr;
            }
            .col-span-2 { grid-column: 1; }
        }

        /* ─── TABLET ─────────────────────────────────────────────────── */
        @media (min-width: 769px) and (max-width: 1024px) {
            .card { max-width: 900px; }
            .left { padding: 40px 36px; }
            .right { padding: 32px 36px; }
            .brand-logo { font-size: 36px; }
            .form-grid { gap: 10px 12px; }
        }

        /* ─── FOCUS VISIBLE (accessibility) ─────────────────────────── */
        :focus-visible {
            outline: 2px solid var(--blue-600);
            outline-offset: 2px;
        }
    </style>
</head>
<body>

<div class="card" role="main">

    <!-- ── LEFT BRANDING ─────────────────────────────────────────── -->
    <aside class="left" aria-label="JobEase branding">

        <div class="brand-logo">JobEase</div>
        <div class="brand-tagline">Start your career journey<br>with confidence.</div>

        <div class="divider"></div>

        <div class="feature">
            <div class="feature-icon">✦</div>
            <div class="feature-text">Smart job matching</div>
        </div>
        <div class="feature">
            <div class="feature-icon">⚡</div>
            <div class="feature-text">Quick & streamlined hiring process</div>
        </div>
        <div class="feature">
            <div class="feature-icon">🔒</div>
            <div class="feature-text">Secure &amp; trusted by users</div>
        </div>

        <div class="brand-badge">
            <div class="brand-badge-dot"></div>
            Hiring is live now
        </div>

    </aside>

    <!-- ── RIGHT FORM ─────────────────────────────────────────────── -->
    <section class="right" aria-label="Registration form">

        <div class="form-header">
            <div class="form-title">Create Account</div>
            <div class="form-subtitle">Join thousands of professionals on JobEase</div>
        </div>

        <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
            @csrf

            <div class="form-grid">

                <!-- Full Name -->
                <div class="input-group col-span-2">
                    <label class="input-label" for="name">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Maria Santos"
                        value="{{ old('name') }}"
                        autocomplete="name"
                        required>
                    @error('name')
                        <div class="error-msg">⚠ {{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="input-group col-span-2">
                    <label class="input-label" for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required>
                    @error('email')
                        <div class="error-msg">⚠ {{ $message }}</div>
                    @enderror
                </div>

                <!-- Account Type -->
                <div class="input-group col-span-2">
                    <label class="input-label" for="roleSelect">Account Type</label>
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
                        <div class="error-msg">⚠ {{ $message }}</div>
                    @enderror
                </div>

                <!-- Company Name (dynamic) -->
                <div class="col-span-2">
                    <div class="company-wrap" id="companyWrap">
                        <div class="input-group">
                            <label class="input-label" for="company_name">Company Name</label>
                            <input
                                type="text"
                                id="company_name"
                                name="company_name"
                                placeholder="Acme Corp."
                                value="{{ old('company_name') }}"
                                autocomplete="organization">
                            @error('company_name')
                                <div class="error-msg">⚠ {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label class="input-label" for="password">Password</label>
                    <div class="input-wrap">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="pw-field"
                            placeholder="Create password"
                            autocomplete="new-password"
                            required>
                        <span class="pw-toggle" id="togglePw" aria-label="Toggle password visibility">👁️</span>
                    </div>
                    <div class="strength-bar-row" aria-hidden="true">
                        <div class="strength-seg" id="seg1"></div>
                        <div class="strength-seg" id="seg2"></div>
                        <div class="strength-seg" id="seg3"></div>
                        <div class="strength-seg" id="seg4"></div>
                    </div>
                    <div class="strength-label" id="strengthLabel">8+ chars, uppercase, number</div>
                    @error('password')
                        <div class="error-msg">⚠ {{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="input-group">
                    <label class="input-label" for="password_confirmation">Confirm Password</label>
                    <div class="input-wrap">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="pw-field"
                            placeholder="Repeat password"
                            autocomplete="new-password"
                            required>
                        <span class="pw-toggle" id="togglePwC" aria-label="Toggle confirm password visibility">👁️</span>
                    </div>
                    <div class="strength-label" id="matchLabel"></div>
                    @error('password_confirmation')
                        <div class="error-msg">⚠ {{ $message }}</div>
                    @enderror
                </div>

                <!-- Terms -->
                <div class="col-span-2">
                    <div class="checkbox-row">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">
                            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                        </label>
                    </div>
                </div>

            </div><!-- /form-grid -->

            <button type="submit" class="btn-submit" id="submitBtn">
                Create Account
            </button>

        </form>

        <div class="form-footer">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </div>

    </section>
</div>

<script>
(function () {
    'use strict';

    /* ── Role → Company toggle ─────────────────────────────── */
    const roleSelect   = document.getElementById('roleSelect');
    const companyWrap  = document.getElementById('companyWrap');
    const companyInput = document.getElementById('company_name');

    function syncCompany() {
        const text = roleSelect.options[roleSelect.selectedIndex]?.text.toLowerCase() ?? '';
        const isEmployer = text.includes('employer');
        companyWrap.classList.toggle('visible', isEmployer);
        companyInput.required = isEmployer;
        if (!isEmployer) companyInput.value = '';
    }

    roleSelect.addEventListener('change', syncCompany);

    // Restore state on page load (Laravel old() value)
    syncCompany();

    /* ── Password visibility toggles ──────────────────────── */
    function makeToggle(inputId, toggleId) {
        const inp = document.getElementById(inputId);
        const btn = document.getElementById(toggleId);
        btn.addEventListener('click', () => {
            const isText = inp.type === 'text';
            inp.type = isText ? 'password' : 'text';
            btn.textContent = isText ? '👁️' : '🙈';
        });
    }
    makeToggle('password', 'togglePw');
    makeToggle('password_confirmation', 'togglePwC');

    /* ── Password strength meter ───────────────────────────── */
    const pwInput       = document.getElementById('password');
    const pwConfirm     = document.getElementById('password_confirmation');
    const segs          = [1,2,3,4].map(i => document.getElementById('seg'+i));
    const strengthLabel = document.getElementById('strengthLabel');
    const matchLabel    = document.getElementById('matchLabel');

    const COLORS = ['#ef4444', '#f59e0b', '#3b82f6', '#22c55e'];
    const LABELS = ['Too short', 'Weak', 'Good', 'Strong'];

    function calcStrength(pw) {
        let score = 0;
        if (pw.length >= 8)  score++;
        if (/[A-Z]/.test(pw)) score++;
        if (/[0-9]/.test(pw)) score++;
        if (/[^A-Za-z0-9]/.test(pw)) score++;
        return Math.max(0, score - 1); // 0–3
    }

    pwInput.addEventListener('input', function () {
        const pw  = this.value;
        const idx = pw.length === 0 ? -1 : calcStrength(pw);

        segs.forEach((s, i) => {
            s.style.background = (pw.length && i <= idx)
                ? COLORS[idx]
                : 'var(--input-border)';
        });

        strengthLabel.textContent = pw.length
            ? LABELS[idx]
            : '8+ chars, uppercase, number';
        strengthLabel.style.color = pw.length ? COLORS[idx] : 'var(--slate-400)';

        // also update match
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

    /* ── Submit state ──────────────────────────────────────── */
    const form      = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner"></span>Creating Account…';
    });
})();
</script>

</body>
</html>