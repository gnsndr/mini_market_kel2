@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Cabang: {{ $branch->name }}</h1>
    <p class="text-gray-600 mb-6">Lokasi: {{ $branch->city }}, {{ $branch->address }}</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('products.index', $branch->id) }}" 
           class="block p-6 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600">
            Manajemen Produk
        </a>
        <a href="{{ route('stocks.index', $branch->id) }}" 
           class="block p-6 bg-yellow-500 text-white rounded-lg shadow-md hover:bg-yellow-600">
            Manajemen Stok
        </a>
        <a href="{{ route('transactions.index', $branch->id) }}" 
           class="block p-6 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600">
            Transaksi Penjualan
        </a>
        <a href="{{ route('reports.index', $branch->id) }}" 
           class="block p-6 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600">
            Laporan
        </a>
    </div>
</div>
@endsection
