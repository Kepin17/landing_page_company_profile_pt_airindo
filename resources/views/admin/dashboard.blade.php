@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview data produk Anda')

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center space-x-5">
        <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Total Produk</p>
            <p class="text-3xl font-extrabold text-gray-900 mt-0.5">{{ $totalProducts }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center space-x-5">
        <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Produk Aktif</p>
            <p class="text-3xl font-extrabold text-gray-900 mt-0.5">{{ $activeProducts }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center space-x-5">
        <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Produk Nonaktif</p>
            <p class="text-3xl font-extrabold text-gray-900 mt-0.5">{{ $inactiveProducts }}</p>
        </div>
    </div>
</div>

{{-- Latest Products Table --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-gray-900">Produk Terbaru</h2>
            <p class="text-xs text-gray-500 mt-0.5">5 produk terakhir yang ditambahkan</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
           class="inline-flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded-xl font-semibold text-sm hover:bg-blue-700 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Produk</span>
        </a>
    </div>

    @if($latestProducts->isEmpty())
        <div class="py-16 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <p class="text-gray-500 font-medium">Belum ada produk</p>
            <a href="{{ route('admin.products.create') }}" class="inline-block mt-3 text-sm text-blue-600 hover:underline font-medium">
                Tambah produk sekarang →
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50/80">
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Shopee</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tokopedia</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($latestProducts as $product)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                             class="w-full h-full object-cover"
                                             onerror="this.src='https://placehold.co/40x40/e2e8f0/64748b?text=?'">
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 text-sm">{{ Str::limit($product->name, 30) }}</p>
                                        <p class="text-gray-400 text-xs">{{ $product->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($product->is_active)
                                    <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-full border border-green-100">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                        <span>Aktif</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 bg-gray-100 text-gray-500 text-xs font-semibold rounded-full border border-gray-200">
                                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>
                                        <span>Nonaktif</span>
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($product->shopee_link)
                                    <span class="inline-flex items-center px-2 py-1 bg-orange-100 text-orange-600 text-xs font-semibold rounded-lg">✓ Ada</span>
                                @else
                                    <span class="text-gray-300 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($product->tokopedia_link)
                                    <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-600 text-xs font-semibold rounded-lg">✓ Ada</span>
                                @else
                                    <span class="text-gray-300 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-xs">{{ $product->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="text-blue-600 hover:text-blue-700 font-medium text-xs hover:underline">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100">
            <a href="{{ route('admin.products.index') }}" class="text-sm text-blue-600 hover:underline font-medium">
                Lihat semua produk →
            </a>
        </div>
    @endif
</div>

@endsection
