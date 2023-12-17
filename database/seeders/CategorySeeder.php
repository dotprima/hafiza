<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Merek;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Merek::create(['nama_merek' => 'Samsung']);
        Merek::create(['nama_merek' => 'LG']);
        // Tambahkan merek lain sesuai kebutuhan
    }
}
