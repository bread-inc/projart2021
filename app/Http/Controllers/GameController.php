<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Badge;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Score;

class GameController extends Controller
{
   /**
     * Display the quiz' info page.
     * 
     * @param int $id the quizz' id
     * @return \Illuminate\Http\Response
     */
    public function displayQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('public.quizzes.quiz_info', compact('quiz'));
    }

    /**
     * Display the 1st page of the quiz.
     * 
     * @param int $id the quiz' id
     * @return \Illuminate\Http\Response
     */
    public function startQuiz($id)
    {
        $data = [];
        $data["quiz"] = Quiz::findOrFail($id);
        $data["questions"] = [];
        
        foreach (Quiz::findOrFail($id)->questions as $question) {
            $question["clues"] = $question->clues;
            array_push($data["questions"], $question);
        }

        shuffle($data["questions"]);
        
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
        return intval($time) <= $criterium * 60;
    }

    /**
     * Adding the badge $badge_id to the user $user_id
     *
     * @param int $user_id the user receiving the badge
     * @param int $badge_id the badge to add
     * @return void
     */
    private function attributeBadgeToUser($user_id, $badge_id) {
        User::find($user_id)->badges()->attach(Badge::find($badge_id));
    }

    /**
     * Once the quiz is over, checking the time, scores, etc.
     * 
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response the end of game view
     */
    public function endGame(Request $request)
    {   
        $time = $request->time;
        $questions = $request->questionCounter;
        $clues = $request->clueCounter;
        $validations = $request->failedValidations;

        $quiz = Quiz::findOrFail($request->id);
        $difficulty = $quiz->difficulty;

        $baseScore = (100 * $questions) - ($clues * 3) - ($validations * 5) - floor($time/60);
        $exponent = 33.3 * $difficulty + 66.5;
        $score = $baseScore / 100 * $exponent;

        if (auth()->check()) {
            // Checking if the user gets new badges
            $newBadges = $this->checkingBadges($quiz, $score, $time);
            
            $newScore = new Score();
            $newScore->quiz_id = intval($request->id);
            $newScore->user_id = $request->user()->id;
            $newScore->score = $score;
            $newScore->save();

            return view('game_completed')->with(compact('quiz', 'score', 'time', 'newBadges'));
        } else {
            return view('game_completed')->with(compact('quiz', 'score', 'time'));
        }
        
    }

    /**
     * Formating a Carbon timestamp in minutes and secondes.
     * 
     * @param int $time 
     * @return string the formated time in minutes and secondes
     */
    public static function renderTime($time) {
        return floor($time/60) . " min " . $time%60 . " secondes";
    }
}
