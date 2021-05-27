<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgeUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('badge_user')->delete();
        for ($i=1; $i < 15; $i++) { 
            DB::table('badge_user')->insert([
                'badge_id' => $i,
                'user_id' => 1
            ]);
            DB::table('badge_user')->insert([
                'badge_id' => $i,
                'user_id' => 2
            ]);
        }
    }
}
