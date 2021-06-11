<?php
$quizzesExemple = [
    "region_id" => 1, // Neuchâtel : 1, Yverdon : 2, Genève : 3, Morges : 4
    "quizzes" =>  [
        // Début d'un quiz
        [
            "title" => "...",
            "description" => "...",
            "difficulty" => "...",
            "user_id" => 1, // = admin
            "questions" => [
                // Début d'une question
                [
                    'picture' => "storage/images/questions/QXXQXX.jpg", // Q$quiz_idQ$question_id.jpg
                    'coord_x' => 46.0000,
                    'coord_y' => 6.0000,
                    'radius' => 10, // rayon de tolérance pour la validation de la question, entre 1 et 100m
                    'description' => "...",
                    'end_text' => "...",
                    'clues' => [
                        // Début d'un indice
                        [
                            "radius" => 100, // entre 10 et 1000m, mais doit être plus grand que la tolérance de la question
                            "description" => "..."
                        ],
                        // fin d'un indice
                        // ... la suite des indices

                    ]
                ],
                // fin d'une question
                // ... la suite des questions
            ]
        ],
        // fin d'un quiz
        // ... la suite des quizzes, si on en ajoute plus d'un à la fois
    ]
];