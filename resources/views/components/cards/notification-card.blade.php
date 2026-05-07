<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 ' . ($unread ?? false ? 'border-l-4 border-l-blue-500' : '')]) }}>
    <div class="p-4">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full {{ $iconBg ?? 'bg-blue-100' }} flex items-center justify-center">
                    @if(isset($icon))
                        <div class="w-5 h-5 {{ $iconColor ?? 'text-blue-600' }}">
                            {!! $icon !!}
                        </div>
                    @else
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    @endif
                </div>
            </div>
            
            <div class="flex-1">
                <div class="flex items-start justify-between">
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ $title }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ $message }}</p>
                    </div>
                    @if(isset($time))
                        <span class="text-xs text-gray-400 whitespace-nowrap ml-3">{{ $time }}</span>
                    @endif
                </div>
                
                @if(isset($actions))
                    <div class="flex gap-3 mt-3">
                        {{ $actions }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>