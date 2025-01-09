@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Tambah Stok - Cabang{{ $branch->location }}</h1>
    <form action="{{ route('stocks.store', $branch->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="product_id" class="block text-gray-700">Pilih Produk:</label>
            <select name="product_id" id="product_id" class="w-full border rounded px-3 py-2">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="quantity" class="block text-gray-700">Jumlah:</label>
            <input type="number" name="quantity" id="quantity" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
