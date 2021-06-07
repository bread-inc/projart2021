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
    public function displayQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quiz_info')->with(compact('quiz'));
    }

    public function startQuiz($id)
    {
        $data = [];
        $data["quiz"] = Quiz::findOrFail($id);
        $data["questions"] = [];
        
        foreach (Quiz::findOrFail($id)->questions as $question) {
            $question["clues"] = $question->clues;
            array_push($data["questions"], $question);
        }
        

        return view('game')->with('data', json_encode($data));
    }

    /**
     * When a quiz is over, we test if the connected user should receive some badges.
     *
     * @param Quiz $quiz the quiz completed
     * @param int $score the score marked
     * @param int $time the time used to complete the quiz, in seconds
     *
     * @return Badge[] the new badges unlocked (the array can be empty)
     */
    private function checkingBadges(Quiz $quiz, $score, $time) {
        $region = $quiz->region;

        $newBadges = [];

        // Collecting all badges related to the quiz' region or the quiz itself
        $regionalBadgesToCheck = $region->badges;
        $allBadgesToCheck = $regionalBadgesToCheck->merge($quiz->badges);

        foreach ($allBadgesToCheck as $badge) {
            if(!$this->userHasBadgeAlready(auth()->id(), $badge->id)) {
                if($badge->type == "region") {
                    $userGetsANewBadge = $this->validateRegionalBadge($badge->criterium, $region);
                } elseif($badge->type == "score") {
                    $userGetsANewBadge = $this->validateScoreBadge($badge->criterium, $score);
                } else {
                    $userGetsANewBadge = $this->validateTimeBadge($badge->criterium, $time);
                }

                if($userGetsANewBadge) {
                    $this->attributeBadgeToUser(auth()->id(), $badge->id);
                    array_push($newBadges, Badge::find($badge->id));
                }
            }
        }
        return $newBadges;
    }

    /**
     * Testing if the badge is already owned by the user.
     *
     * @param int $user_id score to beat
     * @param int $badge_id score achieved
     *
     * @return bool badge unlocked
     */
    private function userHasBadgeAlready($user_id, $badge_id) {
        return !empty(User::findOrFail($user_id)->badges->find($badge_id));
    }

    /**
     * Testing if the badge's criterium is met.
     *
     * @param int $criterium percentage of quizzes with a +50 score completed
     * @param Region $region the region to check
     *
     * @return bool badge unlocked
     */
    private function validateRegionalBadge($criterium, $region) {
        // To have a Region Badge, you must have completed more than $criterium% of the region's quizzes with a score of 50 or higher.
        $quizzesCompleted = 0;
        foreach ($region->quizzes as $quiz) {
            if(!empty($quiz->scores->where('user_id','=', auth()->id())->where('score', '>', 50))) { $quizzesCompleted ++;}
        }
        return $quizzesCompleted/sizeof($region->quizzes)*100 >= $criterium;
    }

    /**
     * Testing if the badge's criterium is met.
     *
     * @param int $criterium score to beat
     * @param int $time score achieved
     *
     * @return bool badge unlocked
     */
    private function validateScoreBadge($criterium, $score) {
        // To have a Score Badge, your score needs to be bigger or equal to the criterium.
        return $score >= $criterium;
    }

    /**
     * Testing if the badge's criterium is met.
     *
     * @param int $criterium time to beat in minutes
     * @param int $time time achieved in seconds
     *
     * @return bool badge unlocked
     */
    private function validateTimeBadge($criterium, $time) {
        // To have a Time Badge, your score needs to be smaller or equal to the criterium.
        // $criterium is in minutes, $time in seconds
        return $time <= $criterium * 60;
    }

    /**
     * Adding the badge $badge_id to the user $user_id
     *
     * @param int $user_id the user receiving the badge
     * @param int $badge_id the badge to add
     */
    private function attributeBadgeToUser($user_id, $badge_id) {
        User::find($user_id)->badges()->attach(Badge::find($badge_id));
    }

    public function endGame(Request $request)
    {
        dd($request);

        // Hard-coded score and time
        $score = rand(55, 95);
        $startTime = time()-rand(60, 600);
        $time = time()-$startTime;

        // Checking if the user gets new badges
        // $newBadges = $this->checkingBadges($quiz, $score, $time);

        return view('game_completed')->with(compact('quiz', 'score', 'time', 'startTime', 'newBadges'));
    }

    public static function renderTime($time) {
        return floor($time/60) . " min " . $time%60 . " secondes";
    }
}
