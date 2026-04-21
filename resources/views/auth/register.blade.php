{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.auth')

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

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <div class="input-wrapper">
                            <input type="text" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}"
                                required autocomplete="name" class="{{ $errors->has('name') ? 'error' : '' }}">
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
                            <input type="email" id="email" name="email" placeholder="you@example.com"
                                value="{{ old('email') }}" required autocomplete="email"
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
                        <select name="role_id" id="role_id" required>
                            <option value="">Select your role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    @if($role->name === 'job_seeker')
                                        Job Seeker
                                    @elseif($role->name === 'employer')
                                        Employer
                                    @elseif($role->name === 'admin')
                                        Admin
                                    @else
                                        {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                    @endif
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
                            <input type="text" id="company_name" name="company_name" placeholder="Your Company"
                                value="{{ old('company_name') }}" class="{{ $errors->has('company_name') ? 'error' : '' }}">
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
                            <input type="password" id="password" name="password" placeholder="••••••••" required
                                autocomplete="new-password" class="{{ $errors->has('password') ? 'error' : '' }}">
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
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="••••••••" required autocomplete="new-password"
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
                        <input type="checkbox" id="terms" name="terms_accepted" required>
                        <label for="terms">I agree to the Terms & Conditions</label>
                    </div>

                    <button type="submit" class="btn-submit" id="submitBtn">Create Account</button>
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
        // Toggle company name field based on selected role with animations
        const roleSelect = document.getElementById('role_id');
        const companyField = document.getElementById('company_name_field');
        const companyInput = document.getElementById('company_name');
        const registerForm = document.getElementById('registerForm');
        const submitBtn = document.getElementById('submitBtn');

        function toggleCompanyField() {
            const selectedText = roleSelect.options[roleSelect.selectedIndex].text.toLowerCase();

            if (selectedText.includes('employer')) {
                if (companyField.classList.contains('hidden')) {
                    companyField.classList.remove('hidden');
                    companyField.classList.add('transition-show');
                    // Remove transition-show after animation completes
                    setTimeout(() => {
                        companyField.classList.remove('transition-show');
                    }, 400);
                }
                companyInput.required = true;
            } else {
                if (!companyField.classList.contains('hidden')) {
                    companyField.classList.add('hidden');
                    companyInput.required = false;
                    companyInput.value = '';
                }
            }
        }

        roleSelect.addEventListener('change', toggleCompanyField);
        toggleCompanyField(); // Run on page load for old() repopulation

        // Add input animations
        const inputs = document.querySelectorAll('input[type="email"], input[type="password"], input[type="text"], select');

        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.closest('.form-group')?.style.setProperty('--input-focus', 'true');
            });

            input.addEventListener('blur', function () {
                this.parentElement.closest('.form-group')?.style.removeProperty('--input-focus');
            });

            // Ripple effect on input
            input.addEventListener('focus', function (e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.width = '0';
                ripple.style.height = '0';
                ripple.style.borderRadius = '50%';
                ripple.style.backgroundColor = 'rgba(37, 99, 235, 0.3)';
                ripple.style.pointerEvents = 'none';
                ripple.style.animation = 'rippleEffect 0.6s ease-out';
            });
        });

        // Submit button loading state
        registerForm.addEventListener('submit', function (e) {
            // Note: Only add visual feedback, don't prevent submission
            submitBtn.style.opacity = '0.8';
            submitBtn.style.pointerEvents = 'none';
            submitBtn.innerHTML = '<span style="opacity: 0.7;">Creating account...</span>';

            // Reset after 3 seconds if there are no errors
            setTimeout(() => {
                submitBtn.style.opacity = '1';
                submitBtn.style.pointerEvents = 'auto';
                submitBtn.innerHTML = 'Create Account';
            }, 3000);
        });

        // Add staggered animation to form errors on page load
        document.addEventListener('DOMContentLoaded', function () {
            const errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach((msg, index) => {
                msg.style.animationDelay = (index * 0.1) + 's';
            });

            // Animate form groups on load
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                if (!group.classList.contains('hidden')) {
                    group.style.opacity = '0';
                    group.style.transform = 'translateY(15px)';
                    setTimeout(() => {
                        group.style.transition = 'all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1)';
                        group.style.opacity = '1';
                        group.style.transform = 'translateY(0)';
                    }, index * 50);
                }
            });
        });

        // Checkbox animation enhancement
        const checkbox = document.getElementById('terms');
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                this.style.animation = 'checkboxCheck 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)';
            }
        });
    </script>

    <style>
        @keyframes rippleEffect {
            to {
                width: 200px;
                height: 200px;
                opacity: 0;
            }
        }
    </style>
@endsection