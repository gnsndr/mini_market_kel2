<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data produk untuk cabang 1
        DB::table('products')->insert([
            'branch_id' => 1,
            'name' => 'Produk Cabang 1 - A',
            'description' => 'Deskripsi produk A di cabang 1',
            'price' => 10000,
            'stock' => 10, // Tambahkan nilai stock di sini
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Product::create([
        //     'branch_id' => 1,
        //     'name' => 'Produk Cabang 1 - B',
        //     'description' => 'Deskripsi produk B di cabang 1',
        //     'price' => 15000,
        // ]);

        // // Contoh data produk untuk cabang 2
        // Product::create([
        //     'branch_id' => 2,
        //     'name' => 'Produk Cabang 2 - A',
        //     'description' => 'Deskripsi produk A di cabang 2',
        //     'price' => 12000,
        // ]);

        // Product::create([
        //     'branch_id' => 2,
        //     'name' => 'Produk Cabang 2 - B',
        //     'description' => 'Deskripsi produk B di cabang 2',
        //     'price' => 18000,
        // ]);

        // Anda dapat menambahkan lebih banyak data untuk cabang lain
    }
}
