<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Electric;
class ElectricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Electric::create([
            'nama_electric' => 'Smart TV 55"',
            'id_merek' => 1, // ID merek sesuai dengan yang telah di-seed pada MerekSeeder
            'id_kategori' => 1, // ID kategori sesuai dengan yang telah di-seed pada CategorySeeder
        ]);

        Electric::create([
            'nama_electric' => 'Table Lamp',
            'id_merek' => 2,
            'id_kategori' => 2,
        ]);

        // Tambahkan data electric lain sesuai kebutuhan
    }
}
