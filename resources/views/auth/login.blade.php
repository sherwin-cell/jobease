{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-center">Login</h1>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

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

        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Login
        </button>
    </form>

    <p class="text-center text-sm mt-4">
        Don’t have an account? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
    </p>
</div>
@endsection