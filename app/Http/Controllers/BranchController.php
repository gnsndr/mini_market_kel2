<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    // Menampilkan daftar semua cabang
    public function index()
    {
        $branches = Branch::all(); // Mengambil semua cabang dari database
        return view('dashboard', compact('branches'));
    }

    // Menampilkan detail cabang berdasarkan ID
    public function show($id)
    {
        $branch = Branch::with(['products', 'stocks.product'])->findOrFail($id); 
        // Memuat data cabang beserta produk dan stoknya
        return view('branches.show', compact('branch'));
    }
}
