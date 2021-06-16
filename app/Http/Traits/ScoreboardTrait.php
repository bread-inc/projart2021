<?php

namespace App\Http\Traits;

use App\Models\Score;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * 
 */
trait ScoreboardTrait
{
    /**
     * Returns the global rankings data in JSON.
     * 
     * @return string|false JSON encoded global scoreboard, false if empty
     */
    public function scoreboard() {

        $tmp1 = [];
        $scoresAll = Score::all();

        foreach ($scoresAll as $score) {
            $id = $score->user_id;
            if (array_key_exists($id, $tmp1)) {
                $tmp1[$id]->score += $score->score;
            } else {
                $tmp1[$id] = $score;
            }
        }

        usort($tmp1, function ($a, $b) {
            return $b['score'] - $a['score'];
        });
        $rankings = [];
        $i = 0;

        foreach ($tmp1 as $score) {
            $user_id = $score['user_id']; 
            $pseudo = User::findOrFail($user_id)->pseudo;
            $avatar = User::findOrFail($user_id)->avatar;
            array_push($rankings, ["user_id" => $user_id, "pseudo" => $pseudo, "avatar" => $avatar, "score" => $score['score']]);
            $i++;
        }

        for ($i=0; $i < sizeof($rankings); $i++) 
        {
            $rankings[$i]["rank"] = $i+1;
        }

        return json_encode($rankings);
    }

    /**
     * Returns given integer of global rankings starting from the top
     * 
     * @param int Number of scores from the top
     * @return string|false JSON encoded scoreboard, false if empty
     */
    public function scoreboardTop(int $n) {
        $rankings = json_decode($this->scoreboard());
        $rankings = array_slice($rankings, 0, $n);

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

        if (isset($scores[$user_id])) {
            return $scores[$user_id];
        } else {
            return 0;
        }
    }
}
