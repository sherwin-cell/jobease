@extends('layouts.standalone')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4">
        <h2 class="font-bold text-lg mb-2">Verify Your Email Address</h2>
        <p>Before proceeding, please check your email for a verification link.</p>
        <p>If you did not receive the email, click below to request another.</p>
        @if (session('message'))
            <div class="text-green-600 mt-2">{{ session('message') }}</div>
        @endif
        <form method="POST" action="{{ route('verification.send') }}" class="mt-4">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Resend Verification Email</button>
        </form>
    </div>
</div>
@endsection
