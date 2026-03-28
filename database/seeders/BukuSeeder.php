<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Buku::create([
            'judul' => 'Laskar Pelangi',
            'penulis' => 'Andrea Hirata',
            'penerbit' => 'Bentang Pustaka',
            'tahun_terbit' => 2005,
            'deskripsi' => 'Kisah perjuangan anak-anak Belitung.',
            'stok' => 5
        ]);

        \App\Models\Buku::create([
            'judul' => 'Filosofi Teras',
            'penulis' => 'Henry Manampiring',
            'penerbit' => 'Kompas',
            'tahun_terbit' => 2018,
            'deskripsi' => 'Penerapan Stoikisme dalam kehidupan modern.',
            'stok' => 10
        ]);
    }
}
