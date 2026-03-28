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
    Schema::table('bukus', function (Blueprint $table) {
        // Tambahkan kolom image_url setelah kolom deskripsi
        $table->text('image_url')->nullable()->after('deskripsi');
    });
}

public function down(): void
{
    Schema::table('bukus', function (Blueprint $table) {
        $table->dropColumn('image_url');
    });
}
};
