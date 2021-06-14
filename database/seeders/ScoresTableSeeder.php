<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScoresTableSeeder extends Seeder
{
    private function randDate() {
        $nbJours = rand(-2800, 0);
        return Carbon::now()->addDays($nbJours);
    }

    /**
     * Creates 50 randomly attributed scores, with a random value between 1 and 100.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scores')->delete();

        for ($i=1; $i <= 50; $i++) {
            $date = $this->randDate();
            DB::table('scores')->insert([
                'quiz_id' => rand(1,3),
                'user_id' => rand(1,5),
                'score' => rand(1, 100),
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
