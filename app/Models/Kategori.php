<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import ini

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori']; // Sesuaikan dengan kolom tabel kamu

    /**
     * Relasi: Satu Kategori punya Banyak Buku (One to Many)
     */
    public function bukus(): HasMany
    {
        return $this->hasMany(Buku::class, 'kategori_id'); 
    }
}