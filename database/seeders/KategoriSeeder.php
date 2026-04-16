<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\User;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_kategori' => 'Sastra & Novel'],
            ['nama_kategori' => 'Sains & Matematika'],
            ['nama_kategori' => 'Teknologi & Komputer'],
            ['nama_kategori' => 'Bisnis & Ekonomi'],
            ['nama_kategori' => 'Pengembangan Diri'],
            ['nama_kategori' => 'Sejarah & Budaya'],
            ['nama_kategori' => 'Seni & Desain'],
            ['nama_kategori' => 'Kesehatan & Olahraga'],
            ['nama_kategori' => 'Kuliner'],
            ['nama_kategori' => 'Pendidikan'],
            ['nama_kategori' => 'Agama & Spiritual'],
            ['nama_kategori' => 'Hukum & Politik'],
            ['nama_kategori' => 'Fiksi Ilmiah'],
            ['nama_kategori' => 'Biografi'],
            ['nama_kategori' => 'Komik & Manga'],
            ['nama_kategori' => 'Travel & Geografi'],
            ['nama_kategori' => 'Parenting'],
            ['nama_kategori' => 'Psikologi'],
            ['nama_kategori' => 'Hobi & Kerajinan'],
            ['nama_kategori' => 'Otomotif'],
        ];

        // Golek user pertama, nek raono default nang ID 1
        $user = User::first();
        $userId = $user ? $user->id : 1;

        foreach ($data as $val) {
            // Nganggo updateOrCreate ben ra duplikat nek dijalankan ping pindho
            // Set user_id dadi null ben dadi kategori global (bisa dinggo kabeh user)
            Kategori::updateOrCreate(
                ['nama_kategori' => $val['nama_kategori']],
                ['user_id' => null]
            );
        }
    }
}