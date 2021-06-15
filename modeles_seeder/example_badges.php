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

$badgesBern = [
    // Début du badge
    [
        'label' => 'C\'est du grand Aar !',
        'description' => 'Tu n\'as fait qu\'une bouchée de la Capitale.',
        'pictogram' => "fa-tint", // icône Fontawesome
        'color' => "#bd0d00", // couleur héxa du fond du badge
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
        'color' => "#bd0d00", // couleur héxa du fond du badge
        'type' => 'score', // region | score | time
        'criterium' => 80, // %age des quizzes réussis dans la région | score minimal | temps maximal
        'badgeable_type' => 'App\Models\Quiz', // XXX = Region | Quiz
        'badgeable_id' => 4 // id de la Region ou du Quiz, il est affiché dans l'interface admin
    ],
    // Fin du badge
    //... suite des badges
];