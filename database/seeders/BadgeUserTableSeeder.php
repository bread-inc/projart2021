<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BadgeUserTableSeeder extends Seeder
{
    private function randDate() {
        $nbJours = rand(-2800, 0);
        return Carbon::now()->addDays($nbJours);
    }

    /**
     * Creates 15 random badges attribution.
     *
     * @return void
     */
    public function run()
    {
        DB::table('badge_user')->delete();
        for ($i=1; $i <= 15; $i++) { 
            $date = $this->randDate();
            DB::table('badge_user')->insert([
                'badge_id' => rand(1, 6),
                'user_id' => rand(1, 15),
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
