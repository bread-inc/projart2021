<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Badge;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
   /**
     *Display the quiz
     */
    public function afficheQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quizStart')->with(compact('quiz'));

    }

    public function startQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->questions;
        return view('game', compact('quiz'));
    }

    private function checkingBadges(Quiz $quiz, $score, $time) {
        $region = $quiz->region;

        // Collecting all badges
        $regionalBadgesToCheck = $region->badges;
        $allBadgesToCheck = $regionalBadgesToCheck->merge($quiz->badges);

        foreach ($allBadgesToCheck as $badge) {
            if(!$this->userHasBadgeAlready(auth()->id(), $badge->id)) {
                echo "<hr><p>User's gonna try to get the badge $badge->id ...</p>";

                if($badge->type == "region") {
                    $userGetsANewBadge = $this->validateRegionalBadge($badge->criterium, $region);
                } elseif($badge->type == "score") {
                    $userGetsANewBadge = $this->validateScoreBadge($badge->criterium, $score);
                } else {
                    $userGetsANewBadge = $this->validateTimeBadge($badge->criterium, $time);
                }
    
                if($userGetsANewBadge) {
                    echo "<p>... and user has got the badge $badge->id !</p>";
                    $this->attributeBadgeToUser($badge->id, auth()->id());
                } else {
                    echo "<p>... and user has to try again for $badge->id.</p>";
                }
            } else {
                echo "<hr><p>User already has $badge->id.</p>";
            }
        }

        //dd($score, $time, $allBadgesToCheck);
    }

    private function userHasBadgeAlready($user_id, $badge_id) {
        return !empty(User::findOrFail($user_id)->badges->find($badge_id));
    }

    private function validateRegionalBadge($criterium, $region) {
        echo " regio badge ";
        return false;
    }

    private function validateScoreBadge($criterium, $score) {
        echo "Score min : $criterium <br> My score : $score";
        return false;
    }

    private function validateTimeBadge($criterium, $time) {
        echo " time badge ";
        return false;
    }

    private function attributeBadgeToUser($badge_id, $user_id) {
        echo "<p>Attributing badge $badge_id to user $user_id !!</p>";
    }

    public function endGame($id)
    {
        $quiz = Quiz::findOrFail($id);

        $score = rand(55, 95);

        $startTime = time()-rand(60, 600);

        $time = time()-$startTime;

        //$time = rand(1, 10);

        $this->checkingBadges($quiz, $score, $time);
        

        return view('game_completed')->with(compact('quiz', 'score', 'time', 'startTime'));
    }

    public static function renderTime($time) {
        return floor($time/60) . " min " . $time%60 . " secondes";
    }




}
