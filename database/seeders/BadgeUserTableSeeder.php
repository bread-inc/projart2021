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
     * Creates 1 random assignation of each badge to 1 user.
     *
     * @return void
     */
    public function run()
    {
        DB::table('badge_user')->delete();
        for ($i=1; $i <= 8; $i++) { 
            $date = $this->randDate();
            DB::table('badge_user')->insert([
                'badge_id' => $i,
                'user_id' => rand(1, 15),
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
