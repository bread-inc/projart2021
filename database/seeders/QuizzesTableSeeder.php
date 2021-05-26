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
        for ($i = 1; $i <= 3; $i ++) {
            DB::table('quizzes')->insert([
                'title' => "Quiz N°$i",
                'description' => "Description $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                'ponderation' => rand(-10, 10),
            ]);
        }
    }
}
