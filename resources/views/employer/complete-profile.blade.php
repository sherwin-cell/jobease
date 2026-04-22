@extends('layouts.standalone')

@section('title', 'Complete Your Company Profile')

@section('content')
    <div class="w-full max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Complete Your Company Profile</h1>
            <p class="text-gray-600">You must complete your company profile to access the employer dashboard and post jobs.
            </p>
        </div>

        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>All fields marked with * are required.</strong>
                    </p>
                </div>
            </div>
        </div>


        @if ($errors->any())
            <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4">
                <div class="ml-3">
                    <p class="text-sm text-red-700">
                        <strong>Please fix the following errors:</strong>
                    </p>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session('info'))
            <div class="mb-4 bg-blue-50 border-l-4 border-blue-400 p-4">
                <p class="text-sm text-blue-700">{{ session('info') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('employer.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">
                    Company Name *
                </label>
                <input type="text" id="company_name" name="company_name"
                    value="{{ old('company_name', $company->company_name ?? '') }}" placeholder="Enter your company name"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                    Location *
                </label>
                <input type="text" id="location" name="location" value="{{ old('location', $company->location ?? '') }}"
                    placeholder="Enter company location (e.g., New York, NY)" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                    Phone Number *
                </label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone', $company->phone ?? '') }}"
                    placeholder="Enter company phone number" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="website" class="block text-sm font-medium text-gray-700 mb-1">
                    Website
                </label>
                <input type="url" id="website" name="website" value="{{ old('website', $company->website ?? '') }}"
                    placeholder="https://www.example.com"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="business_permit" class="block text-sm font-medium text-gray-700 mb-1">
                    Business Permit / Mayor’s Permit *
                </label>

                <input type="file" id="business_permit" name="business_permit" accept=".jpg,.jpeg,.png,.pdf" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                <p class="text-xs text-gray-500 mt-1">
                    Upload image (JPG/PNG) or PDF of your valid business permit.
                </p>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Company Description *
                </label>
                <textarea id="description" name="description"
                    placeholder="Describe your company, its mission, and what makes it unique..." rows="5" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $company->description ?? '') }}</textarea>
            </div>

            <div class="text-center pt-4">
                <button type="submit"
                    class="inline-flex items-center px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Complete Profile & Access Dashboard
                </button>
            </div>
        </form>

        <div class="mt-6 text-center text-sm text-gray-500">
            <p>All information provided will be kept confidential and used only for verification purposes.</p>
        </div>
    </div>

    <script>
        // Prevent navigation away from this page until profile is complete
        window.addEventListener('beforeunload', function (e) {
            // Only show warning if form has been modified
            const form = document.querySelector('form');
            if (form && form.checkValidity() === false) {
                e.preventDefault();
                e.returnValue = 'You must complete your profile to access the dashboard. Are you sure you want to leave?';
            }
        });

        // Disable browser back button
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
@endsection