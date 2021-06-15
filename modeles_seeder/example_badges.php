<?php
$badgesExample = [
    // Début du badge
    [
        'label' => 'XXX',
        'description' => 'XXX',
        'pictogram' => "fa-swimmer", // icône Fontawesome
        'color' => "#BF4452", // couleur héxa du fond du badge
        'type' => 'XXX', // region | score | time
        'criterium' => 000, // %age des quizzes réussis dans la région | score minimal | temps maximal
        'badgeable_type' => 'App\Models\XXX', // XXX = Region | Quiz
        'badgeable_id' => 4 // id de la Region ou du Quiz, il est affiché dans l'interface admin
    ],
    // Fin du badge
    //... suite des badges
];