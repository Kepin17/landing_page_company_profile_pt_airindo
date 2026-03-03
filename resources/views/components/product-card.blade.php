@props(['product'])

<div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">

    {{-- Product Image --}}
    <a href="{{ route('products.show', $product->slug) }}" class="block relative overflow-hidden bg-gray-50 aspect-[4/3]">
        <img src="{{ $product->image_url }}"
             alt="{{ $product->name }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
             loading="lazy"
             onerror="this.src='https://placehold.co/600x400/e2e8f0/64748b?text=No+Image'">

        {{-- Active badge --}}
        @if($product->is_active)
            <div class="absolute top-3 right-3">
                <span class="inline-flex items-center space-x-1 bg-green-500 text-white text-xs font-semibold px-2.5 py-1 rounded-full shadow-md">
                    <span class="w-1.5 h-1.5 bg-green-200 rounded-full animate-pulse"></span>
                    <span>Tersedia</span>
                </span>
            </div>
        @endif
    </a>

    {{-- Card Body --}}
    <div class="p-5 flex flex-col flex-1">
        <a href="{{ route('products.show', $product->slug) }}">
            <h3 class="font-bold text-gray-900 text-base leading-snug mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                {{ $product->name }}
            </h3>
        </a>

        {{-- Short description only --}}
        <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 flex-1 mb-4">
            {{ $product->short_description ?: Str::limit($product->description, 100) }}
        </p>

        {{-- Read More Button --}}
        <a href="{{ route('products.show', $product->slug) }}"
           class="flex items-center justify-center space-x-2 w-full py-2.5 border-2 border-blue-600 text-blue-600 rounded-xl font-semibold text-sm hover:bg-blue-600 hover:text-white transition-all duration-200 group/btn">
            <span>Read More</span>
            <svg class="w-4 h-4 -translate-x-0.5 group-hover/btn:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</div>
