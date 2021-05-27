<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $regions=Region::paginate(10);
        $links=$regions->render();

        return compact('regions','links');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $region = Region::findOrFail($id);
        $quizzes = $region->quizzes()->get();

        // Ajouter les badges

        return compact('region', 'quizzes');
    }

    public function scores($id) {
        $region = Region::findOrFail($id);
        $quizzes = $region->quizzes->all();
        $scores = [];

        foreach ($quizzes as $quiz) {
            array_push($scores, $quiz->scores()->get());
        }

        return compact('region', 'scores');
    }
}
