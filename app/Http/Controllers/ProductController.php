<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Branch;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($branchId)
    {
        $branch = Branch::with('products')->findOrFail($branchId); // Memuat produk berdasarkan cabang
        return view('products.index', compact('branch'));
    }
    public function create($branchId)
{
    $branch = Branch::findOrFail($branchId);
    return view('products.create', compact('branch'));

}

public function store(Request $request, $branchId)
{
    // dd($request->all()); 
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
    ]);

    // Menyimpan produk dengan branch_id
    Product::create([
        'name' => $validated['name'],
        'price' => $validated['price'],
        'stock' => $validated['stock'],
        'branch_id' =>  $branchId, // Menyimpan branch_id yang diterima dari route
    ]);

    // dd($validated);
    return redirect()->route('products.index', $branchId)->with('success', 'Produk berhasil ditambahkan.');
}

public function edit($branchId, $productId)
{
    $branch = Branch::findOrFail($branchId);
    $product = Product::findOrFail($productId);
    return view('products.edit', compact('branch', 'product'));
}
public function update(Request $request, $branchId, $productId)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
    ]);

    $branch = Branch::findOrFail($branchId);
    $product = Product::findOrFail($productId);

    $product->update([
        'name' => $request->name,
        'price' => $request->price,
        'stock' => $request->stock,
    ]);

    return redirect()->route('products.index', $branch->id);
}
public function destroy($branchId, $productId)
{
    $branch = Branch::findOrFail($branchId);
    $product = Product::findOrFail($productId);

    $product->delete();

    return redirect()->route('products.index', $branch->id);
}


}
