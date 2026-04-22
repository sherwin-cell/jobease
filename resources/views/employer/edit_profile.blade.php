@extends('layouts.app')

@section('content')
@php
    $isEdit = request()->get('edit') == 1;
@endphp

<div class="max-w-3xl mx-auto mt-10 space-y-6">

    <!-- TITLE -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Company Profile</h1>
        <p class="text-gray-500 text-sm">View and update your company information</p>
    </div>

    <!-- MESSAGES -->
    @if ($errors->any())
        <div class="bg-red-50 text-red-700 p-4 rounded border border-red-200">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-50 text-green-700 p-4 rounded border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- ================= VIEW MODE ================= -->
    @if (!$isEdit)
    <div class="bg-white p-6 rounded-lg shadow border space-y-3">

        <h2 class="text-lg font-semibold text-gray-800">Company Information</h2>

        <p><strong>Name:</strong> {{ $company->company_name ?? 'Not set' }}</p>
        <p><strong>Location:</strong> {{ $company->location ?? 'Not set' }}</p>
        <p><strong>Phone:</strong> {{ $company->phone ?? 'Not set' }}</p>

        <p><strong>Website:</strong>
            @if ($company->website)
                <a href="{{ $company->website }}" class="text-blue-600 underline" target="_blank">
                    {{ $company->website }}
                </a>
            @else
                Not set
            @endif
        </p>

        <p><strong>Description:</strong></p>
        <p class="text-gray-600 whitespace-pre-line">
            {{ $company->description ?? 'Not set' }}
        </p>

        <a href="?edit=1"
           class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded">
            ✏️ Edit Profile
        </a>
    </div>
    @endif

    <!-- ================= EDIT MODE ================= -->
    @if ($isEdit)
    <div class="bg-white p-6 rounded-lg shadow border">

        <h2 class="text-lg font-semibold mb-4">Edit Company Profile</h2>

        <form method="POST" action="{{ route('employer.profile.update') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <input class="w-full border p-2 rounded"
                name="company_name"
                value="{{ old('company_name', $company->company_name) }}"
                placeholder="Company Name">

            <input class="w-full border p-2 rounded"
                name="location"
                value="{{ old('location', $company->location) }}"
                placeholder="Location">

            <input class="w-full border p-2 rounded"
                name="phone"
                value="{{ old('phone', $company->phone) }}"
                placeholder="Phone">

            <input class="w-full border p-2 rounded"
                name="website"
                value="{{ old('website', $company->website) }}"
                placeholder="Website">

            <textarea class="w-full border p-2 rounded"
                name="description"
                rows="5"
                placeholder="Description">{{ old('description', $company->description) }}</textarea>

            <div class="flex gap-3">
                <button class="px-4 py-2 bg-green-600 text-white rounded">
                    Save Changes
                </button>

                <a href="{{ route('employer.profile.edit') }}"
                   class="px-4 py-2 bg-gray-400 text-white rounded">
                    Cancel
                </a>
            </div>
        </form>

    </div>
    @endif

</div>
@endsection