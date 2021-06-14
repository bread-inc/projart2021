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
            "À deux pas des tulipes vous me trouverez.",
            'end_text' => "Vous voilà arrivé !\n
            Une vue imprenable sur le Mont blanc, cette jetée est l’endroit idéal pour un selfie !\n
            Alors, petit souvenir ?"
        ],
        [
            'quiz_id' => 1,
            'picture' => "storage/images/questions/Q1Q2.jpg",
            'coord_x' => 46.508407,
            'coord_y' => 6.498042,
            'radius' => 50,
            'description' => "Sur une place au cœur de la ville je me situe;\n".
            "Perpendiculaire à Louis de Savoie vous me trouverez;\n".
            "Observez bien ou vous pourriez me manquer.",
            'end_text' => "Audrey Hepburn, actrice et femme exceptionnelle, a aussi bien marqué l’histoire du cinéma par son talent, que la mémoire régionale par son statut de résidente, durant près de 30 ans, à Tolochenaz, près de Morges, où elle repose aujourd’hui.
            \nElle tourna de nombreux films dans les années 50 et 60 dont « Vacances romaines » (1953) qui lui valut l’Oscar de la meilleure actrice, « Guerre et Paix » (1956), « Diamants sur canapé » (1961) ou « My Fair Lady » (1964).
            \nDe l’Hôtel-de-Ville de Morges où elle se maria en 1969, au marché où elle avait l’habitude de se rendre, en passant par l’épicerie Dumas dont la porte arrière lui permit d’échapper aux paparazzis, Audrey Hepburn marqua la ville et ses habitants par son élégance, sa simplicité et sa gentillesse."
        ],
        [
            'quiz_id' => 1,
            'picture' => "storage/images/questions/Q1Q3.jpg",
            'coord_x' => 46.509182,
            'coord_y' => 6.498344,
            'radius' => 50,
            'description' => "Entre argent et chaussures je me trouve;\n".
            "Prenez garde à ne pas passer tout droit;\n".
            "Car pavé d’embûches votre route sera.",
            'end_text' => "Le Musée Alexis Forel présente un nouveau programme varié d'expositions temporaires et d'animations en 2020. Dans la magnifique maison historique du 16e siècle qui accueille les espaces du musée, les visiteurs peuvent découvrir, au gré du programme annuel, aussi bien de l'art contemporain d'artistes suisses, que la mise en valeur des collections et du patrimoine morgien du 19e siècle et suivants. Des concerts, lectures et représentations théâtrales sont également proposés. Les espaces des \"Boîtes à rêves\" et des icônes sont ouverts à la visite en permanence."
        ],
        [
            'quiz_id' => 1,
            'picture' => "storage/images/questions/Q1Q4.jpg",
            'coord_x' => 46.505654,
            'coord_y' => 6.495371,
            'radius' => 20,
            'description' => "Entouré de vert, je suis;\n".
            "Des Tulipes je suis la forteresse;\n".
            "En bon voisin de la Morges, je trône.",
            'end_text' => "Dans le Parc de l’Indépendance, un premier kiosque avait été construit en 1897 d’après les plans de Auguste Badan, serrurier à Morges.
            \nDémoli en 1961, il a été reconstruit en 1987 dans une version simplifiée.
            \nParmi les divers monuments du parc, le kiosque à musique semble sortir d’un monde féerique et accueillir les rêves de concerts endiablés."
        ],
        [
            'quiz_id' => 1,
            'picture' => "storage/images/questions/Q1Q5.jpg",
            'coord_x' => 46.506936,
            'coord_y' => 6.497359,
            'radius' => 80,
            'description' => "En gardien du port, je veille;\n".
            "À la croisée de la ville et de la nature vous me trouverez;\n".
            "Même si je n’en suis pas loin, n’en faites pas tout un cinéma.",
            'end_text' => "Afin de protéger la ville neuve fondée en 1286 par Louis de Savoie à l'embouchure de la Morges, le château fort a été élevé de 1286 à 1296 environ, sans doute sous la direction du maître maçon Huet de Morges. En bordure du lac Léman, il joue également un rôle stratégique de fortification du port. Il est établi sur un plan carré, avec quatre tours d’angle reliées par des ailes. L'ensemble est disposé autour d’une cour surélevée, dotée d’exceptionnelles casemates renvoyant à des modèles de Terre sainte, notamment au Krak des Chevaliers et à l’architecture d’Île-de-France, que Louis de Savoie pouvait connaître. Cette forteresse correspond au type du « carré savoyard » et se réfère tout particulièrement au modèle du château d'Yverdon. À la différence d’Yverdon, toutefois, le donjon (qu’il faut en fait appeler « grosse tour »), est en position offensive, du côté de la ville et au voisinage de l’entrée du château. Cette dernière était accessible par un pont-levis, auquel on arrivait par un escalier extérieur. Un mur d’enceinte, lui-même cantonné de tours, chemisait l’ensemble. Le château a subi de graves incendies, accidentel en 1391, volontaire en 1475. Défendu par un condottiere Italien à la solde du duc de Savoie en 1536, lors de la conquête du Pays de Vaud par les Bernois, le château est abandonné par ses défenseurs et a donc été pris sans coup férir."
        ],
        [
            'quiz_id' => 1,
            'picture' => "storage/images/questions/Q1Q6.jpg",
            'coord_x' => 46.510694,
            'coord_y' => 6.500291,
            'radius' => 30,
            'description' => "Mes hauteurs vous ne pouvez manquer;\n".
            "En face du légionnaire château je me situe;\n".
            "Comme le soleil, à l’horizon je me trouve.",
            'end_text' => "Le temple s’élève sur le site d’une ancienne « chapelle » attestée dès 1306 au voisinage de l’ancienne porte de ville et du mur d’enceinte nord de l’agglomération. Consacré au culte catholique et dédié à Notre-Dame, cet édifice, dont le chœur a été reconstruit en 1508 dans le style gothique flamboyant, comportait plusieurs chapelles. Un enfeu, simple niche sur le mur nord de la nef, appartenait à la famille d'Aubonne. La chapelle dite \"La Garillette\", appuyée au mur sud du chœur, fut fondée en 1499 par Nicod Garilliat, évêque d'Ivrée. A la Réforme, cette chapelle dédiée à la Vierge passa à l'hôpital de Morges qui l'utilisa comme entrepôt dès 1569, tandis que l'église elle-même devint temple protestant. Délabrée, elle a été démolie en 1769.
            \nDès 1969, un nouveau Temple est bati, mais le clocher, plus éléevé que prévu s’affaisse et la facade doit être entièrement recontrsuite.
            \nLe tout est reconstruit selon les plans précédant, en s’assurant cette fois de l’intégrité physique du batîment.
            \nClassé monument historique, le temple, qui compte parmi les plus importants édifices religieux de style baroque tardif de Suisse romande, est inscrit comme bien culturel suisse d'importance nationale. Il est le centre de la paroisse de Morges Échichens, qui regroupe la ville de Morges et la commune d'Échichens."
        ],
        [
            'quiz_id' => 1,
            'picture' => "storage/images/questions/Q1Q7.jpg",
            'coord_x' => 46.508468,
            'coord_y' => 6.499861,
            'radius' => 50,
            'description' => "À la frontière entre terre et lac;\n".
            "En face du Mont Blanc;\n".
            "Quel meilleur endroit pour commencer une croisière ?",
            'end_text' => "La Compagnie Générale de Navigation sur le Lac Léman (CGN) a été fondée en 1873. A côté d’unités modernes comme les grandes vedettes « Morges », « Lavaux » et « Valais » ou les deux Navibus lancés en 2008, la CGN possède huit bateaux Belle Epoque propulsés par des roues à aube, dont cinq authentiques vapeurs amoureusement entretenus. Le plus ancien, le Montreux, a été mis en service en … 1904 ! Un patrimoine nautique sans équivalent en Europe.
            \nAvec une imposante flotte de 19 navires desservant 35 ports des rives suisse et française, la Compagnie Générale de Navigation sur le Lac Léman vous propose toute l’année un vaste choix de croisières desservant autant d’attractions touristiques.
            \nDerrière vous, le Casino de Morges.
            \nInauguré le 23 février 1900, le Casino de Morges compte parmi les monuments les plus prestigieux de l’arc lémanique. Idéalement située le long des quais, face au débarcadère de la CGN, sa brasserie conviviale propose une cuisine innovante.
            \nSur la carte, on retrouve divers poissons, dont les filets de perches meunières et poissons du marché selon arrivage, ainsi que des viandes avec spécialités de chasse en saison. Les enfants ne sont pas oubliés avec des portions à leur taille de tagliatelle maison, hamburger Casino ou encore filets de perches.
            \nLes quais et la terrasse face au Léman représentent des emplacements magiques pour l’organisation de réceptions ou apéritifs, tandis que le restaurant et sa véranda possèdent également une vue imprenable sur le lac.
            \nPour une ambiance plus intime pour les événements professionnels ou festifs, le salon privé (32 places) et l’espace lounge sont à disposition des convives, tout comme la mythique salle Belle Epoque. Après le dîner, le public est invité à poursuivre la soirée par un spectacle au café-théâtre ou un thé dansant.
            \nLe Casino organise également un brunch le dimanche sous forme de buffet. Un emplacement idyllique pour profiter d'un moment gourmand face au lac !"
        ],
    ];
    
    
    /**
     * Creates 8 placeholder questions, attributed to a random quiz
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
            $quiz_id = rand(2,5);
            DB::table('questions')->insert([
                'quiz_id' => $quiz_id,
                'picture' => "storage/images/questions/Q$quiz_id" . "Q$i.jpg",
                'coord_x' => rand(1, 1000),
                'coord_y' => rand(1, 1000),
                'radius' => rand(10, 100),
                'description' => "Description $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                'end_text' => "Texte de fin $i. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            ]);
        }
    }
}
