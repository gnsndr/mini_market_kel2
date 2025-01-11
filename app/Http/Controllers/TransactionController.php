<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Stock;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan importnya benar

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['branch', 'product'])->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $branches = Branch::all();
        $products = Product::all();
        return view('transactions.create', compact('branches', 'products'));
    }

    public function store(Request $request)
    {
        // Validasi input transaksi
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil cabang dan produk
        $branch = Branch::findOrFail($request->branch_id);
        $product = Product::findOrFail($request->product_id);

        // Ambil stok untuk cabang dan produk
        $stock = Stock::where('branch_id', $branch->id)
                      ->where('product_id', $product->id)
                      ->first();

        if ($stock && $stock->quantity >= $request->quantity) {
            // Kurangi stok dan simpan transaksi
            $stock->quantity -= $request->quantity;
            $stock->save();

            // Hitung total harga
            $totalPrice = $product->price * $request->quantity;

            // Simpan transaksi
            Transaction::create([
                'branch_id' => $branch->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'total_price' => $totalPrice,
            ]);

            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil.');
        } else {
            return redirect()->back()->with('error', 'Stok tidak cukup.');
        }
    }

    public function report()
    {
        $transactions = Transaction::with(['branch', 'product'])->get();
        $totalRevenue = $transactions->sum('total_price');

        return view('transactions.report', compact('transactions', 'totalRevenue'));
    }

    public function printReport()
    {
        try {
            $transactions = Transaction::with(['branch', 'product'])->get();
            $totalRevenue = $transactions->sum('total_price');

            // Generate PDF
            $pdf = Pdf::loadView('transactions.report_pdf', compact('transactions', 'totalRevenue'));

            // Return the PDF as a download
            return $pdf->download('laporan_transaksi.pdf');
        } catch (\Exception $e) {
            // If error occurs
            return redirect()->route('transactions.index')->with('error', 'Terjadi kesalahan saat mencetak laporan: ' . $e->getMessage());
        }
    }
    
   
}
