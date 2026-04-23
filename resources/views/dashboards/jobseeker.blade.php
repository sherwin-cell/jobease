@extends('layouts.app')

@section('title', 'Job Seeker Dashboard')

@section('content')

    <div class="flex items-start justify-between gap-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500">
                Welcome back, {{ auth()->user()->name }}. Here’s what’s happening today.
            </p>
        </div>
        <div class="text-sm text-gray-500">
            {{ now()->format('l, F j, Y') }}
        </div>
    </div>

    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-6">
        <div class="flex items-start justify-between gap-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">
                    Keep your profile updated
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    A complete profile helps employers find you faster.
                </p>
            </div>
            <a href="{{ route('jobseeker.profile.show') }}"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
                View Profile
            </a>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-3">
        <a href="{{ route('jobseeker.jobs.index') }}"
            class="group rounded-2xl border border-gray-200 bg-white p-6 hover:border-blue-200 hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold text-gray-900">Browse Jobs</div>
                <div class="text-lg">💼</div>
            </div>
            <p class="mt-2 text-sm text-gray-600">
                Discover roles that match your goals.
            </p>
            <div class="mt-4 text-sm font-semibold text-blue-700 group-hover:text-blue-800">
                View jobs →
            </div>
        </a>

        <a href="{{ route('jobseeker.applications.index') }}"
            class="group rounded-2xl border border-gray-200 bg-white p-6 hover:border-blue-200 hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold text-gray-900">Applications</div>
                <div class="text-lg">📋</div>
            </div>
            <p class="mt-2 text-sm text-gray-600">
                Track your submitted applications and statuses.
            </p>
            <div class="mt-4 text-sm font-semibold text-blue-700 group-hover:text-blue-800">
                View applications →
            </div>
        </a>

        <a href="{{ route('jobseeker.profile.create') }}"
            class="group rounded-2xl border border-gray-200 bg-white p-6 hover:border-blue-200 hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold text-gray-900">EditProfile</div>
                <div class="text-lg">✏️</div>
            </div>
            <p class="mt-2 text-sm text-gray-600">
                Update your headline and experience.
            </p>
            <div class="mt-4 text-sm font-semibold text-blue-700 group-hover:text-blue-800">
                Edit now →
            </div>
        </a>
    </div>

@endsection