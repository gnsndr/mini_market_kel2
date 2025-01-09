<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'product_id', 'quantity', 'type']; // Tambahkan kolom 'type' untuk mencatat jenis (masuk/keluar)

    // Relasi dengan Branch
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Relasi dengan Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Catat histori stok.
     *
     * @param int $productId
     * @param int $branchId
     * @param int $quantity
     * @param string $type ('in' atau 'out')
     */
    public static function recordStockHistory(int $productId, int $branchId, int $quantity, string $type)
    {
        self::create([
            'product_id' => $productId,
            'branch_id' => $branchId,
            'quantity' => $quantity,
            'type' => $type,
        ]);
    }
}
