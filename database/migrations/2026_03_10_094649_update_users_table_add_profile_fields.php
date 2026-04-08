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
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan username
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->nullable()->after('email');
            }

            // Tambahkan bio
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable()->after('username');
            }

            // Tambahkan ROLE (Ini kunci buat benerin SECURITY_ALERT)
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('user')->after('email');
            }

            // Tambahkan profile_photo_path jika belum ada
            if (!Schema::hasColumn('users', 'profile_photo_path')) {
                $table->string('profile_photo_path', 2048)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'bio', 'role', 'profile_photo_path']);
        });
    }
};