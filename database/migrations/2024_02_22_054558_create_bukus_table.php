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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id('bukuid');
            $table->string('judul_buku');
            $table->string('penulis');
            $table->string('penerbit');
            $table->integer('tahun_terbit');
            $table->longText('cover')->default('NONE');
            $table->enum('status',['dipinjam','tersedia'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
