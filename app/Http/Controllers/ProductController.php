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
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
    ]);

    $branch = Branch::findOrFail($branchId);

    $product = new Product([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'branch_id' => $branch->id,
    ]);
    $product->save();

    return redirect()->route('products.index', $branch->id);
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
    ]);

    $branch = Branch::findOrFail($branchId);
    $product = Product::findOrFail($productId);

    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
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
