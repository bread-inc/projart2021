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
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('badge_user')->delete();
        for ($i=1; $i < 15; $i++) { 
            $date1 = $this->randDate();
            $date2 = $this->randDate();
            DB::table('badge_user')->insert([
                'badge_id' => $i,
                'user_id' => 1,
                'created_at' => $date1,
                'updated_at' => $date1
            ]);
            DB::table('badge_user')->insert([
                'badge_id' => $i,
                'user_id' => 2,
                'created_at' => $date2,
                'updated_at' => $date2
            ]);
        }
    }
}
