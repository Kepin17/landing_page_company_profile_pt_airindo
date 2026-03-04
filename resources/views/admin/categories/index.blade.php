@extends('layouts.admin')

@section('title', 'Manajemen Kategori')
@section('page-title', 'Manajemen Kategori')
@section('page-subtitle', 'Kelola kategori & sub-kategori produk')

@section('content')

<div class="max-w-4xl">

    {{-- Breadcrumb --}}
    <nav class="flex items-center space-x-2 text-sm text-gray-400 mb-6">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
        <span>/</span>
        <span class="text-gray-700 font-medium">Kategori</span>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 rounded-xl text-sm text-green-700">
            <svg class="w-4 h-4 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Top Bar --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 mb-5">
        {{-- Search --}}
        <div class="relative flex-1 w-full">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
            <input type="text" id="cat-search" placeholder="Cari kategori..."
                   class="w-full pl-9 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 bg-white"
                   oninput="filterCategories(this.value)">
        </div>

        {{-- Add Parent Category Button --}}
        <button onclick="openModal('add-parent-modal')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition-colors shadow-sm shadow-blue-500/20 whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kategori Utama
        </button>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
        <div class="bg-white rounded-xl border border-gray-100 p-4 text-center">
            <p class="text-2xl font-bold text-blue-600">{{ $categories->count() }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Kategori Utama</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-4 text-center">
            <p class="text-2xl font-bold text-purple-600">{{ $categories->sum(fn($c) => $c->children->count()) }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Sub-Kategori</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-4 text-center">
            <p class="text-2xl font-bold text-green-600">{{ \App\Models\Product::whereNotNull('category')->count() }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Produk Berkategori</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-4 text-center">
            <p class="text-2xl font-bold text-gray-700">{{ \App\Models\Product::count() }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Total Produk</p>
        </div>
    </div>

    {{-- Category Tree --}}
    <div id="category-tree" class="space-y-4">
        @forelse($categories as $parent)
            <div class="cat-group bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" data-name="{{ strtolower($parent->name) }}">

                {{-- Parent Header --}}
                <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-r from-blue-600 to-indigo-600">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm cat-name-text">{{ $parent->name }}</p>
                            <p class="text-blue-200 text-xs">{{ $parent->children->count() }} sub-kategori · {{ \App\Models\Product::where('category', $parent->name)->count() }} produk</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="openAddSubModal({{ $parent->id }}, '{{ addslashes($parent->name) }}')"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/15 hover:bg-white/25 text-white rounded-lg text-xs font-semibold transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Sub-Kategori
                        </button>
                        <button onclick="openEditModal({{ $parent->id }}, '{{ addslashes($parent->name) }}')"
                                class="p-1.5 bg-white/15 hover:bg-white/25 text-white rounded-lg transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <form action="{{ route('admin.categories.destroy', $parent) }}" method="POST"
                              onsubmit="return confirm('Hapus kategori \"{{ addslashes($parent->name) }}\" beserta semua sub-kategorinya?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 bg-white/15 hover:bg-red-500 text-white rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Children --}}
                @if($parent->children->isNotEmpty())
                    <div class="divide-y divide-gray-50">
                        @foreach($parent->children as $child)
                            <div class="sub-item flex items-center justify-between px-5 py-3 hover:bg-gray-50 transition-colors" data-name="{{ strtolower($child->name) }}">
                                <div class="flex items-center gap-3">
                                    <div class="w-1.5 h-1.5 rounded-full bg-blue-400 flex-shrink-0 ml-2"></div>
                                    <span class="text-sm text-gray-700 cat-name-text">{{ $child->name }}</span>
                                    <span class="text-xs text-gray-400 bg-gray-100 px-1.5 py-0.5 rounded-md">
                                        {{ \App\Models\Product::where('category', $child->name)->count() }} produk
                                    </span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <button onclick="openEditModal({{ $child->id }}, '{{ addslashes($child->name) }}')"
                                            class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.categories.destroy', $child) }}" method="POST"
                                          onsubmit="return confirm('Hapus sub-kategori \"{{ addslashes($child->name) }}\"?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="px-5 py-5 text-center text-sm text-gray-400">
                        Belum ada sub-kategori. Klik <strong>+ Sub-Kategori</strong> untuk menambahkan.
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-12 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <p class="text-gray-500 font-medium">Belum ada kategori</p>
                <p class="text-sm text-gray-400 mt-1">Klik <strong>Tambah Kategori Utama</strong> untuk memulai.</p>
            </div>
        @endforelse
    </div>

    {{-- No search result --}}
    <div id="no-result" class="hidden text-center py-12 text-gray-400 text-sm">
        Tidak ada kategori yang cocok dengan pencarian.
    </div>

</div>

{{-- ───── MODALS ───────────────────────────────── --}}

{{-- Add Parent Modal --}}
<div id="add-parent-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('add-parent-modal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="text-base font-bold text-gray-900">Tambah Kategori Utama</h3>
            <p class="text-sm text-gray-500 mt-0.5">Kategori induk (Air Cooled Chiller, Linghein, dll)</p>
        </div>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="parent_id" value="">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="name" required placeholder="cth: Air Cooled Chiller"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 py-3 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition-colors">
                    Simpan
                </button>
                <button type="button" onclick="closeModal('add-parent-modal')"
                        class="flex-1 py-3 bg-gray-100 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-200 transition-colors">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Add Sub-category Modal --}}
<div id="add-sub-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('add-sub-modal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="text-base font-bold text-gray-900">Tambah Sub-Kategori</h3>
            <p id="sub-modal-parent-label" class="text-sm text-gray-500 mt-0.5">Di bawah: —</p>
        </div>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="parent_id" id="sub-parent-id" value="">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Sub-Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="sub-name-input" required placeholder="cth: Screw Chiller"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 py-3 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition-colors">
                    Simpan
                </button>
                <button type="button" onclick="closeModal('add-sub-modal')"
                        class="flex-1 py-3 bg-gray-100 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-200 transition-colors">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div id="edit-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('edit-modal')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="text-base font-bold text-gray-900">Edit Kategori</h3>
        </div>
        <form id="edit-form" method="POST" class="p-6 space-y-4">
            @csrf @method('PATCH')
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="edit-name-input" required
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 py-3 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition-colors">
                    Perbarui
                </button>
                <button type="button" onclick="closeModal('edit-modal')"
                        class="flex-1 py-3 bg-gray-100 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-200 transition-colors">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById(id).querySelector('input[name="name"]')?.focus();
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function openAddSubModal(parentId, parentName) {
        document.getElementById('sub-parent-id').value = parentId;
        document.getElementById('sub-modal-parent-label').textContent = 'Di bawah: ' + parentName;
        document.getElementById('sub-name-input').value = '';
        openModal('add-sub-modal');
    }

    function openEditModal(id, name) {
        document.getElementById('edit-form').action = '/admin/categories/' + id;
        document.getElementById('edit-name-input').value = name;
        openModal('edit-modal');
    }

    // Close modal on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            ['add-parent-modal','add-sub-modal','edit-modal'].forEach(closeModal);
        }
    });

    // Search / filter
    function filterCategories(query) {
        const q = query.toLowerCase().trim();
        const groups = document.querySelectorAll('.cat-group');
        let anyVisible = false;

        groups.forEach(group => {
            const parentName = group.dataset.name;
            const subs = group.querySelectorAll('.sub-item');
            let subVisible = false;

            subs.forEach(sub => {
                const match = sub.dataset.name.includes(q);
                sub.style.display = (!q || match) ? '' : 'none';
                if (match) subVisible = true;
            });

            const parentMatch = !q || parentName.includes(q) || subVisible;
            group.style.display = parentMatch ? '' : 'none';
            if (parentMatch) anyVisible = true;
        });

        document.getElementById('no-result').classList.toggle('hidden', anyVisible || !q);
    }
</script>
@endpush

@endsection
