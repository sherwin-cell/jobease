<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1']) }}>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">{{ $title }}</p>
            <p class="text-2xl font-bold text-gray-800 mt-2">{{ $value }}</p>
            @if(isset($trend))
                <div class="flex items-center mt-2">
                    @if($trend > 0)
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                        </svg>
                        <span class="text-sm text-green-600 ml-1">+{{ $trend }}%</span>
                    @elseif($trend < 0)
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        <span class="text-sm text-red-600 ml-1">{{ $trend }}%</span>
                    @endif
                    <span class="text-xs text-gray-500 ml-2">vs last month</span>
                </div>
            @endif
        </div>
        <div class="w-12 h-12 rounded-full bg-gradient-to-br {{ $iconBg ?? 'from-blue-500 to-blue-600' }} flex items-center justify-center">
            @if(isset($icon))
                <div class="text-white w-6 h-6">
                    {!! $icon !!}
                </div>
            @endif
        </div>
    </div>
</div>