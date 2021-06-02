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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

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
            array_push($rankings, ["user_id" => $user_id, "pseudo" => $pseudo, "score" => $score]);
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
}
