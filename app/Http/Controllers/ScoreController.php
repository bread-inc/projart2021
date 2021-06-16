<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\User;
use App\Http\Traits\ScoreboardTrait;

class ScoreController extends Controller
{
    use ScoreboardTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores = $this->scoreboard();
        return view('globalRanking')->with('scores', $scores);
    }
}
