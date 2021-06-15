<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Attributes 10 random quizzes between the 5 users
     *
     * @return void
     */

    public function run()
    {
        DB::table('favorites')->delete();

        for ($i=1; $i <= 10; $i++) {
            DB::table('favorites')->insert([
                'quiz_id' => rand(1, 6),
                'user_id' => rand(1, 15),
            ]);
        }
    }
}
