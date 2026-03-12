{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Get Started</h1>
            <p>Create your account</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>
                <input 
                    type="text" 
                    id="name"
                    name="name" 
                    placeholder="John Doe"
                    value="{{ old('name') }}"
                    required
                    autocomplete="name">
                @error('name')
                    <div class="error-message">
                        <span>✕</span>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email"
                    name="email" 
                    placeholder="you@example.com"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email">
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
                <input 
                    type="text" 
                    id="company_name"
                    name="company_name" 
                    placeholder="Your Company"
                    value="{{ old('company_name') }}">
                @error('company_name')
                    <div class="error-message">
                        <span>✕</span>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    placeholder="••••••••"
                    required
                    autocomplete="new-password">
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
                <input 
                    type="password" 
                    id="password_confirmation"
                    name="password_confirmation" 
                    placeholder="••••••••"
                    required
                    autocomplete="new-password">
                @error('password_confirmation')
                    <div class="error-message">
                        <span>✕</span>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
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