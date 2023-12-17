<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class MerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Category::create(['nama_kategori' => 'TV']);
        Category::create(['nama_kategori' => 'Lampu']);
        // Tambahkan kategori lain sesuai kebutuhan
    }
}
