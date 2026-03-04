<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employer Registration - JobEase</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Employer Registration</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('employer.register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block mb-1 font-medium">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       placeholder="Full Name"
                       class="w-full border border-gray-300 rounded-md p-2"
                       required>
            </div>

            <div class="mb-4">
                <label for="email" class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       placeholder="Email"
                       class="w-full border border-gray-300 rounded-md p-2"
                       required>
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-1 font-medium">Password</label>
                <input type="password" name="password" id="password"
                       placeholder="Password"
                       class="w-full border border-gray-300 rounded-md p-2"
                       required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block mb-1 font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       placeholder="Confirm Password"
                       class="w-full border border-gray-300 rounded-md p-2"
                       required>
            </div>

            <div class="mb-6">
                <label for="company_name" class="block mb-1 font-medium">Company Name</label>
                <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}"
                       placeholder="Company Name"
                       class="w-full border border-gray-300 rounded-md p-2"
                       required>
            </div>

            <button type="submit" class="w-full bg-black text-white p-2 rounded-md font-semibold hover:bg-gray-800">
                Register
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Log in</a>
        </p>
    </div>

</body>
</html>