@extends('layouts.public')

@section('title', (!empty($search) ? 'Pencarian: ' . $search : (!empty($category) ? $category : 'Semua Produk')) . ' — ' . config('app.name'))
@section('description', 'Temukan kompressor dan chiller industri berkualitas dari PT. Airindo Mitra Utama — Distributor Tunggal Resmi Linghein, Atlas Copco Group.')
@section('keywords', 'kompressor, chiller, linghein, jianye, renner, atlas copco, airindo, ' . ($category ?? ''))

@section('content')

{{-- ─── PAGE HERO ──────────────────────────────────────────── --}}
<section class="pt-28 pb-10 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center space-x-2 text-sm text-blue-100 mb-6">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            @if(!empty($category))
                <a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Produk</a>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-medium">{{ $category }}</span>
            @elseif(!empty($search))
                <a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Produk</a>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-medium">Pencarian</span>
            @else
                <span class="text-white font-medium">Produk</span>
            @endif
        </nav>

        {{-- Headline --}}
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
            <div>
                @if(!empty($search))
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-2">
                        Hasil: <span class="text-blue-200">&ldquo;{{ $search }}&rdquo;</span>
                    </h1>
                    <p class="text-blue-100 text-lg">
                        Ditemukan <strong class="text-white">{{ $products->total() }}</strong> produk
                        @if(!empty($category)) dari kategori <strong class="text-white">{{ $category }}</strong>@endif
                    </p>
                @elseif(!empty($category))
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-2">{{ $category }}</h1>
                    <p class="text-blue-100 text-lg">
                        <strong class="text-white">{{ $products->total() }}</strong> produk tersedia
                    </p>
                @else
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-2">Semua Produk</h1>
                    <p class="text-blue-100 text-lg">
                        Kompressor & Chiller industri pilihan untuk kebutuhan bisnis Anda
                    </p>
                @endif
            </div>

            {{-- Search bar --}}
            <form action="{{ route('products.index') }}" method="GET" class="flex-shrink-0 w-full lg:w-96">
                @if(!empty($category))
                    <input type="hidden" name="category" value="{{ $category }}">
                @endif
                <div class="flex items-center gap-2 bg-white/10 backdrop-blur border border-white/20 rounded-2xl p-1.5 focus-within:bg-white/20 transition-all">
                    <input type="text" name="search"
                           value="{{ $search }}"
                           placeholder="Cari nama produk..."
                           class="flex-1 bg-transparent text-white placeholder-blue-200 px-3 py-2 text-sm focus:outline-none">
                    @if(!empty($search))
                        <a href="{{ route('products.index', array_filter(['category' => $category])) }}"
                           class="p-2 text-blue-200 hover:text-white transition-colors" title="Hapus pencarian">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    @endif
                    <button type="submit"
                            class="px-4 py-2 bg-white text-blue-600 font-semibold text-sm rounded-xl hover:bg-blue-50 transition-colors flex items-center gap-1.5 flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- ─── FILTER TABS ─────────────────────────────────────────── --}}
<div class="sticky top-16 z-30 bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-1 overflow-x-auto py-3 scrollbar-none">

            {{-- All --}}
            <a href="{{ route('products.index', array_filter(['search' => $search])) }}"
               class="flex-shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold transition-all
                      {{ empty($category) ? 'bg-blue-600 text-white shadow-md shadow-blue-500/30' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-800' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                Semua
            </a>

            @foreach($categories as $cat)
                @php
                    $catIcon = match($cat) {
                        'Air Cooled Chiller' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                        'Linghein'           => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>',
                        'Jianye'             => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>',
                        'Renner'             => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
                        default              => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>',
                    };
                @endphp
                <a href="{{ route('products.index', array_filter(['category' => $cat, 'search' => $search])) }}"
                   class="flex-shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold transition-all
                          {{ $category === $cat ? 'bg-blue-600 text-white shadow-md shadow-blue-500/30' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-800' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $catIcon !!}
                    </svg>
                    {{ $cat }}
                </a>
            @endforeach

        </div>
    </div>
</div>

{{-- ─── PRODUCTS GRID ───────────────────────────────────────── --}}
<section class="py-12 bg-gray-50 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($products->isEmpty())

            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-50 rounded-3xl mb-6">
                    <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                </div>
                @if(!empty($search))
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Produk tidak ditemukan</h3>
                    <p class="text-gray-500 mb-6 max-w-sm">
                        Tidak ada produk yang cocok dengan <strong>"{{ $search }}"</strong>.
                        Coba kata kunci lain atau hapus filter.
                    </p>
                @else
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Produk</h3>
                    <p class="text-gray-500 mb-6">Produk di kategori ini akan segera tersedia.</p>
                @endif
                <div class="flex items-center gap-3">
                    @if(!empty($search))
                        <a href="{{ route('products.index', array_filter(['category' => $category])) }}"
                           class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-xl font-semibold text-sm hover:bg-gray-200 transition-colors">
                            Hapus Pencarian
                        </a>
                    @endif
                    @if(!empty($category))
                        <a href="{{ route('products.index', array_filter(['search' => $search])) }}"
                           class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-xl font-semibold text-sm hover:bg-gray-200 transition-colors">
                            Lihat Semua Kategori
                        </a>
                    @endif
                    <a href="{{ route('products.index') }}"
                       class="px-5 py-2.5 bg-blue-600 text-white rounded-xl font-semibold text-sm hover:bg-blue-700 transition-colors">
                        Lihat Semua Produk
                    </a>
                </div>
            </div>

        @else

            {{-- Results meta --}}
            <div class="flex items-center justify-between mb-6">
                <p class="text-sm text-gray-500">
                    Menampilkan
                    <strong class="text-gray-700">{{ $products->firstItem() }}–{{ $products->lastItem() }}</strong>
                    dari
                    <strong class="text-gray-700">{{ $products->total() }}</strong> produk
                </p>
                @if(!empty($search) || !empty($category))
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-red-500 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Hapus semua filter
                    </a>
                @endif
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col">

                        {{-- Image --}}
                        <a href="{{ route('products.show', $product->slug) }}" class="block relative aspect-[4/3] overflow-hidden bg-gray-50">
                            <img src="{{ $product->image_url }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                 loading="lazy"
                                 onerror="this.src='https://placehold.co/600x400/e2e8f0/64748b?text=No+Image'">
                            @if($product->category)
                                <span class="absolute top-3 left-3 px-2.5 py-1 bg-blue-600/90 backdrop-blur-sm text-white text-xs font-semibold rounded-lg">
                                    {{ $product->category }}
                                </span>
                            @endif
                        </a>

                        {{-- Body --}}
                        <div class="p-4 flex flex-col flex-1 gap-3">
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 text-sm leading-snug mb-1.5 line-clamp-2">
                                    <a href="{{ route('products.show', $product->slug) }}" class="hover:text-blue-600 transition-colors">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                @if($product->short_description)
                                    <p class="text-gray-500 text-xs leading-relaxed line-clamp-3">
                                        {{ $product->short_description }}
                                    </p>
                                @endif
                            </div>

                            {{-- CTA --}}
                            <a href="{{ route('products.show', $product->slug) }}"
                               class="mt-auto flex items-center justify-center gap-1.5 w-full py-2.5 bg-blue-50 text-blue-600 font-semibold text-sm rounded-xl hover:bg-blue-600 hover:text-white transition-all duration-200">
                                <span>Lihat Detail</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
                <div class="mt-10 flex justify-center">
                    {{ $products->links('pagination::tailwind') }}
                </div>
            @endif

        @endif
    </div>
</section>

@endsection
