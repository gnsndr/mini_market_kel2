<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    public function up()
{
    Schema::create('stocks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained();  // Menghubungkan ke produk
        $table->foreignId('branch_id')->constrained();  // Menghubungkan ke cabang
        $table->integer('quantity');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
