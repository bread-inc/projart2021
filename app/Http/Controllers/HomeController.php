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
     * Show the admin Dashboard
     */
    public function adminDashboard() {
        // Could be replaced by just a route, if no further info needed

        return view("admin.dashboard");
    }
}
