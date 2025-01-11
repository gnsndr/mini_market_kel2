<!-- resources/views/transactions/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-6">Daftar Transaksi</h1>

    <!-- Tambahkan tombol untuk menambah transaksi -->
    @if(auth()->user()->hasRole('Kasir') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Manajer Toko'))
    <a href="{{ route('transactions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">Tambah Transaksi</a>
@endif

    <table class="table-auto w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Cabang</th>
                <th class="px-4 py-2 border">Produk</th>
                <th class="px-4 py-2 border">Jumlah</th>
                <th class="px-4 py-2 border">Total Harga</th>
                <th class="px-4 py-2 border">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $transaction->id }}</td>
                    <td class="px-4 py-2">{{ $transaction->branch->name }}</td>
                    <td class="px-4 py-2">{{ $transaction->product->name }}</td>
                    <td class="px-4 py-2">{{ $transaction->quantity }}</td>
                    <td class="px-4 py-2">{{ number_format($transaction->total_price, 2) }}</td>
                    <td class="px-4 py-2">{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginasi -->
    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
</div>
@endsection