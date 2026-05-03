@extends('layouts.standalone')

@section('title', 'Verify Email')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <div class="text-center mb-6">
        <div class="text-5xl mb-4">📧</div>
        <h2 class="text-2xl font-bold text-gray-900">Verify Your Email</h2>
        <p class="text-gray-600 mt-2">Please verify your email address to continue</p>
    </div>

    @if(session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if(session('info'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
            {{ session('info') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
        <p class="text-sm text-yellow-800">
            A verification link has been sent to your email address. 
            Please check your inbox and click the verification link to activate your account.
        </p>
        <p class="text-xs text-yellow-700 mt-2">
            Didn't receive the email? Check your spam folder or click the button below to resend.
        </p>
    </div>

    <!-- ✅ MAKE SURE CSRF IS INCLUDED -->
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Resend Verification Email
        </button>
    </form>

    <div class="text-center mt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-gray-500 hover:text-gray-700 text-sm">
                Logout
            </button>
        </form>
    </div>
</div>
@endsection