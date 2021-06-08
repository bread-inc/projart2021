<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Add a new quizz as favorite for user
     * 
     * @param int $user_id
     * @param int $quiz_id
     * 
     * @return \Illuminate\Http\Response
     */
    public function store($user_id, $quiz_id) {
        //
    }
}
