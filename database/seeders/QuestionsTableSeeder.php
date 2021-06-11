<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    
    private $questionsMorges = [
        [
            'quiz_id' => 1,
            'picture' => "storage/images/questions/Q1Q1.jpg",
            'coord_x' => 46.503658,
            'coord_y' => 6.494054,
            'radius' => 20,
            'description' => "En prolongement du bord je me dresse;\n".
            "Pour laisser aux amoureux la vue sur le leman;\n".
            "À deux pas des tulipes vous me trouverez."
        ],
        [
            'quiz_id' => 1,
            'picture' => "storage/images/questions/Q1Q2.jpg",
            'coord_x' => 46.508407,
            'coord_y' => 6.498042,
            'radius' => 50,
            'description' => "Sur une place au cœur de la ville je me situe;\n".
            "Perpendiculaire à Louis de Savoie vous me trouverez;\n".
            "Observez bien ou vous pourriez me manquer."
        ],
        [
            'quiz_id' => 1,
            'picture' => "storage/images/questions/Q1Q3.jpg",
            'coord_x' => 46.509182,
            'coord_y' => 6.498344,
            'radius' => 50,
            'description' => "Entre argent et chaussures je me trouve;\n".
            "Prenez garde à ne pas passer tout droit;\n".
            "Car pavé d’embûches votre route sera."
        ],
        [
            'quiz_id' => 1,
            'picture' => "storage/images/questions/Q1Q4.jpg",
            'coord_x' => 46.505654,
            'coord_y' => 6.495371,
            'radius' => 20,
            'description' => "Entouré de vert, je suis;\n".
            "Des Tulipes je suis la forteresse;\n".
            "En bon voisin de la Morges, je trône."
        ],
        [
            'quiz_id' => 1,
            'picture' => "storage/images/questions/Q1Q5.jpg",
            'coord_x' => 46.506936,
            'coord_y' => 6.497359,
            'radius' => 80,
            'description' => "En gardien du port, je veille;\n".
            "À la croisée de la ville et de la nature vous me trouverez;\n".
            "Même si je n’en suis pas loin, n’en faites pas tout un cinéma."
        ],
        [
            'quiz_id' => 1,
            'picture' => "storage/images/questions/Q1Q6.jpg",
            'coord_x' => 46.510694,
            'coord_y' => 6.500291,
            'radius' => 30,
            'description' => "Mes hauteurs vous ne pouvez manquer;\n".
            "En face du légionnaire château je me situe;\n".
            "Comme le soleil, à l’horizon je me trouve."
        ],
        [
            'quiz_id' => 1,
            'picture' => "storage/images/questions/Q1Q7.jpg",
            'coord_x' => 46.508468,
            'coord_y' => 6.499861,
            'radius' => 50,
            'description' => "À la frontière entre terre et lac;\n".
            "En face du Mont Blanc;\n".
            "Quel meilleur endroit pour commencer une croisière ?"
        ],
    ];
    
    
    /**
     * Creates 15 placeholder questions, attributed to a random quiz
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->delete();

        // #### Questions Quiz Morges (id: 1) ####
        foreach ($this->questionsMorges as $question) {
            DB::table('questions')->insert($question);
        }


        for ($i = 8; $i <= 15; $i++) {
            $quiz_id = rand(1,5);
            DB::table('questions')->insert([
                'quiz_id' => $quiz_id,
                'picture' => "storage/images/questions/Q$quiz_id" . "Q$i.jpg",
                'coord_x' => rand(1, 1000),
                'coord_y' => rand(1, 1000),
                'radius' => rand(10, 100),
                'description' => "Description $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            ]);
        }
    }
}
