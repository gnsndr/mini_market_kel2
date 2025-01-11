@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Manajemen Produk - Cabang {{ $branch->location }}</h1>

    <!-- Tambah Produk Button -->
    @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Manajer Toko') || auth()->user()->hasRole('Pegawai Gudang'))
    <a href="{{ route('products.create', $branch->id) }}" class="mb-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah Produk</a> 
    @endif  

    <!-- Tabel Produk -->
    <table class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">#</th>
                <th class="px-4 py-2 text-left">Nama Produk</th>
                <th class="px-4 py-2 text-left">Harga</th>
                <th class="px-4 py-2 text-left">Stok</th>
                @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Manajer Toko') || auth()->user()->hasRole('Pegawai Gudang'))
                <th class="px-4 py-2 text-left">Aksi</th>
                @endif
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
                    @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Manajer Toko') || auth()->user()->hasRole('Pegawai Gudang'))
                    <a href="{{ route('products.edit', [$branch->id, $product->id]) }}" 
                       class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        Edit
                    </a>
                    

                    <!-- Delete Button -->
                    <form action="{{ route('products.destroy', [$branch->id, $product->id]) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Hapus
                        </button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
