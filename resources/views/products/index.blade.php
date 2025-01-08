@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Manajemen Produk - {{ $branch->name }}</h1>

    <!-- Tambah Produk Button -->
    <a href="{{ route('products.create', $branch->id) }}" class="mb-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah Produk</a>

    <!-- Tabel Produk -->
    <table class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">#</th>
                <th class="px-4 py-2 text-left">Nama Produk</th>
                <th class="px-4 py-2 text-left">Harga</th>
                <th class="px-4 py-2 text-left">Stok</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($branch->products as $product)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $product->name }}</td>
                <td class="px-4 py-2">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="px-4 py-2">{{ $product->stock }}</td> <!-- Tampilkan Stok -->
                <td class="px-4 py-2">
                    <!-- Edit Button -->
                    <a href="{{ route('products.edit', [$branch->id, $product->id]) }}" class="text-yellow-500 hover:underline">Edit</a>

                    <!-- Delete Button -->
                    <form action="{{ route('products.destroy', [$branch->id, $product->id]) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
