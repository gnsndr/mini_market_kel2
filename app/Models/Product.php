<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price'];

    // Relasi dengan Stock
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    // Relasi dengan Transaction
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class)->withPivot('quantity');
    }
}
