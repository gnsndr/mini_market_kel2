<?php 
// app/Models/Transaction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Daftar kolom yang bisa diisi
    protected $fillable = ['branch_id', 'product_id', 'quantity', 'total_price'];

    // Relasi ke Branch (cabang)
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Relasi ke Product (produk)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Untuk mendapatkan harga total transaksi (bisa digabungkan dengan method lainnya jika perlu)
    public function calculateTotalPrice()
    {
        return $this->quantity * $this->product->price;
    }
}