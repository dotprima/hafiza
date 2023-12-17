<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MerekSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ElectricSeeder::class);
        $this->call([
            UserSeeder::class,
            SurveySeeder::class,
            SurveyQuestionSeeder::class,
            SurveyAnswerSeeder::class,
        ]);
    }
}
