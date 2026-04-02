<!-- resources/views/layouts/topnav.blade.php -->
<header class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">
        
        <!-- Logo -->
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-xl text-lg">
                🏢
            </div>
            <span class="text-xl font-bold text-gray-800">Jobease</span>
        </div>

        <!-- Navigation / User Info -->
        <div class="flex items-center gap-6">
            <nav class="flex items-center gap-4">
                <a href="{{ route('employer.dashboard') }}"
                   class="text-gray-700 hover:text-blue-600 font-semibold">
                    Employer Dashboard
                </a>
                <!-- Add more links if needed -->
            </nav>

            <div class="flex items-center gap-3">
                <span class="text-gray-700 font-medium">
                    {{ auth()->user()->name }}
                </span>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>