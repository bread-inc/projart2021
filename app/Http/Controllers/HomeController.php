<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Badge;
use App\Models\Region;
use App\Http\Traits\ScoreboardTrait;

class HomeController extends Controller
{
    use ScoreboardTrait;

    /**
     * If the user is already logged in, returns the 'home' view. Else, returns the 'login' view.
     * 
     * @return \Illuminate\Http\Response 
     */
    public function landingPage() {
        if(auth()->id()) {
            return redirect(route('home'));
        } else {
            return redirect(route('login'));
        }
    }

    /**
     * Shows the application's public dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $regions = Region::all()->take(4);
        $scores = $this->scoreboardTop(3);
        // Dashboard for auth users
        if(auth()->id()) {

            $user = User::find(auth()->id());
            $badges = $user->badges()->orderBy('created_at', 'desc')->get();

            return view('public.dashboard', compact('user', 'regions', 'badges', 'scores'));
        } else {
            $badges = Badge::all();
            return view('public.dashboard', compact('regions', 'badges', 'scores'));
        }
    }
}
