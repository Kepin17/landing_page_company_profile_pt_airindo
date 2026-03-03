@extends('layouts.public')

@section('title', config('app.name') . ' — Distributor Resmi Kompressor & Chiller')
@section('description', 'PT. Airindo Mitra Utama adalah distributor tunggal resmi Kompressor Linghein dan unit Chiller (water cooled & air cooled) untuk seluruh Indonesia, berdiri sejak 2013.')
@section('keywords', 'airindo, linghein, chiller, kompressor, compressor, pendingin, water cooled, air cooled, linghein distributor, atlas copco')

@section('content')

{{-- ═══════════════════════════════════════════
     HERO SECTION
═══════════════════════════════════════════ --}}
<section id="home" class="relative min-h-screen flex items-center overflow-hidden"
         style="background: linear-gradient(135deg, #060d1f 0%, #0b1638 50%, #0f1e4a 100%);">

    {{-- Subtle background noise / grain --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22n%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.9%22 numOctaves=%224%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23n)%22 opacity=%220.04%22/%3E%3C/svg%3E');
                opacity: 0.4;"></div>

    {{-- Glow orbs --}}
    <div class="absolute top-0 left-0 w-[500px] h-[500px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(37,99,235,0.18) 0%, transparent 70%); transform: translate(-30%, -30%);"></div>
    <div class="absolute bottom-0 right-0 w-[600px] h-[600px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(99,102,241,0.12) 0%, transparent 70%); transform: translate(30%, 30%);"></div>

    {{-- Thin horizontal rule stripe --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background-image: repeating-linear-gradient(0deg, rgba(255,255,255,0.015) 0px, rgba(255,255,255,0.015) 1px, transparent 1px, transparent 80px);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-24 pb-20">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-6">

            {{-- ── LEFT: Text ────────────────────────────── --}}
            <div class="flex-1 max-w-xl lg:max-w-none lg:w-1/2">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 border border-white/10 bg-white/5 backdrop-blur rounded-full px-4 py-1.5 mb-8">
                    <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span class="text-xs font-semibold text-slate-300 tracking-wide">
                        Distributor Tunggal Resmi Linghein — Atlas Copco Group
                    </span>
                </div>

                {{-- Headline --}}
                <h1 class="text-4xl sm:text-5xl xl:text-[3.6rem] font-extrabold leading-[1.1] tracking-tight text-white mb-6">
                    Kompressor &amp; Chiller<br>
                    <span style="background: linear-gradient(90deg, #60a5fa, #a5b4fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        Industri Terpercaya
                    </span>
                </h1>

                {{-- Body --}}
                <p class="text-base sm:text-lg text-slate-400 leading-relaxed mb-10 max-w-[480px]">
                    PT. Airindo Mitra Utama — distributor tunggal resmi Kompressor Linghein
                    dan unit Chiller (water&nbsp;cooled &amp; air&nbsp;cooled) untuk seluruh
                    Indonesia, berdiri sejak&nbsp;2013.
                </p>

                {{-- CTAs --}}
                <div class="flex flex-wrap gap-3 mb-12">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-xl transition-all duration-200 shadow-lg shadow-blue-900/50 hover:-translate-y-0.5">
                        Lihat Produk
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="#contact"
                       class="inline-flex items-center gap-2 px-6 py-3 border border-white/15 hover:border-white/35 hover:bg-white/5 text-slate-300 hover:text-white text-sm font-semibold rounded-xl transition-all duration-200">
                        Hubungi Kami
                    </a>
                </div>

                {{-- Stats --}}
                <div class="flex flex-wrap gap-8 pt-8 border-t border-white/[0.07]">
                    <div>
                        <p class="text-2xl font-extrabold text-white">{{ $products->count() }}+</p>
                        <p class="text-xs text-slate-500 mt-0.5 font-medium uppercase tracking-wider">Produk</p>
                    </div>
                    <div class="border-l border-white/[0.07] pl-8">
                        <p class="text-2xl font-extrabold text-white">12+</p>
                        <p class="text-xs text-slate-500 mt-0.5 font-medium uppercase tracking-wider">Tahun</p>
                    </div>
                    <div class="border-l border-white/[0.07] pl-8">
                        <p class="text-2xl font-extrabold text-white">2013</p>
                        <p class="text-xs text-slate-500 mt-0.5 font-medium uppercase tracking-wider">Berdiri Sejak</p>
                    </div>
                </div>
            </div>

            {{-- ── RIGHT: Image ───────────────────────────── --}}
            <div class="flex-1 lg:w-1/2 flex justify-center lg:justify-end">
                <div class="relative w-full max-w-lg xl:max-w-xl">

                    {{-- Glow behind image --}}
                    <div class="absolute inset-0 rounded-3xl pointer-events-none"
                         style="background: radial-gradient(ellipse at center, rgba(37,99,235,0.25) 0%, transparent 70%); filter: blur(32px); transform: scale(0.9) translateY(5%);"></div>

                    {{-- Image --}}
                    <img src="https://r2.fivemanage.com/eMY1LhlRUcWrX4POpj5V0/Desain_tanpa_judul-removebg-preview(1).png"
                         alt="Kompressor & Chiller Industri"
                         class="relative w-full h-auto object-contain drop-shadow-2xl"
                         style="filter: drop-shadow(0 32px 64px rgba(37,99,235,0.3));"
                         loading="eager">

                    {{-- Floating pill — top left --}}
                    <div class="absolute top-6 -left-4 flex items-center gap-2.5 bg-white/[0.06] backdrop-blur border border-white/10 rounded-2xl px-4 py-2.5 shadow-xl">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400">Kualitas</p>
                            <p class="text-xs font-bold text-white">Atlas Copco Group</p>
                        </div>
                    </div>

                    {{-- Floating pill — bottom right --}}
                    <div class="absolute bottom-8 -right-4 flex items-center gap-2.5 bg-white/[0.06] backdrop-blur border border-white/10 rounded-2xl px-4 py-2.5 shadow-xl">
                        <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400">Jangkauan</p>
                            <p class="text-xs font-bold text-white">Seluruh Indonesia</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-7 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1.5 text-white/25">
        <span class="text-[10px] font-semibold uppercase tracking-widest">Scroll</span>
        <div class="w-0.5 h-8 bg-gradient-to-b from-white/20 to-transparent rounded-full"></div>
    </div>

</section>

{{-- ═══════════════════════════════════════════
     ABOUT SECTION
═══════════════════════════════════════════ --}}
<section id="about" class="py-24 relative overflow-hidden" style="background: #080f26;">

    {{-- Subtle glow --}}
    <div class="absolute top-0 right-0 w-[400px] h-[400px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(99,102,241,0.08) 0%, transparent 70%); transform: translate(20%, -20%);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Section Header --}}
        <div class="text-center mb-16 reveal">
            <div class="inline-flex items-center gap-2 border border-white/10 bg-white/5 rounded-full px-4 py-1.5 mb-6">
                <span class="text-xs font-semibold text-slate-300 tracking-wide">Tentang Kami</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">
                Siapa
                <span style="background: linear-gradient(90deg, #60a5fa, #a5b4fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Kami?</span>
            </h2>
            <p class="text-slate-400 max-w-2xl mx-auto text-base">
                Perusahaan distribusi produk berkualitas yang telah berdiri sejak lebih dari satu dekade lalu.
            </p>
            <div class="mt-6 flex justify-center">
                <div class="w-12 h-0.5 rounded-full" style="background: linear-gradient(90deg, #3b82f6, #6366f1);"></div>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-14 items-center">

            {{-- Left: Mini stats grid --}}
            <div class="reveal">
                <div class="grid grid-cols-2 gap-4">
                    @foreach([
                        ['icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'title' => 'Distributor Tunggal', 'desc' => 'Resmi dari Atlas Copco', 'color' => '#3b82f6'],
                        ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Berdiri Sejak 2013', 'desc' => '12+ tahun pengalaman', 'color' => '#6366f1'],
                        ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'title' => 'Tim Profesional', 'desc' => 'SDM berpengalaman', 'color' => '#10b981'],
                        ['icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'title' => 'After-Sales Service', 'desc' => 'Service & maintenance', 'color' => '#f59e0b']
                    ] as $item)
                        <div class="group bg-white/[0.04] border border-white/[0.08] rounded-2xl p-6 hover:bg-white/[0.07] hover:border-white/[0.15] transition-all duration-300">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4"
                                 style="background: {{ $item['color'] }}22; ">
                                <svg class="w-5 h-5" style="color: {{ $item['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-white text-sm mb-1">{{ $item['title'] }}</h4>
                            <p class="text-slate-500 text-xs">{{ $item['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Text --}}
            <div class="reveal space-y-5">
                <h3 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight">
                    Distributor Tunggal Resmi
                    <span style="background: linear-gradient(90deg, #60a5fa, #a5b4fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Kompressor Linghein</span><br>
                    Anak Perusahaan Atlas Copco Swedia
                </h3>
                <p class="text-slate-400 text-sm leading-relaxed">
                    <span class="text-slate-200 font-medium">PT. Airindo Mitra Utama</span> berdiri sejak 2013 di bawah kepemimpinan Betty Goh sebagai respons
                    terhadap kebutuhan kompressor semua industri manufaktur untuk low pressure Compressor and chiller di Industri Plastik.
                </p>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Ditunjuk resmi sebagai Distributor Tunggal untuk Kompressor Linghein, anak perusahaan Grup Atlas Copco Swedia
                    yang terkenal sebagai Grup Kompressor terbesar di dunia.
                    Kualitas prima, teknologi terpercaya, harga kompetitif, dan after sales service terbaik.
                </p>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Berkomitmen melayani penjualan di Seluruh
                    <span class="text-blue-400 font-semibold">INDONESIA</span>
                    untuk produk Kompressor Linghein dan unit Chiller (water cooled &amp; air cooled).
                </p>

                {{-- Values list --}}
                <div class="space-y-2.5 pt-2">
                    @foreach(['Distributor Tunggal resmi Kompressor Linghein', 'Unit Chiller water cooled & air cooled', 'After-sales service profesional & responsif', 'Harga kompetitif untuk seluruh Indonesia'] as $value)
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 bg-blue-600/20 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-slate-300 text-sm">{{ $value }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="pt-4">
                    <a href="#contact"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-xl transition-all duration-200 shadow-lg shadow-blue-900/50 hover:-translate-y-0.5">
                        Hubungi Kami
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     PRODUCTS SECTION
═══════════════════════════════════════════ --}}
<section id="products" class="py-24 relative overflow-hidden" style="background: #060d1f;">

    {{-- Top divider glow --}}
    <div class="absolute top-0 inset-x-0 h-px" style="background: linear-gradient(90deg, transparent, rgba(99,102,241,0.4), transparent);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Section Header --}}
        <div class="text-center mb-16 reveal">
            @if(!empty($search))
                <div class="inline-flex items-center gap-2 border border-white/10 bg-white/5 rounded-full px-4 py-1.5 mb-6">
                    <span class="text-xs font-semibold text-slate-300 tracking-wide">Hasil Pencarian</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">
                    Hasil untuk:
                    <span style="background: linear-gradient(90deg, #60a5fa, #a5b4fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">&ldquo;{{ $search }}&rdquo;</span>
                </h2>
                <p class="text-slate-400 max-w-2xl mx-auto text-base">
                    Ditemukan <span class="text-white font-semibold">{{ $products->count() }}</span> produk yang sesuai.
                </p>
                <div class="mt-6 flex justify-center items-center gap-4">
                    <div class="w-12 h-0.5 rounded-full" style="background: linear-gradient(90deg, #3b82f6, #6366f1);"></div>
                    <a href="{{ route('home') }}#products"
                       class="inline-flex items-center gap-1.5 px-4 py-1.5 border border-white/10 bg-white/5 hover:bg-red-500/10 hover:border-red-500/30 hover:text-red-400 text-slate-400 rounded-full text-xs font-medium transition-colors">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Hapus pencarian
                    </a>
                </div>
            @else
                <div class="inline-flex items-center gap-2 border border-white/10 bg-white/5 rounded-full px-4 py-1.5 mb-6">
                    <span class="text-xs font-semibold text-slate-300 tracking-wide">Produk Kami</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">
                    Pilihan
                    <span style="background: linear-gradient(90deg, #60a5fa, #a5b4fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Produk Unggulan</span>
                </h2>
                <p class="text-slate-400 max-w-2xl mx-auto text-base">
                    Temukan berbagai produk berkualitas tinggi untuk kebutuhan industri Anda.
                </p>
                <div class="mt-6 flex justify-center">
                    <div class="w-12 h-0.5 rounded-full" style="background: linear-gradient(90deg, #3b82f6, #6366f1);"></div>
                </div>
            @endif
        </div>

        @if($products->isEmpty())
            {{-- Empty State --}}
            <div class="text-center py-24 reveal">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/[0.04] border border-white/10 rounded-3xl mb-6">
                    <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-300 mb-2">Belum Ada Produk</h3>
                <p class="text-slate-500">Produk akan segera tersedia. Nantikan update kami!</p>
            </div>
        @else
            {{-- Products Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @endif
    </div>

    {{-- Bottom divider glow --}}
    <div class="absolute bottom-0 inset-x-0 h-px" style="background: linear-gradient(90deg, transparent, rgba(59,130,246,0.3), transparent);"></div>
</section>

{{-- ═══════════════════════════════════════════
     WHY CHOOSE US
═══════════════════════════════════════════ --}}
<section class="py-24 relative overflow-hidden" style="background: #0a1225;">

    {{-- Glow orb --}}
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(37,99,235,0.07) 0%, transparent 70%); transform: translate(-30%, 30%);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 reveal">
            <div class="inline-flex items-center gap-2 border border-white/10 bg-white/5 rounded-full px-4 py-1.5 mb-6">
                <span class="text-xs font-semibold text-slate-300 tracking-wide">Keunggulan</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white">
                Mengapa Memilih
                <span style="background: linear-gradient(90deg, #60a5fa, #a5b4fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Kami?</span>
            </h2>
            <div class="mt-6 flex justify-center">
                <div class="w-12 h-0.5 rounded-full" style="background: linear-gradient(90deg, #3b82f6, #6366f1);"></div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach([
                ['icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'hex' => '#3b82f6', 'title' => 'Distributor Tunggal Resmi', 'desc' => 'Ditunjuk resmi sebagai Distributor Tunggal Kompressor Linghein — anak perusahaan Atlas Copco Swedia, grup kompressor terbesar di dunia.'],
                ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'hex' => '#10b981', 'title' => 'Air & Water Cooled Chiller', 'desc' => 'Menyediakan unit Chiller berkualitas tinggi, baik air cooled maupun water cooled, untuk berbagai kebutuhan industri.'],
                ['icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z', 'hex' => '#f97316', 'title' => 'Low Pressure Compressor', 'desc' => 'Spesialis low pressure compressor untuk industri manufaktur dan plastik dengan teknologi terkini yang hemat energi.'],
                ['icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'hex' => '#a855f7', 'title' => 'After-Sales Service', 'desc' => 'Dukungan after-sales service profesional dan responsif untuk memastikan peralatan Anda beroperasi optimal.'],
                ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'hex' => '#6366f1', 'title' => 'Harga Kompetitif', 'desc' => 'Harga yang kompetitif dan transparan dengan jaminan kualitas prima langsung dari principal.'],
                ['icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'hex' => '#f59e0b', 'title' => 'Jangkauan Seluruh Indonesia', 'desc' => 'Berkomitmen melayani penjualan Kompressor Linghein dan Chiller ke seluruh wilayah Indonesia.']
            ] as $i => $feature)
                <div class="reveal group bg-white/[0.04] border border-white/[0.08] rounded-2xl p-7 hover:bg-white/[0.07] hover:border-white/[0.16] hover:-translate-y-1 transition-all duration-300"
                     style="animation-delay: {{ $i * 80 }}ms">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform"
                         style="background: {{ $feature['hex'] }}1a;">
                        <svg class="w-5 h-5" style="color: {{ $feature['hex'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $feature['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-white mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     CONTACT SECTION
═══════════════════════════════════════════ --}}
<section id="contact" class="py-24 relative overflow-hidden" style="background: #060d1f;">

    {{-- Top divider --}}
    <div class="absolute top-0 inset-x-0 h-px" style="background: linear-gradient(90deg, transparent, rgba(99,102,241,0.3), transparent);"></div>

    {{-- Glow orb top right --}}
    <div class="absolute top-0 right-0 w-[400px] h-[400px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(99,102,241,0.09) 0%, transparent 70%); transform: translate(25%, -25%);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Section Header --}}
        <div class="text-center mb-16 reveal">
            <div class="inline-flex items-center gap-2 border border-white/10 bg-white/5 rounded-full px-4 py-1.5 mb-6">
                <span class="text-xs font-semibold text-slate-300 tracking-wide">Kontak</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">
                Hubungi
                <span style="background: linear-gradient(90deg, #60a5fa, #a5b4fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Kami</span>
            </h2>
            <p class="text-slate-400 max-w-xl mx-auto text-sm">
                Ada pertanyaan atau kebutuhan produk? Tim kami siap membantu Anda.
            </p>
            <div class="mt-6 flex justify-center">
                <div class="w-12 h-0.5 rounded-full" style="background: linear-gradient(90deg, #3b82f6, #6366f1);"></div>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-10 items-start">

            {{-- Contact Info --}}
            <div class="reveal space-y-4">
                @foreach([
                    ['hex' => '#3b82f6', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Alamat', 'text' => "Apartemen Istana Harmoni Lt.1 Blok 2U\nKomplek Harmoni Plaza, Jl. Suryopranoto No. 2\nJakarta Pusat 10130"],
                    ['hex' => '#10b981', 'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'title' => 'Telepon & Fax', 'text' => "Telp: +62-21-63870678\nFax: +62-21-63870114"],
                    ['hex' => '#a855f7', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title' => 'Email', 'text' => "sales@airindo.co.id"],
                    ['hex' => '#f97316', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Jam Operasional', 'text' => "Senin – Jumat: 08.00 – 17.00 WIB\nSabtu: 09.00 – 13.00 WIB"]
                ] as $info)
                    <div class="flex items-start gap-4 p-5 bg-white/[0.04] border border-white/[0.08] rounded-2xl hover:bg-white/[0.07] hover:border-white/[0.15] transition-all duration-200">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                             style="background: {{ $info['hex'] }}1a;">
                            <svg class="w-5 h-5" style="color: {{ $info['hex'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $info['icon'] }}"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white text-sm mb-1">{{ $info['title'] }}</h4>
                            @foreach(explode("\n", $info['text']) as $line)
                                <p class="text-slate-400 text-sm">{{ $line }}</p>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Contact Form --}}
            <div class="reveal bg-white/[0.04] border border-white/[0.08] rounded-3xl p-8">
                <h3 class="text-lg font-bold text-white mb-6">Kirim Pesan</h3>
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1.5 uppercase tracking-wide">Nama Lengkap</label>
                            <input type="text" placeholder="John Doe"
                                   class="w-full px-4 py-3 bg-white/[0.05] border border-white/10 rounded-xl text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500/40 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1.5 uppercase tracking-wide">Nomor HP / WA</label>
                            <input type="tel" placeholder="+62 812-xxx-xxxx"
                                   class="w-full px-4 py-3 bg-white/[0.05] border border-white/10 rounded-xl text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500/40 transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5 uppercase tracking-wide">Email</label>
                        <input type="email" placeholder="email@example.com"
                               class="w-full px-4 py-3 bg-white/[0.05] border border-white/10 rounded-xl text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500/40 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5 uppercase tracking-wide">Subjek</label>
                        <input type="text" placeholder="Pertanyaan tentang produk"
                               class="w-full px-4 py-3 bg-white/[0.05] border border-white/10 rounded-xl text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500/40 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5 uppercase tracking-wide">Pesan</label>
                        <textarea rows="5" placeholder="Tuliskan pesan Anda di sini..."
                                  class="w-full px-4 py-3 bg-white/[0.05] border border-white/10 rounded-xl text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500/40 transition-all resize-none"></textarea>
                    </div>
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-3.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-sm font-semibold transition-all duration-200 shadow-lg shadow-blue-900/50 hover:-translate-y-0.5 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     CTA BANNER
═══════════════════════════════════════════ --}}
<section class="py-20 relative overflow-hidden" style="background: #080f26;">

    {{-- Border top --}}
    <div class="absolute top-0 inset-x-0 h-px" style="background: linear-gradient(90deg, transparent, rgba(59,130,246,0.5), rgba(99,102,241,0.5), transparent);"></div>

    {{-- Center glow --}}
    <div class="absolute inset-0 pointer-events-none flex items-center justify-center">
        <div class="w-[600px] h-[200px] rounded-full"
             style="background: radial-gradient(ellipse, rgba(37,99,235,0.12) 0%, transparent 70%); filter: blur(24px);"></div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 reveal">

        {{-- Eyebrow --}}
        <div class="inline-flex items-center gap-2 border border-white/10 bg-white/5 rounded-full px-4 py-1.5 mb-6">
            <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
            <span class="text-xs font-semibold text-slate-300 tracking-wide">Siap Melayani Anda</span>
        </div>

        <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-4 leading-tight">
            Butuh Kompressor atau Chiller<br>
            <span style="background: linear-gradient(90deg, #60a5fa, #a5b4fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">untuk Industri Anda?</span>
        </h2>
        <p class="text-slate-400 text-sm mb-10">Konsultasikan kebutuhan Anda — kami siap memberikan solusi terbaik</p>

        <div class="flex flex-wrap justify-center gap-3">
            <a href="#contact"
               class="inline-flex items-center gap-2 px-7 py-3 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-xl transition-all duration-200 shadow-lg shadow-blue-900/50 hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                Hubungi Kami
            </a>
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2 px-7 py-3 border border-white/15 hover:border-white/35 hover:bg-white/5 text-slate-300 hover:text-white text-sm font-semibold rounded-xl transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Lihat Produk
            </a>
        </div>
    </div>

    {{-- Border bottom --}}
    <div class="absolute bottom-0 inset-x-0 h-px" style="background: linear-gradient(90deg, transparent, rgba(99,102,241,0.2), transparent);"></div>
</section>

@endsection

@push('scripts')
@if(!empty($search))
<script>
    // Auto-scroll to products section when a search is active
    window.addEventListener('load', function () {
        setTimeout(function () {
            const section = document.getElementById('products');
            if (section) section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 400);
    });
</script>
@endif
@endpush
