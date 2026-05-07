<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-md p-6']) }}>
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">{{ $title }}</h3>
        @if(isset($icon))
            <div class="text-gray-400">
                {!! $icon !!}
            </div>
        @endif
    </div>
    
    <div class="flex items-baseline justify-between">
        <div>
            <p class="text-2xl font-bold text-gray-800">{{ $value }}</p>
            @if(isset($subtitle))
                <p class="text-xs text-gray-500 mt-1">{{ $subtitle }}</p>
            @endif
        </div>
        
        @if(isset($change))
            <div class="flex items-center {{ $change > 0 ? 'text-green-600' : 'text-red-600' }}">
                @if($change > 0)
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                @else
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                    </svg>
                @endif
                <span class="text-sm font-semibold ml-1">{{ abs($change) }}%</span>
            </div>
        @endif
    </div>
    
    @if(isset($progress))
        <div class="mt-4">
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
            </div>
        </div>
    @endif
    
    @if(isset($chart))
        <div class="mt-4 h-16">
            {{ $chart }}
        </div>
    @endif
</div>