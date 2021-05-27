<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return "Dashboard";
    }

    /**
     * Show the top 10 scores.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function scoreboard() {
        $topScores = Score::orderBy('score', 'desc')->get()->take(10);

        foreach ($topScores as $score) {
            // Calling the quiz and users linked to the scores
            $score->user;
            $score->quiz;
        }
        return ["Global scoreboard", compact('topScores')];
    }
}
