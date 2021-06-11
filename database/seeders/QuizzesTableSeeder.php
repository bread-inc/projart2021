<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizzesTableSeeder extends Seeder
{
    /**
     * Creates 5 random quizzes
     *
     * @return void
     */
    public function run()
    {
        DB::table('quizzes')->delete();

        // Quiz Morges - ID : 1
        DB::table('quizzes')->insert([
            'region_id' => 4,
            'user_id' => 1,
            'title' => "La ville de Morges",
            'description' => "Morges est une commune suisse du canton de Vaud, située au bord du Léman. Découvrez ces trésors cachés !",
            'difficulty' => 3,
        ]);

        for ($i = 2; $i <= 5; $i ++) {
            DB::table('quizzes')->insert([
                'region_id' => rand(1,3),
                'user_id' => rand(1,5),
                'title' => "Quiz N°$i",
                'description' => "Description $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                'difficulty' => rand(1, 3),
            ]);
        }
    }
}
