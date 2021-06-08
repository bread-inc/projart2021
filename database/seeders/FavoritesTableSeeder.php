<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('favorites')->delete();

        for ($i=1; $i <= 10; $i++) {
            DB::table('favorites')->insert([
                'quiz_id' => rand(1, 5),
                'user_id' => rand(1, 5),
            ]);
        }
    }
}