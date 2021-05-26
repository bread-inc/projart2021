<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scores')->delete();

        for ($i=1; $i <= 5; $i++) { 
            DB::table('scores')->insert([
                'quiz_id' => $i,
                'user_id' => 1,
                'score' => rand(15, 150),
            ]);
            
            DB::table('scores')->insert([
                'quiz_id' => $i,
                'user_id' => 2,
                'score' => rand(15, 150),
            ]);
        }
    }
}
