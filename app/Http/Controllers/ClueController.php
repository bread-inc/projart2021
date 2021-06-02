<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Clue;

use App\Http\Requests\ClueRequest;

class ClueController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quiz_id, $question_id)
    {
        return view("admin.quizzes.questions.clues.create_clue", compact('quiz_id', 'question_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClueRequest $request)
    {
        // On contrôle que la question existe, et on récupère les informations pour la Vue de redirection
        $question = Question::find($request->question_id);
        
        if(!empty($question)) {

            Clue::create([
                'question_id' => $request->question_id,
                'radius' => $request->radius,
                'description' => $request->description,
            ]);
            
            return redirect(route('question.show', [$question->quiz_id, $question->id]))->withOk("L'indice " . $request->id . " a été créé.");
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id, $question_id, $clue_id)
    {
        $clue = Clue::findOrFail($clue_id);

        return view("admin.quizzes.questions.clues.edit_clue", compact('clue', 'quiz_id', 'question_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClueRequest $request, $quiz_id, $question_id, $clue_id)
    { 
        Clue::findOrFail($clue_id)->update($request->all());
        return redirect(route('question.show', [$quiz_id, $question_id]))->withOk("L'indice " . $request->id . " a été modifié.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id, $question_id, $clue_id) // Debug : comment enlever ces paramètres inutiles ? 
    {
        Clue::findOrFail($clue_id)->delete();
        return redirect()->back();
    }
}
