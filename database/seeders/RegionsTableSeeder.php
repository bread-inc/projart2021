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
            "image" => "/images/regions/1.jpg"
        ],
        [
            "name" => "Yverdon-les-Bains",
            "center_x" => 46.7752422,
            "center_y" => 6.6205454,
            "image" => "/images/regions/2.jpg"
        ],
        [
            "name" => "Genève",
            "center_x" => 46.2050242,
            "center_y" => 6.1090692,
            "image" => "/images/regions/3.jpg"
        ],
        [
            "name" => "Morges",
            "center_x" => 46.51482933892298, 
            "center_y" => 6.4946666200118255,
            "image" => "/images/regions/4.jpg"
        ],
        [
            "name" => "Berne",
            "center_x" => 46.51482933892298, 
            "center_y" => 6.4946666200118255,
            "image" => "/images/regions/5.jpg"
        ]
    ];
    /**
     * Creates the 4 initial region with the real name, coordinates and images.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->delete();
        foreach ($this->regions as $region) {
            DB::table('regions')->insert($region);
        }
    }
}
