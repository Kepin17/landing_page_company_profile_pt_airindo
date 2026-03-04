@extends('layouts.public')

@section('title', $product->name . ' — ' . config('app.name'))
@section('description', $product->short_description ?: Str::limit($product->description, 160))
@section('keywords', $product->name . ', ' . config('app.name') . ', produk, shopee, tokopedia')

@section('content')

{{-- ─── HERO / PRODUCT HEADER ─────────────────── --}}
<section class="pt-28 pb-0 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center space-x-2 text-sm text-gray-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('products.index') }}" class="hover:text-blue-600 transition-colors">Produk</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-700 font-medium truncate max-w-[200px]">{{ $product->name }}</span>
        </nav>

        {{-- Main Product Grid --}}
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start pb-16">

            {{-- Left: Image --}}
            <div class="reveal">
                <div class="relative rounded-3xl overflow-hidden bg-gray-100 shadow-xl aspect-[4/3]">
                    <img src="{{ $product->image_url ?? 'https://placehold.co/800x600/e2e8f0/64748b?text=No+Image' }}"
                         alt="{{ $product->name }}"
                         class="w-full h-full object-cover"
                         onerror="this.src='https://placehold.co/800x600/e2e8f0/64748b?text=No+Image'">

                    {{-- Status badge --}}
                    <div class="absolute top-4 left-4">
                        @if($product->is_active)
                            <span class="inline-flex items-center space-x-1.5 bg-green-500 text-white text-sm font-semibold px-3 py-1.5 rounded-full shadow-lg">
                                <span class="w-2 h-2 bg-green-200 rounded-full animate-pulse"></span>
                                <span>Tersedia</span>
                            </span>
                        @else
                            <span class="inline-flex items-center space-x-1.5 bg-gray-500 text-white text-sm font-semibold px-3 py-1.5 rounded-full shadow-lg">
                                <span>Stok Habis</span>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right: Info --}}
            <div class="reveal space-y-6">

                {{-- Product name --}}
                <div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight mb-3">
                        {{ $product->name }}
                    </h1>
                    @if($product->short_description)
                        <p class="text-lg text-gray-500 leading-relaxed">
                            {{ $product->short_description }}
                        </p>
                    @endif
                </div>

                {{-- Divider --}}
                <div class="w-16 h-1 bg-blue-600 rounded-full"></div>

                {{-- Quick specs preview (first 4 data rows, skip headers) --}}
                @if(!empty($product->specifications))
                    @php
                        $dataSpecs = array_values(array_filter($product->specifications, fn($s) => empty($s['is_header']) && !empty($s['label']) && !empty($s['value'])));
                    @endphp
                    @if(!empty($dataSpecs))
                    <div class="bg-gray-50 rounded-2xl border border-gray-100 p-5 space-y-3">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Spesifikasi Utama</p>
                        @foreach(array_slice($dataSpecs, 0, 4) as $spec)
                            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                                <span class="text-sm text-gray-500 font-medium">{{ $spec['label'] }}</span>
                                <span class="text-sm font-semibold text-gray-800 text-right max-w-[55%]">{{ $spec['value'] }}</span>
                            </div>
                        @endforeach
                        @if(count($dataSpecs) > 4)
                            <a href="#spesifikasi"
                               class="inline-flex items-center space-x-1 text-blue-600 text-xs font-semibold hover:underline mt-1">
                                <span>Lihat semua {{ count($dataSpecs) }} spesifikasi</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                    @endif
                @endif

                {{-- Buy Buttons --}}
                @if($product->shopee_link || $product->tokopedia_link)
                    <div>
                        <p class="text-sm font-semibold text-gray-600 mb-3">Beli Sekarang:</p>
                        <div class="flex flex-col sm:flex-row gap-3">
                            @if($product->shopee_link)
                                <a href="{{ $product->shopee_link }}"
                                   target="_blank" rel="noopener noreferrer"
                                   class="flex-1 flex items-center justify-center space-x-3 py-3.5 bg-orange-500 hover:bg-orange-600 text-white rounded-2xl font-bold transition-all duration-200 hover:shadow-xl hover:shadow-orange-400/40 active:scale-95">
                                    <div class="w-7 h-7 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-extrabold text-xs">S</span>
                                    </div>
                                    <div class="text-left">
                                        <div class="text-xs text-orange-200">Beli di</div>
                                        <div class="text-sm font-bold leading-tight">Shopee</div>
                                    </div>
                                </a>
                            @endif

                            @if($product->tokopedia_link)
                                <a href="{{ $product->tokopedia_link }}"
                                   target="_blank" rel="noopener noreferrer"
                                   class="flex-1 flex items-center justify-center space-x-3 py-3.5 bg-green-500 hover:bg-green-600 text-white rounded-2xl font-bold transition-all duration-200 hover:shadow-xl hover:shadow-green-400/40 active:scale-95">
                                    <div class="w-7 h-7 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-extrabold text-xs">T</span>
                                    </div>
                                    <div class="text-left">
                                        <div class="text-xs text-green-200">Beli di</div>
                                        <div class="text-sm font-bold leading-tight">Tokopedia</div>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-gray-600">Link marketplace belum tersedia</p>
                            <p class="text-xs text-gray-400 mt-0.5">Hubungi kami untuk informasi pembelian</p>
                        </div>
                    </div>
                @endif

                {{-- Back to products --}}
                <a href="{{ route('home') }}#products"
                   class="inline-flex items-center space-x-2 text-sm text-gray-500 hover:text-blue-600 transition-colors font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span>Kembali ke semua produk</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ─── TABS NAV (sticky) ────────────────────── --}}
