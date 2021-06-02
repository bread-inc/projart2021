<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Badge;

class BadgesTableSeeder extends Seeder
{
    // Example tag : <i class="fas {{css-class}}"></i>

    private $badge_type = ['score', 'time', 'region'];

    private function randomHexColor() {
        return "#" . substr(md5(rand()), 0, 6);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('badges')->delete();
        for ($i = 1; $i <= 15; $i++) {
            DB::table('badges')->insert([
                'label' => 'Badge'.$i,
                'description' => 'Lorem ipsum dolor amet decanta'.$i,
                'pictogram' => Badge::PICTOGRAMS[rand(0, sizeof(Badge::PICTOGRAMS)-1)],
                'color' => $this->randomHexColor(),
                'type' => $this->badge_type[rand(0, 2)],
                'criterium' => rand(1, 100),
                'badgeable_type' => $i % 2 == 0 ? 'App\Models\Region' : 'App\Models\Quiz',
                'badgeable_id' => rand(1, 3)
            ]);
        }
    }
}
