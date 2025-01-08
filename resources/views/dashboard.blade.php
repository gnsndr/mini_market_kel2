@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
    <p class="text-gray-600 mb-4">Selamat datang, {{ auth()->user()->name }}! Pilih cabang untuk melihat detail:</p>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
        @foreach($branches as $branch)
        <a href="{{ route('branches.show', $branch->id) }}" 
           class="block p-6 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600">
            Cabang : {{ $branch->location }}
        </a>
        @endforeach
    </div>
</div>
@endsection
