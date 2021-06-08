<?php

namespace App\Http\Traits;

use App\Models\Score;
use App\Models\User;

/**
 * 
 */
trait ScoreboardTrait
{
    /**
     * Returns the global rankings data
     * 
     */
    public function scoreboard() {
        $scores = Score::groupBy('user_id')
            ->selectRaw('sum(score) as total, user_id')
            ->pluck('total', 'user_id');

        $rankings = [];
        $i = 0;

        foreach ($scores as $score) {
            $user_id = $i + 1; 
            $pseudo = User::findOrFail($user_id)->pseudo;
            $avatar = User::findOrFail($user_id)->avatar;
            array_push($rankings, ["user_id" => $user_id, "pseudo" => $pseudo, "avatar" => $avatar, "score" => $score]);
            $i++;
        }

        $score = array_column($rankings, 'score');
        array_multisort($score, SORT_DESC, $rankings);

        for ($i=0; $i < sizeof($rankings); $i++) 
        {
            $rankings[$i]["rank"] = $i+1;
        }

        return json_encode($rankings);
    }

    /**
     * Returns the user's global score, the total of all his scores
     * 
     * @param int $user_id the user's id
     * @return float the global score of the user $user_id
     */
    public function getUserGlobalScore($user_id) {
        $scores = Score::groupBy('user_id')
            ->selectRaw('sum(score) as total, user_id')
            ->pluck('total', 'user_id');

        return $scores[$user_id];
    }
}
