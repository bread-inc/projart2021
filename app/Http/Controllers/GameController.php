<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Badge;
use App\Models\Quiz;

class GameController extends Controller
{


   /**
     *Display the quiz
     */
    public function afficheQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        dd($quiz);
        return view('quizStart')->with(compact('quiz'));

    }




}
