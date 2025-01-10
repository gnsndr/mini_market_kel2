<?php 
namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index($branchId)
    {
        $branch = Branch::with('stocks.product')->findOrFail($branchId);
        return view('stocks.index', compact('branch'));
    }

    public function create($branchId)
{
    // Ambil data branch berdasarkan ID
    $branch = Branch::findOrFail($branchId);

    // Ambil daftar produk yang tersedia
    $products = Product::where('branch_id', $branchId)->get();

    // Kirim data ke view
    return view('stocks.create', compact('branch', 'products'));
}


    public function store(Request $request, $branchId)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $branch = Branch::findOrFail($branchId);

        // Tambahkan atau update stok
        $stock = $branch->stocks()->where('product_id', $request->product_id)->first();
        if ($stock) {
            $stock->update([
                'quantity' => $stock->quantity + $request->quantity,
            ]);
        } else {
            $branch->stocks()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('stocks.index', $branchId)
            ->with('success', 'Stok berhasil diperbarui.');
    }

    public function edit($branchId, $stockId)
    {
        $stock = Stock::findOrFail($stockId);
        $branch = Branch::findOrFail($branchId);
        $products = Product::all();
        return view('stocks.edit', compact('branch', 'stock', 'products'));
    }

    public function update(Request $request, $branchId, $stockId)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $stock = Stock::findOrFail($stockId);
        $branch = Branch::findOrFail($branchId);

        $stock->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('stocks.index', $branchId)
            ->with('success', 'Stok berhasil diperbarui.');
    }

    public function destroy($branchId, $stockId)
    {
        $stock = Stock::findOrFail($stockId);
        $branch = Branch::findOrFail($branchId);

        $stock->delete();

        return redirect()->route('stocks.index', $branchId)
            ->with('success', 'Stok berhasil dihapus.');
    }
}
