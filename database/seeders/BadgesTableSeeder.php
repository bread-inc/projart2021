<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Badge;

class BadgesTableSeeder extends Seeder
{
    private $badge_type = ['score', 'time', 'region'];

    private function randomHexColor() {
        return "#" . substr(md5(rand()), 0, 6);
    }

    /**
     * Creates 15 badges
     *
     * @return void
     */
    public function run()
    {
        DB::table('badges')->delete();

        // #### Badges Morges ####

        // Swimmer
        DB::table('badges')->insert([
            'label' => 'Morges c’est de l’eau',
            'description' => 'Bravo ! Morges c’est de l’eau pour toi, tu es comme un poisson dans l’océan, enfin ... le lac.',
            'pictogram' => "fa-swimmer",
            'color' => "#BF4452",
            'type' => 'region',
            'criterium' => 100,
            'badgeable_type' => 'App\Models\Region',
            'badgeable_id' => 4 // Region ID
        ]);

        // Water
        DB::table('badges')->insert([
            'label' => 'Explorateur Morgiens',
            'description' => 'Bravo ! Morges n’a plus de secret pour toi ! Enfin... dans les grandes lignes.',
            'pictogram' => "fa-water",
            'color' => "#BF4452",
            'type' => 'score',
            'criterium' => 1,
            'badgeable_type' => 'App\Models\Quiz',
            'badgeable_id' => 1 // Quiz ID
        ]);

        // Podium Star
        DB::table('badges')->insert([
            'label' => 'Le podium !',
            'description' => "T'es dans les meilleurs ! D’ailleurs, je me demande si les deux autres n'ont pas trichés, parce que franchement, on sait tous que tu es le meilleur.",
            'pictogram' => "fa-podium-star",
            'color' => "#BF4452",
            'type' => 'score',
            'criterium' => 50,
            'badgeable_type' => 'App\Models\Quiz',
            'badgeable_id' => 1 // Quiz ID
        ]);

        // flower-tulip
        DB::table('badges')->insert([
            'label' => "Au dessus, c'est le mont Blanc",
            'description' => "Alors toi, t'es le meilleur, le best du best, alors comme un symbole de cette ville que tu survoles, tu es une tulipe.",
            'pictogram' => "fa-flower-tulip",
            'color' => "#BF4452",
            'type' => 'time',
            'criterium' => 40,
            'badgeable_type' => 'App\Models\Quiz',
            'badgeable_id' => 1 // Quiz ID
        ]);

        // #### random Badges ####
        for ($i = 5; $i <= 15; $i++) {
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
