<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Hapus kolom 'kategori' ATAU 'kategori_id' jika sudah ada (biar tidak bentrok)
        Schema::table('bukus', function (Blueprint $table) {
            if (Schema::hasColumn('bukus', 'kategori')) {
                $table->dropColumn('kategori');
            }
            if (Schema::hasColumn('bukus', 'kategori_id')) {
                $table->dropColumn('kategori_id');
            }
        });

        // 2. Buat kolom 'kategori_id' yang benar-benar baru dengan tipe BigInteger
        Schema::table('bukus', function (Blueprint $table) {
            $table->foreignId('kategori_id')
                  ->nullable()
                  ->after('penerbit')
                  ->constrained('kategoris')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
            $table->string('kategori')->nullable();
        });
    }
};