<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Badge;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Collection;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $regions=Region::all();


        return view('public.regions.index')->with('regions', $regions);
    }

    /**
     * Sends the data for the desktop map and display the map page, with all region's quizzes.
     * 
     * @return \Illuminate\Http\Response
     */
    public function mapDesktop() {

         $data =[];
         $regio =[];
         $quiz=[];

         foreach (Region::all() as $element)
         {
            $r = Region::findOrFail($element->id);
            array_push($regio,$r);
         }

        foreach($regio as $element)
        {
            $regio["quiz"]=$element->quizzes;
        }

        return view('game_desktop')->with('regions', json_encode($regio));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $region = Region::findOrFail($id);
        $quizzes = $region->quizzes->all();
        $scores = [];

        $mergedScores = new Collection;

        foreach ($quizzes as $quiz) {
            array_push($scores, $quiz->scores()->get());
            $mergedScores = $mergedScores->merge($quiz->scores()->get());
        }



        return view('public.regions.region_show')->with(compact('region', 'mergedScores'));
    }

    /**
     * Display the scores view of the specified region.
     * 
     * @param int $id the region's id
     * @return \Illuminate\Http\Response
     */
    public function scores($id) {
        $region = Region::findOrFail($id);
        $quizzes = $region->quizzes->all();
        $scores = [];

        $mergedScores = new Collection;

        foreach ($quizzes as $quiz) {
            array_push($scores, $quiz->scores()->get());
            $mergedScores = $mergedScores->merge($quiz->scores()->get());
        }

        // Total scores on user_id
        $userIds = new Collection();
        foreach ($mergedScores as $score) {
            $id = $score->user_id;
            if (property_exists($id, $userIds)) {
                $userIds[$id]->score += $score->score;
            } else {
                $userIds[$id] = $score;
            }
        }
        
        $mergedScores = $userIds;
        return view('public.regions.regional_scores', compact('region', 'mergedScores'));
    }
}
