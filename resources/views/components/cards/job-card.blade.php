<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group']) }}>
    <div class="p-6">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-3">
                    @if(isset($companyLogo))
                        <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center overflow-hidden">
                            <img src="{{ $companyLogo }}" alt="{{ $companyName }}" class="w-10 h-10 object-contain">
                        </div>
                    @else
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-xl">
                            {{ substr($companyName ?? 'J', 0, 1) }}
                        </div>
                    @endif
                    
                    <div>
                        <h3 class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
                            {{ $title }}
                        </h3>
                        <p class="text-sm text-gray-500">{{ $companyName ?? '' }}</p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-2 mb-4">
                    @if(isset($location))
                        <span class="inline-flex items-center text-xs text-gray-500">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $location }}
                        </span>
                    @endif
                    
                    @if(isset($salary))
                        <span class="inline-flex items-center text-xs text-gray-500">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $salary }}
                        </span>
                    @endif
                    
                    @if(isset($type))
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $typeColor ?? 'bg-green-100 text-green-700' }}">
                            {{ $type }}
                        </span>
                    @endif
                </div>
                
                <p class="text-sm text-gray-600 line-clamp-2 mb-4">
                    {{ $description ?? '' }}
                </p>
                
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="flex items-center gap-4">
                        @if(isset($postedAt))
                            <span class="text-xs text-gray-400">
                                Posted {{ $postedAt }}
                            </span>
                        @endif
                        
                        @if(isset($applicants))
                            <span class="text-xs text-gray-400">
                                {{ $applicants }} applicants
                            </span>
                        @endif
                    </div>
                    
                    @if(isset($buttonLink))
                        <a href="{{ $buttonLink }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">
                            {{ $buttonText ?? 'View Details' }}
                            <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>