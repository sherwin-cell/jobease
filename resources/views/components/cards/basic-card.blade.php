<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300']) }}>
    @if(isset($header))
        <div class="px-6 py-4 border-b border-gray-100 {{ $headerClass ?? '' }}">
            {{ $header }}
        </div>
    @endif
    
    <div class="p-6 {{ $bodyClass ?? '' }}">
        {{ $slot }}
    </div>
    
    @if(isset($footer))
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 {{ $footerClass ?? '' }}">
            {{ $footer }}
        </div>
    @endif
</div>