<div id="detail-tabs-nav" class="sticky top-[72px] z-40 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex space-x-1 overflow-x-auto no-scrollbar">
            <button onclick="switchTab('deskripsi')" id="tab-deskripsi"
                    class="tab-btn flex-shrink-0 px-6 py-4 text-sm font-semibold border-b-2 border-blue-600 text-blue-600 transition-all">
                Deskripsi
            </button>
            @if(!empty($product->specifications))
                <button onclick="switchTab('spesifikasi')" id="tab-spesifikasi"
                        class="tab-btn flex-shrink-0 px-6 py-4 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition-all">
                    Spesifikasi
                </button>
            @endif
            <button onclick="switchTab('pembelian')" id="tab-pembelian"
                    class="tab-btn flex-shrink-0 px-6 py-4 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition-all">
                Info Pembelian
            </button>
        </div>
    </div>
</div>

{{-- ─── TAB CONTENT ─────────────────────────── --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">

            {{-- ── Deskripsi Tab ─────────────────────── --}}
            <div id="panel-deskripsi" class="tab-panel">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-1 h-8 bg-blue-600 rounded-full"></div>
                    <h2 class="text-xl font-bold text-gray-900">Deskripsi Produk</h2>
                </div>
                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed text-[15px] space-y-4">
                    @foreach(array_filter(explode("\n", $product->description)) as $para)
                        <p>{{ trim($para) }}</p>
                    @endforeach
                </div>
            </div>

            {{-- ── Spesifikasi Tab ───────────────────── --}}
            @if(!empty($product->specifications))
                <div id="panel-spesifikasi" id="spesifikasi" class="tab-panel hidden">
                    <div class="flex items-center space-x-3 mb-8">
                        <div class="w-1 h-8 bg-blue-600 rounded-full"></div>
                        <h2 class="text-xl font-bold text-gray-900">Spesifikasi Teknis</h2>
                    </div>

                    <div class="rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                        <table class="w-full text-sm">
                            <tbody class="divide-y divide-gray-100">
                                @foreach($product->specifications as $i => $spec)
                                    @if(!empty($spec['is_header']) && !empty($spec['label']))
                                        <tr>
                                            <td colspan="2" class="px-6 py-3 bg-gray-800 text-white text-xs font-bold uppercase tracking-wider">
                                                {{ $spec['label'] }}
                                            </td>
                                        </tr>
                                    @elseif(!empty($spec['label']) && !empty($spec['value']))
                                        <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-blue-50/30 transition-colors">
                                            <td class="px-6 py-4 font-semibold text-gray-700 w-2/5 border-r border-gray-100">
                                                {{ $spec['label'] }}
                                            </td>
                                            <td class="px-6 py-4 text-gray-600">
                                                {{ $spec['value'] }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            {{-- ── Info Pembelian Tab ────────────────── --}}
            <div id="panel-pembelian" class="tab-panel hidden">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-1 h-8 bg-blue-600 rounded-full"></div>
                    <h2 class="text-xl font-bold text-gray-900">Informasi Pembelian</h2>
                </div>

                <div class="grid sm:grid-cols-2 gap-5 mb-8">
                    @if($product->shopee_link)
                        <div class="border border-orange-100 bg-orange-50 rounded-2xl p-6">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center">
                                    <span class="text-white font-bold">S</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">Shopee</p>
                                    <p class="text-xs text-gray-500">Official Store</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mb-4">Beli melalui Shopee dengan jaminan keamanan transaksi dan kemudahan pengiriman ke seluruh Indonesia.</p>
                            <a href="{{ $product->shopee_link }}" target="_blank" rel="noopener noreferrer"
                               class="flex items-center justify-center space-x-2 w-full py-2.5 bg-orange-500 hover:bg-orange-600 text-white rounded-xl font-semibold text-sm transition-colors">
                                <span>Lihat di Shopee</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    @endif

                    @if($product->tokopedia_link)
                        <div class="border border-green-100 bg-green-50 rounded-2xl p-6">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center">
                                    <span class="text-white font-bold">T</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">Tokopedia</p>
                                    <p class="text-xs text-gray-500">Official Store</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mb-4">Beli melalui Tokopedia dengan berbagai metode pembayaran dan gratis ongkir ke seluruh Indonesia.</p>
                            <a href="{{ $product->tokopedia_link }}" target="_blank" rel="noopener noreferrer"
                               class="flex items-center justify-center space-x-2 w-full py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-xl font-semibold text-sm transition-colors">
                                <span>Lihat di Tokopedia</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Guarantee --}}
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6">
                    <h4 class="font-bold text-blue-900 mb-4 flex items-center space-x-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Jaminan Pembelian</span>
                    </h4>
                    <div class="grid sm:grid-cols-2 gap-3">
                        @foreach(['Produk original bergaransi', 'Pengiriman aman ke seluruh Indonesia', 'Garansi uang kembali', 'Layanan after-sales 24/7'] as $item)
                            <div class="flex items-center space-x-2 text-sm text-blue-800">
                                <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>{{ $item }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ─── RELATED PRODUCTS ──────────────────────── --}}
@if($related->isNotEmpty())
<section class="py-16 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900">Produk Lainnya</h2>
                <p class="text-gray-500 text-sm mt-1">Temukan produk lain yang tersedia</p>
            </div>
            <a href="{{ route('home') }}#products"
               class="hidden sm:inline-flex items-center space-x-1.5 text-sm text-blue-600 hover:underline font-semibold">
                <span>Lihat semua</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($related as $rel)
                <x-product-card :product="$rel" />
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
    function switchTab(name) {
        // Hide all panels
        document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
        // Remove active from all buttons
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('border-blue-600', 'text-blue-600');
            b.classList.add('border-transparent', 'text-gray-500');
        });

        // Show selected panel
        const panel = document.getElementById('panel-' + name);
        if (panel) panel.classList.remove('hidden');

        // Activate button
        const btn = document.getElementById('tab-' + name);
        if (btn) {
            btn.classList.remove('border-transparent', 'text-gray-500');
            btn.classList.add('border-blue-600', 'text-blue-600');
        }
    }

    // Auto-switch to spesifikasi if hash present
    document.addEventListener('DOMContentLoaded', function () {
        if (window.location.hash === '#spesifikasi') {
            switchTab('spesifikasi');
        }
    });
</script>
@endpush
