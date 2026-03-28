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
            $table->id();
            $table->string('judul');            // Judul buku
            $table->string('penulis');          // Nama penulis
            $table->string('penerbit')->nullable(); // Penerbit (nullable = boleh kosong)
            $table->integer('tahun_terbit');    // Tahun buku rilis
            $table->text('deskripsi')->nullable();  // Sinopsis singkat
            $table->integer('stok')->default(1);    // Jumlah buku yang tersedia
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
