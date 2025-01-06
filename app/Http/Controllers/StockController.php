<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    // Menampilkan daftar stok untuk setiap cabang
    public function index($branchId)
    {
        // Ambil data cabang dengan stok terkait
        $branch = Branch::with('stocks.product')->findOrFail($branchId);

        // Menampilkan view dengan data cabang dan stok
        return view('stocks.index', compact('branch'));
    }

    // Menambahkan stok baru
    public function store(Request $request, $branchId)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil cabang berdasarkan ID
        $branch = Branch::findOrFail($branchId);

        // Menambahkan stok untuk cabang ini
        $branch->stocks()->create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        // Redirect atau kembalikan respons setelah berhasil
        return redirect()->route('stocks.index', $branchId)
            ->with('success', 'Stok berhasil ditambahkan.');
    }

    // Mengedit stok
    public function edit($branchId, $stockId)
    {
        // Ambil data stok berdasarkan ID
        $stock = Stock::findOrFail($stockId);
        $branch = Branch::findOrFail($branchId);
        $products = Product::all();

        // Tampilkan form edit stok
        return view('stocks.edit', compact('branch', 'stock', 'products'));
    }

    // Memperbarui stok
    public function update(Request $request, $branchId, $stockId)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil data stok dan cabang
        $stock = Stock::findOrFail($stockId);
        $branch = Branch::findOrFail($branchId);

        // Update stok
        $stock->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        // Redirect ke halaman stok
        return redirect()->route('stocks.index', $branchId)
            ->with('success', 'Stok berhasil diperbarui.');
    }

    // Menghapus stok
    public function destroy($branchId, $stockId)
    {
        // Ambil data stok dan cabang
        $stock = Stock::findOrFail($stockId);
        $branch = Branch::findOrFail($branchId);

        // Hapus stok
        $stock->delete();

        // Redirect ke halaman stok
        return redirect()->route('stocks.index', $branchId)
            ->with('success', 'Stok berhasil dihapus.');
    }
}
