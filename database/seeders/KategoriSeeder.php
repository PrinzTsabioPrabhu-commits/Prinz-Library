<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_kategori' => 'Mystic Theory'],
            ['nama_kategori' => 'Neural Network'],
            ['nama_kategori' => 'Genetics'],
            ['nama_kategori' => 'Deep Space'],
            ['nama_kategori' => 'Satellite Data'],
            ['nama_kategori' => 'Luxury Goods'],
            ['nama_kategori' => 'Bionic Tech'],
            ['nama_kategori' => 'Energy Source'],
        ];

        foreach ($data as $val) {
            \App\Models\Kategori::create($val);
        }
    }
}
