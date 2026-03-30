{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="gradient-bg"></div>

    <div class="auth-container">
        <!-- Left Side: Branding -->
        <div class="auth-branding">
            <div class="branding-bg branding-circle-1"></div>
            <div class="branding-bg branding-circle-2"></div>
            
            <div class="branding-content">
                <div class="branding-logo">🚀</div>
                <h2 class="branding-title">JobEase</h2>
                <p class="branding-subtitle">
                    Find opportunities that match your skills and passion
                </p>

                <div class="branding-features">
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>Smart job matching</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>Quick applications</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✓</span>
                        <span>Career growth tools</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="auth-form-wrapper">
            <div class="auth-card">
                <div class="auth-header">
                    <span class="auth-logo">👤</span>
                    <h1>Welcome Back</h1>
                    <p>Sign in to your account</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrapper">
                            <span class="input-icon-left">📧</span>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                placeholder="you@example.com" 
                                value="{{ old('email') }}"
                                required 
                                autocomplete="email"
                                class="@error('email') error @enderror"
                            >
                        </div>
                        @error('email')
                            <div class="error-message">
                                <span>✕</span>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <span class="input-icon-left">🔒</span>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••" 
                                required
                                autocomplete="current-password"
                                class="@error('password') error @enderror"
                            >
                            <span class="input-icon-right" onclick="togglePassword()" title="Show/hide password">👁️</span>
                        </div>
                        @error('password')
                            <div class="error-message">
                                <span>✕</span>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="remember-forgot">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-submit" id="submit-btn">
                        Sign In
                    </button>
                </form>

                <div class="divider">
                    <span>New here?</span>
                </div>

                <div class="footer-link">
                    <a href="{{ route('register') }}">Create an account</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.input-icon-right');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️';
            }
        }

        // Loading state
        document.querySelector('.login-form')?.addEventListener('submit', function() {
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Signing in...';
            submitBtn.style.opacity = '0.8';
        });

        // Prevent multiple submissions
        const loginForm = document.querySelector('.login-form');
        let isSubmitting = false;

        loginForm?.addEventListener('submit', function(e) {
            if (isSubmitting) {
                e.preventDefault();
                return false;
            }
            isSubmitting = true;
        });
    </script>
@endsection