<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function globalRanking()
    {
        $scores = $this->scoreboard();
        return view('globalRanking')->with('scores', $scores);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the top 10 scores.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
            array_push($rankings, ["user_id" => $user_id, "pseudo" => $pseudo, "score" => $score]);
            $i++;
        }

        $score = array_column($rankings, 'score');
        array_multisort($score, SORT_DESC, $rankings);

        return json_encode($rankings);
    }

    /**
     *
     */
    public function adminDashboard() {
        return view("admin.dashboard");
    }
}
