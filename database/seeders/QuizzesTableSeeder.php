<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quizzes')->delete();
        for ($i = 1; $i <= 5; $i ++) {
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
