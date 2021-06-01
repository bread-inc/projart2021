<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Badge;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{

   /**
     *Display the quiz
     */
    public function afficheQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quizStart')->with(compact('quiz'));

    }

    public function startQuiz($id)
    {


        $question = DB::select('select * from questions where quiz_id = ?',[$id]);

        $question;
        return view('game')->with('question',$question);
    }


    public function endGame($id)
    {

        $quiz = Quiz::findOrFail($id);


        return view('game')->with(compact('quiz'));
    }




}
