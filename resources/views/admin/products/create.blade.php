@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk Baru')
@section('page-subtitle', 'Isi formulir berikut untuk menambahkan produk baru')

@section('content')

<div class="max-w-2xl">

    {{-- Breadcrumb --}}
    <nav class="flex items-center space-x-2 text-sm text-gray-400 mb-6">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
        <span>/</span>
        <a href="{{ route('admin.products.index') }}" class="hover:text-blue-600 transition-colors">Produk</a>
        <span>/</span>
        <span class="text-gray-700 font-medium">Tambah Baru</span>
    </nav>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-base font-bold text-gray-900">Informasi Produk</h2>
            <p class="text-sm text-gray-500 mt-0.5">Lengkapi semua informasi produk</p>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Nama Produk <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       placeholder="Contoh: Produk A Premium Edition"
                       class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition-all
                              {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                @error('name')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center space-x-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            {{-- Category --}}
            <div>
                <label for="category" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Kategori
                </label>
                <select name="category" id="category"
                        class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition-all
                               {{ $errors->has('category') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach(\App\Models\Product::CATEGORIES as $cat)
                        <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center space-x-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            {{-- Short Description --}}
            <div>
                <label for="short_description" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Deskripsi Singkat
                    <span class="text-gray-400 font-normal">(maks 300 karakter, tampil di kartu produk)</span>
                </label>
                <textarea name="short_description" id="short_description" rows="2" maxlength="300"
                          placeholder="Ringkasan singkat produk yang menarik perhatian..."
                          oninput="updateCharCount(this, 'sd-count')"
                          class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition-all resize-none
                                 {{ $errors->has('short_description') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">{{ old('short_description') }}</textarea>
                <div class="flex items-center justify-between mt-1">
                    @error('short_description')
                        <p class="text-xs text-red-500 flex items-center space-x-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ $message }}</span>
                        </p>
                    @else
                        <span></span>
                    @enderror
                    <span id="sd-count" class="text-xs text-gray-400 ml-auto">{{ strlen(old('short_description', '')) }}/300</span>
                </div>
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea name="description" id="description" rows="5"
                          placeholder="Tuliskan deskripsi lengkap produk..."
                          class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition-all resize-none
                                 {{ $errors->has('description') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center space-x-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            {{-- Specifications --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Spesifikasi Teknis
                    <span class="text-gray-400 font-normal">(opsional)</span>
                </label>
                <div class="rounded-xl border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-4 py-2.5 border-b border-gray-200 flex items-center justify-between">
                        <p class="text-xs text-gray-500 font-medium">Tambahkan label & nilai spesifikasi</p>
                        <button type="button" onclick="addSpecRow()"
                                class="inline-flex items-center space-x-1 text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            <span>Tambah Baris</span>
                        </button>
                    </div>
                    <div id="spec-rows" class="divide-y divide-gray-100">
                        <div class="spec-row flex items-center gap-2 p-3">
                            <input type="text" name="specifications[0][label]" placeholder="Label (cth: Daya)" required
                                   class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400">
                            <input type="text" name="specifications[0][value]" placeholder="Nilai (cth: 1000W)" required
                                   class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400">
                            <button type="button" onclick="removeSpecRow(this)"
                                    class="w-8 h-8 rounded-lg flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 transition-colors flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                    <div id="spec-empty" class="hidden px-4 py-6 text-center text-sm text-gray-400">
                        Belum ada spesifikasi. Klik tombol di atas untuk menambahkan.
                    </div>
                </div>
                <p class="text-xs text-gray-400 mt-1.5">Baris pertama akan kosong jika tidak diisi, tambahkan baris lain sesuai kebutuhan.</p>
            </div>

            {{-- Image Upload --}}
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Gambar Produk
                    <span class="text-gray-400 font-normal">(opsional, max 2MB)</span>
                </label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-blue-300 transition-colors cursor-pointer"
                     onclick="document.getElementById('image').click()">
                    <input type="file" name="image" id="image" accept="image/*"
                           class="hidden" onchange="previewImage(this)">
                    <div id="image-preview" class="hidden mb-3">
                        <img id="preview-img" src="#" alt="Preview"
                             class="max-h-40 mx-auto rounded-xl object-contain">
                    </div>
                    <div id="upload-placeholder">
                        <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm font-medium text-gray-500">Klik untuk upload gambar</p>
                        <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP max 2MB</p>
                    </div>
                </div>
                @error('image')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center space-x-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            {{-- Marketplace Links --}}
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="shopee_link" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <span class="inline-flex items-center space-x-1.5">
                            <span class="w-5 h-5 bg-orange-500 rounded flex items-center justify-center text-white text-xs font-bold">S</span>
                            <span>Link Shopee</span>
                        </span>
                    </label>
                    <input type="url" name="shopee_link" id="shopee_link" value="{{ old('shopee_link') }}"
                           placeholder="https://shopee.co.id/..."
                           class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-500/30 focus:border-orange-400 transition-all
                                  {{ $errors->has('shopee_link') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                    @error('shopee_link')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tokopedia_link" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <span class="inline-flex items-center space-x-1.5">
                            <span class="w-5 h-5 bg-green-500 rounded flex items-center justify-center text-white text-xs font-bold">T</span>
                            <span>Link Tokopedia</span>
                        </span>
                    </label>
                    <input type="url" name="tokopedia_link" id="tokopedia_link" value="{{ old('tokopedia_link') }}"
                           placeholder="https://tokopedia.com/..."
                           class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-400 transition-all
                                  {{ $errors->has('tokopedia_link') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                    @error('tokopedia_link')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Active Toggle --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                <div>
                    <p class="text-sm font-semibold text-gray-800">Status Aktif</p>
                    <p class="text-xs text-gray-500 mt-0.5">Produk aktif akan ditampilkan di halaman publik</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1"
                           class="sr-only peer" {{ old('is_active', '1') ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-500/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>

            {{-- Submit Buttons --}}
            <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
                <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 px-7 py-3 bg-blue-600 text-white rounded-xl font-semibold text-sm hover:bg-blue-700 transition-colors shadow-md shadow-blue-500/20 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Simpan Produk</span>
                </button>
                <a href="{{ route('admin.products.index') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center px-7 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold text-sm hover:bg-gray-200 transition-colors">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
                document.getElementById('upload-placeholder').classList.add('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function updateCharCount(textarea, counterId) {
        document.getElementById(counterId).textContent = textarea.value.length + '/300';
    }

    let specIndex = 1;

    function addSpecRow() {
        const container = document.getElementById('spec-rows');
        const empty = document.getElementById('spec-empty');
        empty.classList.add('hidden');
        const row = document.createElement('div');
        row.className = 'spec-row flex items-center gap-2 p-3';
        row.innerHTML = `
            <input type="text" name="specifications[${specIndex}][label]" placeholder="Label (cth: Voltase)" required
                   class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400">
            <input type="text" name="specifications[${specIndex}][value]" placeholder="Nilai (cth: 220V)" required
                   class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400">
            <button type="button" onclick="removeSpecRow(this)"
                    class="w-8 h-8 rounded-lg flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 transition-colors flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>`;
        container.appendChild(row);
        specIndex++;
    }

    function removeSpecRow(btn) {
        const row = btn.closest('.spec-row');
        row.remove();
        const rows = document.querySelectorAll('.spec-row');
        if (rows.length === 0) {
            document.getElementById('spec-empty').classList.remove('hidden');
        }
    }
</script>
@endpush

@endsection
