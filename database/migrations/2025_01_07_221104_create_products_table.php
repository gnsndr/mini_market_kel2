<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id'); // Foreign key untuk cabang
            $table->string('name'); // Nama produk
            $table->text('description')->nullable(); 
            $table->integer('stock');
            $table->decimal('price', 10, 2); // Harga produk
            $table->timestamps();

            // Tambahkan relasi ke tabel branches
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
