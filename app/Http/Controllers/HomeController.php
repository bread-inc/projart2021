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
        //$this->middleware('auth');
    }

    public function globalRanking()
    {
        $arrayScore = $this->scoreboard();
        return view('globalRanking')->with('arrayScore', $arrayScore);
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
        $topScores = Score::orderBy('score', 'desc')->get()->take(10);

        foreach ($topScores as $score) {
            // Calling the quiz and users linked to the scores
            $score->user;
            $score->quiz;
        }

        return ["Global scoreboard", compact('topScores')];
    }

    /**
     * 
     */
    public function adminDashboard() {
        return view("admin.dashboard");
    }
}
