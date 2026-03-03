@extends('layouts.admin')

@section('title', 'Manajemen Produk')
@section('page-title', 'Manajemen Produk')
@section('page-subtitle', 'Kelola semua produk perusahaan')

@section('content')

{{-- Header Actions --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div class="text-sm text-gray-500">
        Menampilkan <span class="font-semibold text-gray-700">{{ $products->firstItem() }}–{{ $products->lastItem() }}</span>
        dari <span class="font-semibold text-gray-700">{{ $products->total() }}</span> produk
    </div>
    <a href="{{ route('admin.products.create') }}"
       class="inline-flex items-center space-x-2 px-5 py-2.5 bg-blue-600 text-white rounded-xl font-semibold text-sm hover:bg-blue-700 transition-colors shadow-sm hover:shadow-md">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        <span>Tambah Produk</span>
    </a>
</div>

{{-- Products Table --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    @if($products->isEmpty())
        <div class="py-20 text-center">
            <div class="w-20 h-20 bg-gray-100 rounded-3xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-700 mb-2">Belum Ada Produk</h3>
            <p class="text-gray-400 text-sm mb-6">Mulai dengan menambahkan produk pertama Anda.</p>
            <a href="{{ route('admin.products.create') }}"
               class="inline-flex items-center space-x-2 px-6 py-2.5 bg-blue-600 text-white rounded-xl font-semibold text-sm hover:bg-blue-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Produk Pertama</span>
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[700px]">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-10">#</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Marketplace</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Dibuat</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($products as $i => $product)
                        <tr class="hover:bg-blue-50/30 transition-colors group">

                            {{-- Row number --}}
                            <td class="px-6 py-4 text-gray-400 text-xs font-medium">
                                {{ $products->firstItem() + $i }}
                            </td>

                            {{-- Product Info --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0 border border-gray-100">
                                        <img src="{{ $product->image_url }}"
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover"
                                             onerror="this.src='https://placehold.co/48x48/e2e8f0/64748b?text=?'">
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-gray-900 truncate max-w-[200px]" title="{{ $product->name }}">
                                            {{ $product->name }}
                                        </p>
                                        <p class="text-gray-400 text-xs mt-0.5 truncate max-w-[200px]">{{ $product->slug }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Marketplace --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    @if($product->shopee_link)
                                        <span class="inline-flex items-center px-2.5 py-1 bg-orange-50 text-orange-600 border border-orange-100 text-xs font-semibold rounded-lg">
                                            Shopee
                                        </span>
                                    @endif
                                    @if($product->tokopedia_link)
                                        <span class="inline-flex items-center px-2.5 py-1 bg-green-50 text-green-600 border border-green-100 text-xs font-semibold rounded-lg">
                                            Tokopedia
                                        </span>
                                    @endif
                                    @if(!$product->shopee_link && !$product->tokopedia_link)
                                        <span class="text-gray-300 text-xs">Belum ada link</span>
                                    @endif
                                </div>
                            </td>

                            {{-- Status toggle --}}
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('admin.products.toggle', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full text-xs font-semibold transition-all cursor-pointer
                                                {{ $product->is_active
                                                    ? 'bg-green-50 text-green-700 border border-green-200 hover:bg-green-100'
                                                    : 'bg-gray-100 text-gray-500 border border-gray-200 hover:bg-gray-200' }}"
                                            title="Klik untuk {{ $product->is_active ? 'menonaktifkan' : 'mengaktifkan' }}">
                                        <span class="w-2 h-2 rounded-full {{ $product->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                        <span>{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                    </button>
                                </form>
                            </td>

                            {{-- Date --}}
                            <td class="px-6 py-4 text-gray-400 text-xs whitespace-nowrap">
                                {{ $product->created_at->format('d M Y') }}
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 border border-blue-100 rounded-lg text-xs font-semibold hover:bg-blue-100 transition-colors">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 border border-red-100 rounded-lg text-xs font-semibold hover:bg-red-100 transition-colors">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $products->links() }}
            </div>
        @endif
    @endif
</div>

@endsection
