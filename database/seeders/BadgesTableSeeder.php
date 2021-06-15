<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Badge;

class BadgesTableSeeder extends Seeder
{
    private function createBadges(array $badges)
    {
        foreach ($badges as $badge) {
            DB::table('badges')->insert([
                'label' => $badge["label"],
                'description' => $badge["description"],
                'pictogram' => $badge["pictogram"],
                'color' => $badge["color"],
                'type' => $badge["type"],
                'criterium' => $badge["criterium"],
                'badgeable_type' => $badge["badgeable_type"],
                'badgeable_id' => $badge["badgeable_id"]
            ]);
        }
    }

    private $badgesHeig = [
        // Début du badge
        [
            'label' => 'Ingénieur en herbe',
            'description' => 'Bien joué ! tu fais probablement partie des élèves présents à cette présentation. 
            Si cela se trouve, tu fais la présentation enfaite !',
            'pictogram' => "fa-compass", // icône Fontawesome
            'color' => "#ff1200", // couleur héxa du fond du badge
            'type' => 'time', // region | score | time
            'criterium' => 120, // %age des quizzes réussis dans la région | score minimal | temps maximal
            'badgeable_type' => 'App\Models\Quiz', // XXX = Region | Quiz
            'badgeable_id' => 2 // id de la Region ou du Quiz, il est affiché dans l'interface admin
        ],
        // Fin du badge
        //... suite des badges
    ];

    private $badgesBern = [
        // Début du badge
        [
            'label' => 'C\'est du grand Aar !',
            'description' => 'Tu n\'as fait qu\'une bouchée de la Capitale.',
            'pictogram' => "fa-tint", // icône Fontawesome
            'color' => "#000000", // couleur héxa du fond du badge
            'type' => 'time', // region | score | time
            'criterium' => 60, // %age des quizzes réussis dans la région | score minimal | temps maximal
            'badgeable_type' => 'App\Models\Quiz', // XXX = Region | Quiz
            'badgeable_id' => 4 // id de la Region ou du Quiz, il est affiché dans l'interface admin
        ],
        // Fin du badge
        // Début du badge
        [
            'label' => 'Salutations à Guy Parmelin !',
            'description' => 'Le Palais Fédéral est un peu ta seconde maison.',
            'pictogram' => "fa-landmark", // icône Fontawesome
            'color' => "#000000", // couleur héxa du fond du badge
            'type' => 'score', // region | score | time
            'criterium' => 80, // %age des quizzes réussis dans la région | score minimal | temps maximal
            'badgeable_type' => 'App\Models\Quiz', // XXX = Region | Quiz
            'badgeable_id' => 4 // id de la Region ou du Quiz, il est affiché dans l'interface admin
        ],
        // Fin du badge
        //... suite des badges
    ];

    private $badgesMorges = [
        [
            'label' => 'Morges c’est de l’eau',
            'description' => 'Bravo ! Morges c’est de l’eau pour toi, tu es comme un poisson dans l’océan, enfin ... le lac.',
            'pictogram' => "fa-swimmer",
            'color' => "#BF4452",
            'type' => 'region',
            'criterium' => 100,
            'badgeable_type' => 'App\Models\Region',
            'badgeable_id' => 4 // Region ID
        ],
        [
            'label' => 'Explorateur Morgiens',
            'description' => 'Bravo ! Morges n’a plus de secret pour toi ! Enfin... dans les grandes lignes.',
            'pictogram' => "fa-water",
            'color' => "#BF4452",
            'type' => 'score',
            'criterium' => 1,
            'badgeable_type' => 'App\Models\Quiz',
            'badgeable_id' => 1 // Quiz ID
        ],
        [
            'label' => 'Le podium !',
            'description' => "T'es dans les meilleurs ! D’ailleurs, je me demande si les deux autres n'ont pas trichés, parce que franchement, on sait tous que tu es le meilleur.",
            'pictogram' => "fa-podium-star",
            'color' => "#BF4452",
            'type' => 'score',
            'criterium' => 50,
            'badgeable_type' => 'App\Models\Quiz',
            'badgeable_id' => 1 // Quiz ID
        ],
        [
            'label' => "Au dessus, c'est le mont Blanc",
            'description' => "Alors toi, t'es le meilleur, le best du best, alors comme un symbole de cette ville que tu survoles, tu es une tulipe.",
            'pictogram' => "fa-flower-tulip",
            'color' => "#BF4452",
            'type' => 'time',
            'criterium' => 40,
            'badgeable_type' => 'App\Models\Quiz',
            'badgeable_id' => 1 // Quiz ID
        ],
        // Début du badge
        [
            'label' => 'la Vendange des Siths',
            'description' => 'Morges et principalement ses vignes (évidemment) n\'ont plus de secret pour toi',
            'pictogram' => "fa-wine-glass-alt", // icône Fontawesome
            'color' => "#BF4452", // couleur héxa du fond du badge
            'type' => 'score', // region | score | time
            'criterium' => 150, // %age des quizzes réussis dans la région | score minimal | temps maximal
            'badgeable_type' => 'App\Models\Quiz', // XXX = Region | Quiz
            'badgeable_id' => 3 // id de la Region ou du Quiz, il est affiché dans l'interface admin
        ],
        [
            'label' => 'Aventurier de l\'Ouest',
            'description' => "Les côtes de Morges n'ont presque plus de secrets pour toi !",
            'pictogram' => "fa-ship", // icône Fontawesome
            'color' => "#BF4452", // couleur héxa du fond du badge
            'type' => 'score', // region | score | time
            'criterium' => 200, // %age des quizzes réussis dans la région | score minimal | temps maximal
            'badgeable_type' => 'App\Models\Quiz', // XXX = Region | Quiz
            'badgeable_id' => 2 // id de la Region ou du Quiz, il est affiché dans l'interface admin
        ],
        // Fin du badge
    ];

    /**
     * Creates 15 badges
     *
     * @return void
     */
    public function run()
    {
        DB::table('badges')->delete();

        $this->createBadges($this->badgesBern); // 2 badges
        $this->createBadges($this->badgesMorges); // 4 badges
        $this->createBadges($this->badgesHeig); // 1 badge

        // Total : 6 badges
    }
}
