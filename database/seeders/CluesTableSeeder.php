<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CluesTableSeeder extends Seeder
{
    /**
     * Creates 45 questions, randomly attributed
     *
     * @return void
     */
    public function run()
    {
        DB::table('clues')->delete();
        for ($i = 1; $i <= 45; $i++) {
            DB::table('clues')->insert([
                'question_id' => rand(1,15),
                'radius' => rand(1, 1000),
                'description' => "Description $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            ]);
        }
    }
}
