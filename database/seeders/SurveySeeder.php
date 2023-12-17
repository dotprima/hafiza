<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Survey;
use Faker\Factory as Faker;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $users = User::all();

        foreach ($users as $user) {
            Survey::create([
                'user_id' => $user->id,
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
            ]);
        }
    }
}
