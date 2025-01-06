<!-- resources/views/transactions/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-6">Tambah Transaksi</h1>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="branch_id" class="block text-sm font-medium text-gray-700">Pilih Cabang</label>
            <select name="branch_id" id="branch_id" class="w-full px-4 py-2 border rounded-md" required>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }} - {{ $branch->location }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="product_id" class="block text-sm font-medium text-gray-700">Pilih Produk</label>
            <select name="product_id" id="product_id" class="w-full px-4 py-2 border rounded-md" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} - Rp{{ number_format($product->price, 2) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" name="quantity" id="quantity" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Transaksi</button>
    </form>
</div>
@endsection
