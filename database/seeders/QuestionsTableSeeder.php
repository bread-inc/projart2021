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
            DB::table('questions')->insert([
                'quiz_id' => rand(1,5),
                'picture' => "/img/img$i.jpg",
                'coord_x' => rand(1, 1000),
                'coord_y' => rand(1, 1000),
                'radius' => 1000,
                'description' => "Description $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            ]);
        }
    }
}
