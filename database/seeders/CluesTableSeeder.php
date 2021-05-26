<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CluesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clues')->delete();
        for ($i = 1; $i <= 45; $i++) {
            DB::table('clues')->insert([
                'question_id' => rand(1,10),
                'radius' => rand(1, 1000),
                'description' => "Description $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            ]);
        }
    }
}
