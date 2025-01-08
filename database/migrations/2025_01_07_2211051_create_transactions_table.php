<?php

// database/migrations/xxxx_xx_xx_create_transactions_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->onDelete('cascade'); // Relasi ke cabang
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Relasi ke produk
            $table->integer('quantity'); // Jumlah produk yang dibeli
            $table->decimal('total_price', 10, 2); // Total harga transaksi
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
