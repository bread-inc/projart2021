<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
{
    private $regions = [
        [
            "name" => "Neuchâtel",
            "center_x" => 46.9958656,
            "center_y" => 6.9335267,
        ],
        [
            "name" => "Yverdon-les-Bains",
            "center_x" => 46.7752422,
            "center_y" => 6.6205454,
        ],
        [
            "name" => "Genève",
            "center_x" => 46.2050242,
            "center_y" => 6.1090692,
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quizzes')->delete();
        foreach ($this->regions as $region) {
            DB::table('regions')->insert($region);
        }
    }
}
