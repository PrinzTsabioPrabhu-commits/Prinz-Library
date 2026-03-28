<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import ini

class Buku extends Model
{
    protected $table = 'bukus';

    protected $fillable = [
        'judul', 
        'penulis', 
        'penerbit', 
        'kategori_id', // <--- GANTI 'kategori' jadi 'kategori_id'
        'tahun_terbit', 
        'deskripsi', 
        'stok', 
        'image_url',
        'user_id'
    ];

    /**
     * RELASI: Buku ini milik sebuah Kategori
     * Ini yang bikin kamu bisa panggil $buku->kategori->nama di Blade
     */
   // app/Models/Buku.php

    public function kategori()
    {
        // Pastikan foreign key-nya 'kategori_id'
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    /**
     * RELASI: Buku ini milik seorang User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}