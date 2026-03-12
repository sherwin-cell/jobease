{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Welcome Back</h1>
                <p>Sign in to your account</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}"
                        required autocomplete="email">
                    @error('email')
                        <div class="error-message">
                            <span>✕</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required
                        autocomplete="current-password">
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

                <button type="submit" class="btn-submit">Sign In</button>
            </form>

            <div class="divider">
                <span>New here?</span>
            </div>

            <div class="footer-link">
                <a href="{{ route('register') }}">Create an account</a>
            </div>
        </div>
    </div>
@endsection