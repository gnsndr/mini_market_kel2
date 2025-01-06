@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Manajemen Stok - {{ $branch->name }}</h1>
    <a href="#" class="mb-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah Stok</a>

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
            @foreach($branch->stocks as $stock)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $stock->product->name }}</td>
                <td class="px-4 py-2">{{ $stock->quantity }}</td>
                <td class="px-4 py-2">
                    {{ $stock->type == 'in' ? 'Masuk' : 'Keluar' }}
                </td>
                <td class="px-4 py-2">{{ $stock->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
