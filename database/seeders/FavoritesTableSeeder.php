<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Creates 8 random assignations of quizzes to users, as favorites
     *
     * @return void
     */

    public function run()
    {
        DB::table('favorites')->delete();

        for ($i=1; $i <= 8; $i++) {
            DB::table('favorites')->insert([
                'quiz_id' => $i,
                'user_id' => rand(1, 15),
            ]);
        }
    }
}
