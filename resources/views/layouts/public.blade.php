<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'PT. Airindo Mitra Utama - Distributor Tunggal Resmi Kompressor Linghein & Chiller untuk seluruh Indonesia')">
    <meta name="keywords" content="@yield('keywords', 'airindo, linghein, kompressor, chiller, air cooled, water cooled, atlas copco, distributor indonesia')">
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('description', 'PT. Company Indonesia')">
    <meta property="og:type" content="website">
    <title>@yield('title', config('app.name', 'Company Profile'))</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50:  '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @stack('head')

    <style>
        body { font-family: 'Inter', sans-serif; }

        /* ── Navbar base: dark glass ── */
        #navbar {
            background: rgba(10, 15, 35, 0.55);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        /* ── Navbar scrolled: solid dark ── */
        #navbar.scrolled {
            background: rgba(8, 12, 30, 0.97) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.06) !important;
            box-shadow: 0 4px 32px rgba(0,0,0,0.35);
        }

        /* nav-link states stay consistent — white on dark always */
        .nav-link { transition: background 0.18s, color 0.18s; }
        .nav-link:hover { background: rgba(255,255,255,0.10) !important; }
        .nav-link.active-link { background: rgba(59,130,246,0.25) !important; color: #93c5fd !important; }

        /* active dot indicator under current page link */
        .nav-dot::after {
            content: '';
            display: block;
            width: 4px; height: 4px;
            background: #3b82f6;
            border-radius: 9999px;
            margin: 2px auto 0;
        }

        /* Mega-menu panel */
        .mega-panel {
            background: #0f172a;
            border: 1px solid rgba(255,255,255,0.08);
        }
        .mega-col-title {
            color: #60a5fa;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            margin-bottom: 0.5rem;
        }
        .mega-item {
            display: block;
            padding: 0.35rem 0.6rem;
            font-size: 0.75rem;
            color: #94a3b8;
            border-radius: 0.5rem;
            transition: background 0.15s, color 0.15s;
            line-height: 1.4;
        }
        .mega-item:hover { background: rgba(59,130,246,0.15); color: #93c5fd; }

        /* Search box */
        .search-dropdown {
            background: #0f172a;
            border: 1px solid rgba(255,255,255,0.1);
        }

        /* Mobile menu */
        #mobile-menu {
            background: #0d1526;
            border: 1px solid rgba(255,255,255,0.07);
        }
        .mob-link {
            color: #cbd5e1;
            border-radius: 0.75rem;
            transition: background 0.18s, color 0.18s;
        }
        .mob-link:hover { background: rgba(255,255,255,0.07) !important; color: #fff !important; }

        /* Fade-in on scroll */
        .reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* Hero gradient */
        .hero-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 45%, #2563eb 100%);
        }

        /* Smooth scroll offset for fixed navbar */
        html { scroll-padding-top: 80px; }
    </style>
</head>
<body class="bg-white text-gray-800 antialiased">

    <!-- ─── NAVBAR ─────────────────────────────── -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <!-- ── Logo ── -->
                <a href="{{ url('/') }}" class="flex items-center flex-shrink-0">
                    <img src="https://r2.fivemanage.com/eMY1LhlRUcWrX4POpj5V0/logo_makcang.png"
                         alt="{{ config('app.name') }}"
                         class="h-10 w-auto object-contain"
                         loading="eager">
                </a>

                <!-- ── Desktop Nav Links ── -->
                <div class="hidden lg:flex items-center gap-0.5">

                    <a href="{{ url('/') }}#home"
                       class="nav-link px-4 py-2 rounded-lg text-sm text-slate-200 font-medium hover:text-white">
                        Home
                    </a>
                    <a href="{{ url('/') }}#about"
                       class="nav-link px-4 py-2 rounded-lg text-sm text-slate-200 font-medium hover:text-white">
                        About
                    </a>

                    <!-- Products Mega Dropdown -->
                    <div class="relative group/prod">
                        <a href="{{ route('products.index') }}"
                           class="nav-link flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm text-slate-200 font-medium hover:text-white">
                            <span>Products</span>
                            <svg class="w-3.5 h-3.5 opacity-60 transition-transform duration-200 group-hover/prod:rotate-180"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>

                        {{-- Mega-panel --}}
                        <div class="mega-panel absolute top-full left-1/2 -translate-x-1/2 mt-3 w-[800px] rounded-2xl shadow-2xl
                                    opacity-0 invisible group-hover/prod:opacity-100 group-hover/prod:visible
                                    -translate-y-2 group-hover/prod:translate-y-0 transition-all duration-200 z-50">

                            {{-- Panel header --}}
                            <div class="px-6 pt-5 pb-4 border-b border-white/5 flex items-center justify-between">
                                <div>
                                    <p class="text-white font-semibold text-sm">Katalog Produk</p>
                                    <p class="text-slate-400 text-xs mt-0.5">Kompressor & Chiller industri berkualitas tinggi</p>
                                </div>
                                <a href="{{ route('products.index') }}"
                                   class="flex items-center gap-1.5 text-xs font-semibold text-blue-400 hover:text-blue-300 transition-colors">
                                    Lihat semua
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>

                            <div class="grid grid-cols-4 gap-0 p-5">

                                {{-- Col 1 --}}
                                <div class="pr-5 border-r border-white/5">
                                    <p class="mega-col-title">Air Cooled Chiller</p>
                                    @foreach([
                                        'Industrial Chiller (Economical Design)',
                                        'Environmental Industrial Chiller',
                                        'Screw Chiller',
                                        'Packaged Low Temperature Chiller',
                                        'Low Temperature Screw Chiller',
                                        'Laser Chiller',
                                        'Heating And Cooling Chiller',
                                        'Plating Chiller',
                                        'Oil Chiller',
                                        'Mold Temperature Controller',
                                        'Cooling Tower',
                                    ] as $item)
                                        <a href="{{ route('products.index', ['category' => 'Air Cooled Chiller', 'search' => $item]) }}"
                                           class="mega-item">{{ $item }}</a>
                                    @endforeach
                                </div>

                                {{-- Col 2 --}}
                                <div class="px-5 border-r border-white/5">
                                    <p class="mega-col-title">Linghein</p>
                                    <a href="{{ route('products.index', ['category' => 'Linghein']) }}"
                                       class="mega-item flex items-center gap-1.5 font-medium text-slate-300 hover:text-blue-300">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                        Lihat Semua Produk
                                    </a>
                                </div>

                                {{-- Col 3 --}}
                                <div class="px-5 border-r border-white/5">
                                    <p class="mega-col-title">Jianye</p>
                                    @foreach([
                                        'Screw Air Compressor',
                                        'Piston Air Compressor',
                                        'Air Tank',
                                        'Air Dryer',
                                        'Air Filter',
                                        'After Cooler',
                                        'Replacement',
                                    ] as $item)
                                        <a href="{{ route('products.index', ['category' => 'Jianye', 'search' => $item]) }}"
                                           class="mega-item">{{ $item }}</a>
                                    @endforeach
                                </div>

                                {{-- Col 4 --}}
                                <div class="pl-5">
                                    <p class="mega-col-title">Renner</p>
                                    @foreach([
                                        'Screw Compressors',
                                        'Frequency Control',
                                        'Oilfree Compressors',
                                        'Piston Compressors',
                                        'Screw Booster',
                                        'Air Treatment',
                                        'Electronic Controls',
                                        'Heat Recovery',
                                    ] as $item)
                                        <a href="{{ route('products.index', ['category' => 'Renner', 'search' => $item]) }}"
                                           class="mega-item">{{ $item }}</a>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>

                    <a href="{{ url('/') }}#contact"
                       class="nav-link px-4 py-2 rounded-lg text-sm text-slate-200 font-medium hover:text-white">
                        Contact
                    </a>

                </div>

                <!-- ── Right Side: Search + CTA ── -->
                <div class="hidden lg:flex items-center gap-2">

                    <!-- Search -->
                    <div class="relative" id="search-wrapper">
                        <button onclick="toggleSearch()"
                                class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-white/10 transition-all text-sm"
                                aria-label="Cari produk">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                            </svg>
                            <span>Cari</span>
                        </button>
                        <div id="search-box"
                             class="hidden search-dropdown absolute top-full right-0 mt-3 w-80 rounded-2xl shadow-2xl p-3 z-50">
                            <form action="{{ route('products.index') }}" method="GET">
                                <div class="flex items-center gap-2">
                                    <input type="text" name="search"
                                           id="desktop-search-input"
                                           value="{{ request('search') }}"
                                           placeholder="Cari nama produk..."
                                           class="flex-1 px-3 py-2.5 bg-white/5 border border-white/10 rounded-xl text-sm text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
                                    <button type="submit"
                                            class="px-3 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-500 transition-colors flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- CTA -->
                    <a href="{{ url('/') }}#contact"
                       class="flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-xl transition-all duration-200 shadow-lg shadow-blue-900/40">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Hubungi Kami
                    </a>

                </div>

                <!-- ── Hamburger ── -->
                <button id="hamburger" class="lg:hidden text-slate-200 p-2 rounded-lg hover:bg-white/10 transition-colors" aria-label="Toggle menu">
                    <svg id="icon-open"  class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- ── Mobile Menu ── -->
        <div id="mobile-menu" class="hidden lg:hidden mx-4 mt-1 mb-2 rounded-2xl overflow-hidden shadow-2xl border border-white/[0.06]">
            <div class="px-4 py-4 space-y-1">

                <!-- Mobile Search -->
                <form action="{{ route('products.index') }}" method="GET" class="mb-3">
                    <div class="flex items-center gap-2 bg-white/5 border border-white/10 rounded-xl px-3 py-1 focus-within:border-blue-500/50">
                        <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                        <input type="text" name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari produk..."
                               class="flex-1 bg-transparent text-sm text-white placeholder-slate-400 py-2 focus:outline-none">
                        <button type="submit"
                                class="px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition-colors text-xs font-semibold flex-shrink-0">
                            Cari
                        </button>
                    </div>
                </form>

                <div class="border-b border-white/[0.06] mb-2"></div>

                <a href="{{ url('/') }}#home"  class="mob-link flex items-center px-4 py-2.5 text-sm font-medium">Home</a>
                <a href="{{ url('/') }}#about" class="mob-link flex items-center px-4 py-2.5 text-sm font-medium">About</a>

                {{-- Products accordion --}}
                <div>
                    <button onclick="toggleMobile('mob-products')"
                            class="mob-link w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium">
                        <span>Products</span>
                        <svg id="mob-products-icon" class="w-4 h-4 opacity-50 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="mob-products" class="hidden mt-1 space-y-0.5 pl-2">

                        {{-- Air Cooled Chiller --}}
                        <button onclick="toggleMobile('mob-acc')"
                                class="mob-link w-full flex items-center justify-between px-4 py-2 text-xs font-semibold text-blue-400">
                            <span>Air Cooled Chiller</span>
                            <svg id="mob-acc-icon" class="w-3.5 h-3.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="mob-acc" class="hidden pl-3 space-y-0.5">
                            @foreach(['Industrial Chiller (Economical Design)','Environmental Industrial Chiller','Screw Chiller','Packaged Low Temperature Chiller','Low Temperature Screw Chiller','Laser Chiller','Heating And Cooling Chiller','Plating Chiller','Oil Chiller','Mold Temperature Controller','Cooling Tower'] as $item)
                                <a href="{{ route('products.index', ['category' => 'Air Cooled Chiller', 'search' => $item]) }}"
                                   class="mob-link block px-4 py-2 text-xs">{{ $item }}</a>
                            @endforeach
                        </div>

                        {{-- Linghein --}}
                        <a href="{{ route('products.index', ['category' => 'Linghein']) }}"
                           class="mob-link flex items-center px-4 py-2 text-xs font-semibold text-blue-400">Linghein</a>

                        {{-- Jianye --}}
                        <button onclick="toggleMobile('mob-jianye')"
                                class="mob-link w-full flex items-center justify-between px-4 py-2 text-xs font-semibold text-blue-400">
                            <span>Jianye</span>
                            <svg id="mob-jianye-icon" class="w-3.5 h-3.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="mob-jianye" class="hidden pl-3 space-y-0.5">
                            @foreach(['Screw Air Compressor','Piston Air Compressor','Air Tank','Air Dryer','Air Filter','After Cooler','Replacement'] as $item)
                                <a href="{{ route('products.index', ['category' => 'Jianye', 'search' => $item]) }}"
                                   class="mob-link block px-4 py-2 text-xs">{{ $item }}</a>
                            @endforeach
                        </div>

                        {{-- Renner --}}
                        <button onclick="toggleMobile('mob-renner')"
                                class="mob-link w-full flex items-center justify-between px-4 py-2 text-xs font-semibold text-blue-400">
                            <span>Renner</span>
                            <svg id="mob-renner-icon" class="w-3.5 h-3.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="mob-renner" class="hidden pl-3 space-y-0.5">
                            @foreach(['Screw Compressors','Frequency Control','Oilfree Compressors','Piston Compressors','Screw Booster','Air Treatment','Electronic Controls','Heat Recovery'] as $item)
                                <a href="{{ route('products.index', ['category' => 'Renner', 'search' => $item]) }}"
                                   class="mob-link block px-4 py-2 text-xs">{{ $item }}</a>
                            @endforeach
                        </div>

                    </div>
                </div>

                <a href="{{ url('/') }}#contact" class="mob-link flex items-center px-4 py-2.5 text-sm font-medium">Contact</a>

                <div class="pt-3 mt-1 border-t border-white/[0.06]">
                    <a href="{{ url('/') }}#contact"
                       class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-blue-600 text-white rounded-xl font-semibold text-sm hover:bg-blue-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Hubungi Kami
                    </a>
                </div>

            </div>
        </div>
    </nav>
    <!-- ─── END NAVBAR ──────────────────────────── -->

    @yield('content')

    <!-- ─── FOOTER ─────────────────────────────── -->
    <footer class="bg-gray-900 text-gray-400 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

                <!-- Brand -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="https://r2.fivemanage.com/eMY1LhlRUcWrX4POpj5V0/logo_makcang.png"
                             alt="{{ config('app.name') }}"
                             class="h-10 w-auto object-contain brightness-0 invert">
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6 max-w-sm">
                        Distributor Tunggal Resmi Kompressor Linghein — anak perusahaan Grup Atlas Copco Swedia — dan unit Chiller (water cooled &amp; air cooled) untuk seluruh Indonesia. Berdiri sejak 2013.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors" aria-label="Facebook">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-pink-600 transition-colors" aria-label="Instagram">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-green-600 transition-colors" aria-label="WhatsApp">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold mb-5 text-sm uppercase tracking-wider">Quick Links</h4>
                    <ul class="space-y-2.5">
                        <li><a href="#home"     class="text-sm hover:text-white hover:translate-x-1 inline-flex items-center space-x-1.5 transition-all"><span class="w-1 h-1 bg-blue-500 rounded-full"></span><span>Home</span></a></li>
                        <li><a href="#about"    class="text-sm hover:text-white hover:translate-x-1 inline-flex items-center space-x-1.5 transition-all"><span class="w-1 h-1 bg-blue-500 rounded-full"></span><span>About Us</span></a></li>
                        <li><a href="#products" class="text-sm hover:text-white hover:translate-x-1 inline-flex items-center space-x-1.5 transition-all"><span class="w-1 h-1 bg-blue-500 rounded-full"></span><span>Products</span></a></li>
                        <li><a href="#contact"  class="text-sm hover:text-white hover:translate-x-1 inline-flex items-center space-x-1.5 transition-all"><span class="w-1 h-1 bg-blue-500 rounded-full"></span><span>Contact</span></a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-white font-semibold mb-5 text-sm uppercase tracking-wider">Contact</h4>
                    <ul class="space-y-3.5">
                        <li class="flex items-start space-x-3">
                            <svg class="w-4 h-4 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span class="text-sm leading-snug">Apartemen Istana Harmoni Lt.1 Blok 2U<br>Komplek Harmoni Plaza, Jl. Suryopranoto No. 2<br>Jakarta Pusat 10130</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span class="text-sm">sales@airindo.co.id</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span class="text-sm">+62-21-63870678 / Fax +62-21-63870114</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-3">
                <p class="text-sm">&copy; {{ date('Y') }} PT. Airindo Mitra Utama. All Rights Reserved.</p>
                <p class="text-sm">Designed with ♥ in Indonesia</p>
            </div>
        </div>
    </footer>
    <!-- ─── END FOOTER ───────────────────────────── -->

    <script>
        // ── Navbar scroll effect
        const navbar = document.getElementById('navbar');

        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        });

        // ── Mobile hamburger toggle
        const hamburger  = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconOpen   = document.getElementById('icon-open');
        const iconClose  = document.getElementById('icon-close');

        hamburger.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden', !isHidden);
            iconClose.classList.toggle('hidden', isHidden);
        });

        // Close on link click (non-button elements only)
        mobileMenu.querySelectorAll('a').forEach(a =>
            a.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                iconOpen.classList.remove('hidden');
                iconClose.classList.add('hidden');
            })
        );

        // ── Mobile accordion toggle
        function toggleMobile(id) {
            const panel = document.getElementById(id);
            const icon  = document.getElementById(id + '-icon');
            if (!panel) return;
            const isHidden = panel.classList.toggle('hidden');
            if (icon) icon.style.transform = isHidden ? '' : 'rotate(180deg)';
        }

        // ── Desktop search toggle
        function toggleSearch() {
            const box   = document.getElementById('search-box');
            const input = document.getElementById('desktop-search-input');
            const isNowHidden = box.classList.toggle('hidden');
            if (!isNowHidden && input) {
                setTimeout(() => input.focus(), 50);
            }
        }

        // Close search dropdown when clicking outside
        document.addEventListener('click', function (e) {
            const wrapper = document.getElementById('search-wrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                document.getElementById('search-box')?.classList.add('hidden');
            }
        });

        // ── Scroll reveal animation
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
    </script>

    @stack('scripts')
</body>
</html>
