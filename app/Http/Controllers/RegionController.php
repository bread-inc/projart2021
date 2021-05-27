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
        return compact('region');
    }

    public function scores($id) {
        $quizzes = Region::findOrFail($id)->quizzes->all();

        return $quizzes;
    }
}
