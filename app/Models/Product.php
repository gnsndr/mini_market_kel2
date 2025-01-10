<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'stock', 'branch_id'];

    public function branch()
{
    return $this->belongsTo(Branch::class);
}


    // Relasi historis dengan Stock (jika Stock mencatat perubahan stok)
    public function stockHistories()
    {
        return $this->hasMany(Stock::class);
    }

    // Relasi dengan Transaction
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Kurangi stok produk.
     *
     * @param int $quantity
     * @throws \Exception Jika stok tidak mencukupi
     */
    public function reduceStock(int $quantity)
    {
        if ($this->stock < $quantity) {
            throw new \Exception('Stok tidak mencukupi untuk produk ' . $this->name);
        }

        $this->decrement('stock', $quantity);
    }

    /**
     * Tambahkan stok produk.
     *
     * @param int $quantity
     */
    public function addStock(int $quantity)
    {
        $this->increment('stock', $quantity);
    }
}
