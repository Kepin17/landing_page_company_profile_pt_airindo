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
            <div x-data="categoryDropdown('{{ old('category') }}')" class="relative">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori</label>
                <input type="hidden" name="category" :value="selected">

                {{-- Trigger button --}}
                <button type="button" @click="open = !open"
                        class="w-full px-4 py-3 border rounded-xl text-sm text-left flex items-center justify-between focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 transition-all
                               {{ $errors->has('category') ? 'border-red-400 bg-red-50' : 'border-gray-200' }} bg-white">
                    <span x-text="selected || '-- Pilih Kategori --'" :class="selected ? 'text-gray-800' : 'text-gray-400'"></span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Dropdown panel --}}
                <div x-show="open" @click.outside="open = false" x-transition
                     class="absolute z-50 mt-1 w-full bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">
                    {{-- Search input --}}
                    <div class="p-2 border-b border-gray-100">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" x-model="search" @keydown.escape="open = false"
                                   placeholder="Cari kategori..." autofocus
                                   class="w-full pl-8 pr-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-400">
                        </div>
                    </div>
                    {{-- Options list --}}
                    <div class="max-h-52 overflow-y-auto">
                        {{-- Clear option --}}
                        <div x-show="!search" @click="select('')"
                             class="px-4 py-2 text-sm text-gray-400 italic cursor-pointer hover:bg-gray-50">
                            -- Tidak ada kategori --
                        </div>
                        @foreach($categoriesGrouped as $parent => $children)
                            {{-- Parent header --}}
                            <div x-show="matchGroup('{{ $parent }}', {{ json_encode($children) }})"
                                 class="px-3 py-1 text-xs font-bold text-blue-600 uppercase tracking-wide bg-blue-50 border-t border-blue-100 first:border-t-0">
                                {{ $parent }}
                            </div>
                            @if(count($children))
                                @foreach($children as $child)
                                <div x-show="matchItem('{{ $child }}')" @click="select('{{ $child }}')"
                                     class="px-5 py-2 text-sm cursor-pointer hover:bg-blue-50 transition-colors"
                                     :class="selected === '{{ $child }}' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-700'">
                                    {{ $child }}
                                </div>
                                @endforeach
                            @else
                                {{-- Parent with no children is itself selectable --}}
                                <div x-show="matchItem('{{ $parent }}')" @click="select('{{ $parent }}')"
                                     class="px-5 py-2 text-sm cursor-pointer hover:bg-blue-50 transition-colors"
                                     :class="selected === '{{ $parent }}' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-700'">
                                    {{ $parent }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

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

                {{-- Import from Excel --}}
                <div class="mb-3 rounded-xl border border-indigo-100 bg-indigo-50/40 overflow-hidden">
                    <button type="button" onclick="togglePastePanel(this)"
                            class="w-full flex items-center justify-between px-4 py-2.5 text-left hover:bg-indigo-50/80 transition-colors">
                        <span class="text-xs font-semibold text-indigo-700 flex items-center space-x-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <span>Import Spesifikasi dari Excel / Tabel</span>
                        </span>
                        <svg class="w-4 h-4 text-indigo-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="paste-panel" class="hidden px-4 pb-4 border-t border-indigo-100">
                        <p class="text-xs text-gray-500 mt-3 mb-2 leading-relaxed">
                            Salin tabel dari <strong>Excel / Google Sheets</strong>, lalu tempel di sini dan klik <strong>Parse</strong>.<br>
                            • Kolom 1 = Label &nbsp;|&nbsp; Kolom 2+ = Nilai (digabung dengan " / " otomatis)<br>
                            • Jika baris hanya punya 1 kolom (tanpa nilai) → otomatis jadi <span class="text-purple-600 font-semibold">Judul Bagian</span>
                        </p>
                        <textarea id="paste-input" rows="7"
                                  placeholder="Contoh (tab-separated dari Excel):&#10;Refrigerant&#10;Type&#9;R22&#10;Control&#9;Thermostatic expansion valve&#10;Compressor&#10;Power (kw)&#9;2.7&#9;3.5&#9;4.55&#9;5.25&#10;Nominal Cooling Capacity (kcal/h)&#9;6803&#9;10449&#9;11920&#9;13091"
                                  class="w-full font-mono text-xs px-3 py-2.5 border border-indigo-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-300 bg-white resize-y"></textarea>
                        <div class="flex gap-2 mt-2">
                            <button type="button" onclick="parseAndAddSpecs()"
                                    class="inline-flex items-center space-x-1.5 px-4 py-1.5 bg-indigo-600 text-white rounded-lg text-xs font-semibold hover:bg-indigo-700 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                <span>Parse & Tambahkan</span>
                            </button>
                            <button type="button" onclick="document.getElementById('paste-input').value=''"
                                    class="px-4 py-1.5 bg-gray-100 text-gray-600 rounded-lg text-xs font-semibold hover:bg-gray-200 transition-colors">
                                Bersihkan
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Spec Rows --}}
                <div class="rounded-xl border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-4 py-2.5 border-b border-gray-200 flex items-center justify-between">
                        <p class="text-xs text-gray-500 font-medium">Baris spesifikasi</p>
                        <div class="flex items-center space-x-3">
                            <button type="button" onclick="addHeaderRow()"
                                    class="inline-flex items-center space-x-1 text-xs font-semibold text-purple-600 hover:text-purple-800 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                <span>+ Judul Bagian</span>
                            </button>
                            <span class="text-gray-300">|</span>
                            <button type="button" onclick="addSpecRow()"
                                    class="inline-flex items-center space-x-1 text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                <span>+ Baris Data</span>
                            </button>
                        </div>
                    </div>
                    <div id="spec-rows" class="divide-y divide-gray-100">
                        <div class="spec-row flex items-center gap-2 p-3">
                            <input type="hidden" name="specifications[0][is_header]" value="0">
                            <input type="text" name="specifications[0][label]" placeholder="Label (cth: Daya)"
                                   class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400">
                            <input type="text" name="specifications[0][value]" placeholder="Nilai (cth: 1000W)"
                                   class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400">
                            <button type="button" onclick="removeSpecRow(this)"
                                    class="w-8 h-8 rounded-lg flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 transition-colors flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                    <div id="spec-empty" class="hidden px-4 py-6 text-center text-sm text-gray-400">
                        Belum ada spesifikasi. Tambahkan baris atau gunakan fitur import di atas.
                    </div>
                </div>
                <p class="text-xs text-gray-400 mt-1.5">Untuk nilai multi-model, gunakan format: <code class="bg-gray-100 px-1 rounded text-gray-600">6803 / 10449 / 11920 / 13091</code></p>
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
    function categoryDropdown(initial) {
        return {
            open: false,
            selected: initial || '',
            search: '',
            select(val) { this.selected = val; this.open = false; this.search = ''; },
            matchItem(name) {
                return !this.search || name.toLowerCase().includes(this.search.toLowerCase());
            },
            matchGroup(parent, children) {
                if (!this.search) return true;
                const q = this.search.toLowerCase();
                return parent.toLowerCase().includes(q) || children.some(c => c.toLowerCase().includes(q));
            },
        };
    }

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

    function togglePastePanel(btn) {
        const panel = document.getElementById('paste-panel');
        const chevron = btn.querySelector('svg:last-child');
        panel.classList.toggle('hidden');
        chevron.style.transform = panel.classList.contains('hidden') ? '' : 'rotate(180deg)';
    }

    function parseAndAddSpecs() {
        const raw = document.getElementById('paste-input').value.trim();
        if (!raw) return;
        const lines = raw.split('\n');
        let added = 0;
        lines.forEach(line => {
            if (!line.trim()) return;
            const parts = line.split('\t');
            const label = (parts[0] || '').trim();
            if (!label) return;
            const valueParts = parts.slice(1).map(v => v.trim()).filter(v => v !== '');
            const value = valueParts.join(' / ');
            if (!value) {
                addHeaderRow(label);
            } else {
                addSpecRow(label, value);
            }
            added++;
        });
        if (added > 0) {
            document.getElementById('paste-input').value = '';
            document.getElementById('paste-panel').classList.add('hidden');
        }
    }

    function addHeaderRow(label = '') {
        const container = document.getElementById('spec-rows');
        document.getElementById('spec-empty').classList.add('hidden');
        const row = document.createElement('div');
        row.className = 'spec-row flex items-center gap-2 p-3 bg-purple-50/60';
        row.innerHTML = `
            <input type="hidden" name="specifications[${specIndex}][is_header]" value="1">
            <input type="hidden" name="specifications[${specIndex}][value]" value="">
            <span class="text-xs font-bold text-purple-500 uppercase tracking-wide whitespace-nowrap">JUDUL</span>
            <input type="text" name="specifications[${specIndex}][label]" value="${escHtml(label)}" placeholder="Nama bagian (cth: Kompresor)"
                   class="flex-1 px-3 py-2 border border-purple-200 bg-white rounded-lg text-sm font-semibold text-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500/30 focus:border-purple-400">
            <button type="button" onclick="removeSpecRow(this)"
                    class="w-8 h-8 rounded-lg flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 transition-colors flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>`;
        container.appendChild(row);
        specIndex++;
    }

    function addSpecRow(label = '', value = '') {
        const container = document.getElementById('spec-rows');
        document.getElementById('spec-empty').classList.add('hidden');
        const row = document.createElement('div');
        row.className = 'spec-row flex items-center gap-2 p-3';
        row.innerHTML = `
            <input type="hidden" name="specifications[${specIndex}][is_header]" value="0">
            <input type="text" name="specifications[${specIndex}][label]" value="${escHtml(label)}" placeholder="Label (cth: Voltase)"
                   class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400">
            <input type="text" name="specifications[${specIndex}][value]" value="${escHtml(value)}" placeholder="Nilai (cth: 220V / 380V / 415V)"
                   class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400">
            <button type="button" onclick="removeSpecRow(this)"
                    class="w-8 h-8 rounded-lg flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 transition-colors flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>`;
        container.appendChild(row);
        specIndex++;
    }

    function removeSpecRow(btn) {
        btn.closest('.spec-row').remove();
        if (document.querySelectorAll('.spec-row').length === 0) {
            document.getElementById('spec-empty').classList.remove('hidden');
        }
    }

    function escHtml(str) {
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
</script>
@endpush

@endsection
