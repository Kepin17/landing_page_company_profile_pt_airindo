<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — {{ config('app.name') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        /* Scrollbar sidebar */
        #sidebar-nav::-webkit-scrollbar { width: 4px; }
        #sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        #sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 99px; }
    </style>

    @stack('head')
</head>
<body class="antialiased" style="background:#f1f5f9;">

    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

        {{-- ── MOBILE OVERLAY ──────────────────────── --}}
        <div x-show="sidebarOpen" x-cloak
             x-transition:enter="transition-opacity duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-20 lg:hidden"
             style="background:rgba(0,0,0,0.6);"
             @click="sidebarOpen = false"></div>

        {{-- ── SIDEBAR ──────────────────────────────── --}}
        <aside id="sidebar-nav"
               class="fixed inset-y-0 left-0 z-30 w-60 flex flex-col overflow-y-auto transform transition-transform duration-300 lg:static lg:translate-x-0"
               style="background:#0b1120;"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            {{-- Brand --}}
            <div class="flex flex-col items-center gap-3 px-5 py-5" style="border-bottom:1px solid rgba(255,255,255,0.07);">
                <img src="https://r2.fivemanage.com/eMY1LhlRUcWrX4POpj5V0/logo_makcang.png"
                     alt="Logo" class="h-9 w-auto object-contain" style="filter:brightness(0) invert(1);">
                <div class="min-w-0">
                    <p class="text-white font-bold text-sm leading-tight truncate">PT. Airindo Mitra Utama</p>
                    <p class="text-xs font-medium" style="color:#4b6cb7;">Admin Panel</p>
                </div>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 px-3 py-5 space-y-0.5">

                {{-- Section: Menu --}}
                <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-widest" style="color:#3a4a6b;">Menu</p>

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group
                          {{ request()->routeIs('admin.dashboard')
                              ? 'text-white'
                              : 'hover:text-white' }}"
                   style="{{ request()->routeIs('admin.dashboard')
                       ? 'background:linear-gradient(135deg,#2563eb,#4f46e5); box-shadow:0 4px 14px rgba(37,99,235,0.35); color:#fff;'
                       : 'color:#64748b;' }}
                          {{ !request()->routeIs('admin.dashboard') ? '' : '' }}">
                    <svg class="w-4.5 h-4.5 flex-shrink-0 w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group
                          {{ request()->routeIs('admin.products.*')
                              ? 'text-white'
                              : 'hover:text-white' }}"
                   style="{{ request()->routeIs('admin.products.*')
                       ? 'background:linear-gradient(135deg,#2563eb,#4f46e5); box-shadow:0 4px 14px rgba(37,99,235,0.35); color:#fff;'
                       : 'color:#64748b;' }}">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span>Produk</span>
                    {{-- Count badge --}}
                    <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded-md"
                          style="{{ request()->routeIs('admin.products.*') ? 'background:rgba(255,255,255,0.2); color:#fff;' : 'background:rgba(255,255,255,0.06); color:#475569;' }}">
                        {{ \App\Models\Product::count() }}
                    </span>
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group
                          {{ request()->routeIs('admin.categories.*')
                              ? 'text-white'
                              : 'hover:text-white' }}"
                   style="{{ request()->routeIs('admin.categories.*')
                       ? 'background:linear-gradient(135deg,#2563eb,#4f46e5); box-shadow:0 4px 14px rgba(37,99,235,0.35); color:#fff;'
                       : 'color:#64748b;' }}">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span>Kategori</span>
                    <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded-md"
                          style="{{ request()->routeIs('admin.categories.*') ? 'background:rgba(255,255,255,0.2); color:#fff;' : 'background:rgba(255,255,255,0.06); color:#475569;' }}">
                        {{ \App\Models\Category::count() }}
                    </span>
                </a>

                {{-- Divider --}}
                <div class="my-4" style="border-top:1px solid rgba(255,255,255,0.06);"></div>

                {{-- Section: Account --}}
                <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-widest" style="color:#3a4a6b;">Account</p>

                <a href="{{ url('/') }}" target="_blank"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 hover:text-white"
                   style="color:#64748b;">
                    <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span>Lihat Website</span>
                    <svg class="w-3 h-3 ml-auto opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 text-left"
                            style="color:#64748b;"
                            onmouseover="this.style.color='#f87171'; this.style.background='rgba(239,68,68,0.08)';"
                            onmouseout="this.style.color='#64748b'; this.style.background='transparent';">
                        <svg class="w-[18px] h-[18px] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>

            {{-- User card at bottom --}}
            <div class="px-3 pb-4">
                <div class="flex items-center gap-3 px-3 py-3 rounded-xl" style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.07);">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 text-white text-xs font-bold"
                         style="background:linear-gradient(135deg,#2563eb,#4f46e5);">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-white text-xs font-semibold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] truncate" style="color:#3a4a6b;">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

        </aside>
        {{-- ── END SIDEBAR ──────────────────────────── --}}

        {{-- ── MAIN CONTENT ─────────────────────────── --}}
        <div class="flex-1 flex flex-col overflow-hidden min-w-0">

            {{-- Top Header --}}
            <header class="flex items-center justify-between gap-4 px-6 py-4 bg-white flex-shrink-0"
                    style="border-bottom:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div class="flex items-center gap-4">
                    {{-- Hamburger (mobile) --}}
                    <button @click="sidebarOpen = !sidebarOpen"
                            class="lg:hidden p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-base font-semibold text-slate-800 leading-tight">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-xs text-slate-400">@yield('page-subtitle', 'Selamat datang kembali!')</p>
                    </div>
                </div>

                {{-- Right: user + notifications --}}
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}" target="_blank"
                       class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        View Site
                    </a>
                    <div class="flex items-center gap-2.5">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-slate-700 leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-[11px] text-slate-400">Administrator</p>
                        </div>
                        <div class="w-8 h-8 rounded-xl flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                             style="background:linear-gradient(135deg,#2563eb,#4f46e5);">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            {{-- Flash Messages --}}
            <div class="px-6 pt-4" x-data="{ show: true }">
                @if(session('success'))
                    <div x-show="show" x-init="setTimeout(() => show = false, 4000)"
                         class="flex items-center gap-3 p-4 rounded-xl mb-2 text-sm font-medium"
                         style="background:#f0fdf4; border:1px solid #bbf7d0; color:#166534;">
                        <svg class="w-4 h-4 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('success') }}
                        <button @click="show = false" class="ml-auto text-green-400 hover:text-green-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @endif
                @if(session('error'))
                    <div x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         class="flex items-center gap-3 p-4 rounded-xl mb-2 text-sm font-medium"
                         style="background:#fef2f2; border:1px solid #fecaca; color:#991b1b;">
                        <svg class="w-4 h-4 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('error') }}
                        <button @click="show = false" class="ml-auto text-red-400 hover:text-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @endif
            </div>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto px-6 py-5 pb-10">
                @yield('content')
            </main>
        </div>
        {{-- ── END MAIN ─────────────────────────────── --}}
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
