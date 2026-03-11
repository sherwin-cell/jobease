@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Edit Company Profile</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('employer.profile.update') }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Company Name</label>
                <input type="text" name="company_name" value="{{ old('company_name', $company->company_name ?? '') }}"
                    placeholder="Company Name" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Website</label>
                <input type="url" name="website" value="{{ old('website', $company->website ?? '') }}" placeholder="Website"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Company Description</label>
                <textarea name="description" placeholder="Company Description"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    rows="5">{{ old('description', $company->description ?? '') }}</textarea>
            </div>

            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update Profile
            </button>
        </form>
    </div>
@endsection