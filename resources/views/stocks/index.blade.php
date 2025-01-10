@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Manajemen Stok - Cabang {{ $branch->location }}</h1>

    <!-- Tombol Tambah Stok -->
    <a href="{{ route('stocks.create', $branch->id) }}" class="mb-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
        Tambah Stok
    </a>

    <!-- Tabel Data Stok -->
    <table class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">#</th>
                <th class="px-4 py-2 text-left">Nama Barang</th>
                <th class="px-4 py-2 text-left">Jumlah</th>
                <th class="px-4 py-2 text-left">Tipe</th>
                <th class="px-4 py-2 text-left">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($branch->stocks as $stock)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $stock->product->name }}</td>
                <td class="px-4 py-2">{{ $stock->quantity }}</td>
                <td class="px-4 py-2">
                    {{ $stock->type == 'in' ? 'Masuk' : 'Keluar' }}
                </td>
                <td class="px-4 py-2">{{ $stock->created_at->format('d-m-Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-2 text-center text-gray-500">Belum ada data stok untuk cabang ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
