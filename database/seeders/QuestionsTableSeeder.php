<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->delete();
        for ($i = 1; $i <= 15; $i++) {
            $quiz_id = rand(1,5);
            DB::table('questions')->insert([
                'quiz_id' => $quiz_id,
                'picture' => "/images/questions/Q$quiz_id" . "Q$i.jpg",
                'coord_x' => rand(1, 1000),
                'coord_y' => rand(1, 1000),
                'radius' => rand(10, 100),
                'description' => "Description $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            ]);
        }
    }
}
