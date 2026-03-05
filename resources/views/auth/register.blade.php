{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-center">Register</h1>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}"
                class="w-full border p-2 rounded" required>
            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                class="w-full border p-2 rounded" required>
            @error('email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <input type="password" name="password" placeholder="Password"
                class="w-full border p-2 rounded" required>
            @error('password')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                class="w-full border p-2 rounded" required>
        </div>

        <div>
            <select name="role_id" class="w-full border p-2 rounded" required>
                <option value="">Select Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Register
        </button>
    </form>

    <p class="text-center text-sm mt-4">
        Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
    </p>
</div>
@endsection