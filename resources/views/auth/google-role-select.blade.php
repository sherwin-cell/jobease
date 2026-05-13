<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobEase — Choose Your Role</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&family=playfair-display:400,500,600,700i" rel="stylesheet">
    <style>
        :root {
            --blue-600: #2563eb;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-900: #0f172a;
            --bg-from: #dbeafe;
            --bg-to: #f8fafc;
            --card-bg: #ffffff;
            --input-border: #dbe2ea;
            --label-color: #0f172a;
            --sub-color: #64748b;
            --shadow: rgba(0,0,0,0.12);
        }
        @media (prefers-color-scheme: dark) {
            :root {
                --bg-from: #0f172a;
                --bg-to: #1e293b;
                --card-bg: #1e293b;
                --input-border: #334155;
                --label-color: #e2e8f0;
                --sub-color: #94a3b8;
                --shadow: rgba(0,0,0,0.5);
            }
        }
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { width: 100%; height: 100%; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(ellipse at 30% 0%, var(--bg-from), var(--bg-to) 70%);
            color: var(--label-color);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 24px;
        }
        .card {
            background: var(--card-bg);
            border-radius: 24px;
            box-shadow: 0 24px 64px var(--shadow);
            padding: clamp(32px, 5vw, 56px);
            width: 100%;
            max-width: 560px;
            text-align: center;
        }
        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, #0F2854, #4988C4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }
        .title {
            font-size: clamp(20px, 3vw, 26px);
            font-weight: 800;
            color: var(--label-color);
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }
        .subtitle {
            font-size: 14px;
            color: var(--sub-color);
            margin-bottom: 36px;
            font-weight: 500;
        }
        .roles {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 32px;
        }
        .role-card {
            border: 2px solid var(--input-border);
            border-radius: 16px;
            padding: 28px 20px;
            cursor: pointer;
            transition: all 0.25s;
            position: relative;
            background: transparent;
        }
        .role-card:hover {
            border-color: var(--blue-600);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(37,99,235,0.15);
        }
        .role-card.selected {
            border-color: var(--blue-600);
            background: rgba(37,99,235,0.06);
            box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
        }
        .role-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }
        .role-icon {
            font-size: 40px;
            margin-bottom: 12px;
            display: block;
        }
        .role-name {
            font-size: 16px;
            font-weight: 700;
            color: var(--label-color);
            margin-bottom: 6px;
        }
        .role-desc {
            font-size: 12px;
            color: var(--sub-color);
            font-weight: 500;
            line-height: 1.5;
        }
        .check-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 22px;
            height: 22px;
            background: var(--blue-600);
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .role-card.selected .check-badge {
            display: flex;
        }
        .check-badge svg {
            width: 12px;
            height: 12px;
            stroke: white;
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s, opacity 0.2s;
        }
        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(37,99,235,0.3);
        }
        .btn-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .error-msg {
            color: #ef4444;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 16px;
        }
        @media (max-width: 480px) {
            .roles { grid-template-columns: 1fr; }
            .card { padding: 28px 20px; border-radius: 0; }
            body { padding: 0; align-items: stretch; }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="brand">JobEase</div>
        <div class="title">How will you use JobEase?</div>
        <div class="subtitle">Choose your role to get started — you can only pick one.</div>

        @if ($errors->any())
            <div class="error-msg">⚠ Please select a role to continue.</div>
        @endif

        <form method="POST" action="{{ route('google.store.role') }}" id="roleForm">
            @csrf
            <div class="roles">

                <!-- Job Seeker -->
                <label class="role-card" id="card-job_seeker">
                    <input type="radio" name="role" value="job_seeker" id="role-job_seeker">
                    <div class="check-badge">
                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <span class="role-icon">🧑‍💼</span>
                    <div class="role-name">Job Seeker</div>
                    <div class="role-desc">Browse jobs and apply to opportunities that match your skills</div>
                </label>

                <!-- Employer -->
                <label class="role-card" id="card-employer">
                    <input type="radio" name="role" value="employer" id="role-employer">
                    <div class="check-badge">
                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <span class="role-icon">🏢</span>
                    <div class="role-name">Employer</div>
                    <div class="role-desc">Post jobs and find the best talent for your company</div>
                </label>

            </div>

            <button type="submit" class="btn-submit" id="submitBtn" disabled>
                Continue with Google
            </button>
        </form>
    </div>

    <script>
        const radios = document.querySelectorAll('input[type="radio"]');
        const submitBtn = document.getElementById('submitBtn');

        radios.forEach(radio => {
            radio.addEventListener('change', function () {
                // Remove selected from all
                document.querySelectorAll('.role-card').forEach(c => c.classList.remove('selected'));
                // Add selected to clicked
                document.getElementById('card-' + this.value).classList.add('selected');
                // Enable button
                submitBtn.disabled = false;
            });
        });

        document.getElementById('roleForm').addEventListener('submit', function () {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Setting up your account...';
        });
    </script>
</body>
</html>