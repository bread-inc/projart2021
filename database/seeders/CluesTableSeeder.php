<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CluesTableSeeder extends Seeder
{
    private $morgesClues = [
        // Q1
        [
            ["radius" => 1000, "description" => "Un peu de sport, ça vous dit ?"],
            ["radius" => 500, "description" => "À défaut d’être l’alpha et l’Omega, je suis voisin d’un delta."],
            ["radius" => 100, "description" => "Pour piquer une tête, vous êtes plutôt plage ou piscine ?"]            
        ],
        // Q2
        [
            ["radius" => 1000, "description" => "Il m’est d’avis que vous devriez vous recentrer."],
            ["radius" => 300, "description" => "Guettez mes hauteurs."],
            ["radius" => 150, "description" => "Entre le château et l’église trône."]
        ],
        // Q3
        [
            ["radius" => 1000, "description" => "Seuls les piétons pourrons m’atteindre."],
            ["radius" => 500, "description" => "Mon bâtiment d’époque fait face au marché chaque samedi."],
            ["radius" => 100, "description" => "Si la fatigue vous prenait, asseyez-vous donc sur ce banc, face à la fontaine..."]
        ],
        // Q4
        [
            ["radius" => 1000, "description" => "Une nature abondante m’entoure."],
            ["radius" => 500, "description" => "Sur le chemin des amoureux du bord du lac vous me trouverez."],
            ["radius" => 100, "description" => "Gardé par un château, je me sens en sécurité."]
        ],
        // Q5
        [
            ["radius" => 1000, "description" => "De mes 4 tours, je garde les flots."],
            ["radius" => 500, "description" => "Parmi les nombreux ports Morgiens, le second est probablement le mieux gardé."],
            ["radius" => 100, "description" => "La vue de tulipes ne me laisse pas indifférent."]
        ],
        // Q6
        [
            ["radius" => 1000, "description" => "Levez les yeux, mes hauteurs vous appellent."],
            ["radius" => 500, "description" => "Chaque heure je sonne, tel un compas sonore."],
            ["radius" => 100, "description" => "Gardez la foi, vous êtes proche !"]
        ],
        // Q7
        [
            ["radius" => 1000, "description" => "Aux abords du lac je me situe."],
            ["radius" => 500, "description" => "Au centre des quais je suis."],
            ["radius" => 100, "description" => "Suivez les bateaux, vous me trouverez !"]
        ],
    ];

    /**
     * Creates 45 questions, randomly attributed
     *
     * @return void
     */
    public function run()
    {
        DB::table('clues')->delete();

        // #### Clues for Morges Questions (ids: 1-7) ###
        for ($i=0; $i < 7 ; $i++) { 
            foreach ($this->morgesClues[$i] as $clue) {
                DB::table('clues')->insert([
                    'question_id' => $i+1,
                    'radius' => $clue["radius"],
                    'description' => $clue["description"],
                ]);
            }
        }

        // #### random Clues ####
        for ($i = 22; $i <= 45; $i++) {
            DB::table('clues')->insert([
                'question_id' => rand(8,15),
                'radius' => rand(1, 1000),
                'description' => "Description $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            ]);
        }
    }
}
