<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-md overflow-hidden']) }}>
    <div class="relative">
        <div class="h-32 bg-gradient-to-r {{ $coverGradient ?? 'from-blue-500 to-purple-600' }}"></div>
        <div class="absolute -bottom-12 left-6">
            <div class="w-24 h-24 rounded-full border-4 border-white bg-gray-100 overflow-hidden">
                @if(isset($avatar))
                    <img src="{{ $avatar }}" alt="{{ $name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-2xl font-bold">
                        {{ substr($name ?? 'U', 0, 1) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="px-6 pt-14 pb-6">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-xl font-bold text-gray-800">{{ $name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $role ?? 'Member' }}</p>
                
                @if(isset($email))
                    <div class="flex items-center gap-2 mt-3 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        {{ $email }}
                    </div>
                @endif
                
                @if(isset($location))
                    <div class="flex items-center gap-2 mt-2 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $location }}
                    </div>
                @endif
            </div>
            
            @if(isset($status))
                <span class="px-3 py-1 text-xs font-medium rounded-full {{ $status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ ucfirst($status) }}
                </span>
            @endif
        </div>
        
        @if(isset($stats))
            <div class="grid grid-cols-3 gap-4 mt-6 pt-6 border-t border-gray-100">
                @foreach($stats as $stat)
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-800">{{ $stat['value'] }}</div>
                        <div class="text-xs text-gray-500">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        @endif
        
        @if(isset($actions))
            <div class="flex gap-3 mt-6">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>