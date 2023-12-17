<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SurveyQuestion;
use App\Models\SurveyAnswer;
use App\Models\Survey;
use App\Models\User;
use Faker\Factory as Faker;

class SurveyAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $surveys = User::all();

        for($i = 0;$i<10;$i++) {
            $randomSurvey = $surveys->random(); // Ambil satu survei secara acak

            SurveyAnswer::create([
                'user_id' => $randomSurvey->id,
                'electric_id' => 1,
                'watt' => 10,
                'pemakaian' => 5,
            ]);
        }
    }
}
