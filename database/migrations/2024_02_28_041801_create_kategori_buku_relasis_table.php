<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori_buku_relasis', function (Blueprint $table) {
            $table->id('kategori_bukuid');
            $table->unsignedBigInteger('bukuid');
            $table->unsignedBigInteger('kategoriid');
            $table->foreign('bukuid')->references('bukuid')->on('bukus');
            $table->foreign('kategoriid')->references('kategoriid')->on('kategori_bukus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_buku_relasis');
    }
};
