<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama cabang
            $table->string('location'); // Lokasi cabang
            $table->timestamps(); // Menyimpan waktu pembuatan dan pembaruan data
        });
    }

    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
