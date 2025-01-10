@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Produk - Cabang {{ $branch->location }}</h1>

    <!-- Form Edit Produk -->
    <form action="{{ route('products.update', [$branch->id, $product->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Harga Produk</label>
            <input type="number" id="price" name="price" value="{{ $product->price }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="stock" class="block text-sm font-medium text-gray-700">Stok Produk</label>
            <input type="number" id="stock" name="stock" value="{{ $product->stock }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm" required>
        </div>

        <button type="submit" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Perbarui Produk
        </button>
    </form>
</div>
@endsection
