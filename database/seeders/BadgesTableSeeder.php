<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('badges')->delete();
        for ($i = 1; $i <= 15; $i++) {
            DB::table('badges')->insert([
                'label' => 'Badge'.$i,
                'description' => 'Lorem ipsum dolor amet decanta'.$i,
                'pictogram' => 'url/vers/le/badge'.$i,
                'color' => 'Rouge',
                'type' => 'score',
                'criterium' => 'criterium'.$i,
                'badgeable_type' => $i % 2 == 0 ? 'Region' : 'Quiz',
                'badgeable_id' => rand(0, 3)
            ]);
        }
    }
}
