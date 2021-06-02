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

        /*
        @foreach ($question as $questions )
<label>{{$questions->description}}</label>
@endforeach */

       // $question = DB::select('select * from questions where quiz_id = ?',[$id]);
       $coordArray = [];
       $question = Quiz::findOrFail($id)->questions;
         $tesJson = json_encode($question);

         foreach($question as $question)
         {
            array_push($coordArray, ["coord_x" => $question->coord_x, "coord_y" => $question->coord_y]);
         }

        json_encode($question);
        $cordone = json_encode($coordArray);

        //dd($tesJson);
        return view('game')->with('questions',$cordone);
    }


    public function endGame($id)
    {

        $quiz = Quiz::findOrFail($id);


        return view('game')->with(compact('quiz'));
    }




}
