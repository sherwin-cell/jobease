{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="auth-container">
    <!-- Form on Left -->
    <div class="auth-form-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Get Started</h1>
                <p>Create your account</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <div class="input-wrapper">
                        <input 
                            type="text" 
                            id="name"
                            name="name" 
                            placeholder="John Doe"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            class="{{ $errors->has('name') ? 'error' : '' }}">
                    </div>
                    @error('name')
                        <div class="error-message">
                            <span>✕</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <input 
                            type="email" 
                            id="email"
                            name="email" 
                            placeholder="you@example.com"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            class="{{ $errors->has('email') ? 'error' : '' }}">
                    </div>
                    @error('email')
                        <div class="error-message">
                            <span>✕</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role_id">Account Type</label>
                    <select 
                        name="role_id" 
                        id="role_id" 
                        required
                        class="{{ $errors->has('role_id') ? 'error' : '' }}">
                        <option value="">Select your role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <div class="error-message">
                            <span>✕</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Company name — only shown when Employer is selected -->
                <div id="company_name_field" class="form-group hidden">
                    <label for="company_name">Company Name</label>
                    <div class="input-wrapper">
                        <input 
                            type="text" 
                            id="company_name"
                            name="company_name" 
                            placeholder="Your Company"
                            value="{{ old('company_name') }}"
                            class="{{ $errors->has('company_name') ? 'error' : '' }}">
                    </div>
                    @error('company_name')
                        <div class="error-message">
                            <span>✕</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password"
                            name="password" 
                            placeholder="••••••••"
                            required
                            autocomplete="new-password"
                            class="{{ $errors->has('password') ? 'error' : '' }}">
                    </div>
                    <div class="password-requirements">
                        <strong>Password must contain:</strong>
                        <ul>
                            <li>At least 8 characters</li>
                            <li>Mix of uppercase & lowercase</li>
                            <li>At least one number</li>
                        </ul>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <span>✕</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password_confirmation"
                            name="password_confirmation" 
                            placeholder="••••••••"
                            required
                            autocomplete="new-password"
                            class="{{ $errors->has('password_confirmation') ? 'error' : '' }}">
                    </div>
                    @error('password_confirmation')
                        <div class="error-message">
                            <span>✕</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="checkbox-wrapper">
                    <input 
                        type="checkbox" 
                        id="terms" 
                        name="terms_accepted"
                        required>
                    <label for="terms">I agree to the Terms & Conditions</label>
                </div>

                <button type="submit" class="btn-submit">Create Account</button>
            </form>

            <div class="divider">
                <span>Already registered?</span>
            </div>

            <div class="footer-link">
                <a href="{{ route('login') }}">Sign in to your account</a>
            </div>
        </div>
    </div>

    <!-- Photo on Right -->
    <div class="auth-branding">
        <div class="branding-content">
            <h2 class="branding-title">Welcome</h2>
            <p class="branding-subtitle">Join thousands of users already using our platform</p>
            
            <div class="branding-features">
                <div class="feature-item">
                    <span class="feature-icon">✓</span>
                    <span>Secure and reliable</span>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">✓</span>
                    <span>Easy account setup</span>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">✓</span>
                    <span>24/7 support</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle company name field based on selected role
    const roleSelect = document.getElementById('role_id');
    const companyField = document.getElementById('company_name_field');
    const companyInput = document.getElementById('company_name');

    function toggleCompanyField() {
        const selectedText = roleSelect.options[roleSelect.selectedIndex].text.toLowerCase();
        
        if (selectedText.includes('employer')) {
            companyField.classList.remove('hidden');
            companyField.classList.add('transition-show');
            companyInput.required = true;
        } else {
            companyField.classList.add('hidden');
            companyField.classList.remove('transition-show');
            companyInput.required = false;
            companyInput.value = '';
        }
    }

    roleSelect.addEventListener('change', toggleCompanyField);
    toggleCompanyField(); // Run on page load for old() repopulation
</script>
@endsection