<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use Faker\Factory as Faker;

class SurveyQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $surveys = Survey::all();

        foreach ($surveys as $survey) {
            SurveyQuestion::create([
                'question' => $faker->sentence,
            ]);
        }
    }
}
