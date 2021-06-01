<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use Illuminate\Support\Facades\DB;


class QuestionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quiz_id)
    {
        return view('admin.quizzes.questions.create_question', compact('quiz_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request, $quiz_id)
    {
        $statement = DB::table('questions')->where('id', \DB::raw("(select max(`id`) from questions)"))->get();
        $nextId = $statement[0]->id+1;

        // Saving image
        $image = $request->file('picture');
        $name = "Q$quiz_id"."Q$nextId.".$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $name);

        // Saving object in DB
        $newQuestion = [
            "description" => $request->description,
            "coord_x" => $request->coord_x,
            "coord_y" => $request->coord_y,
            "radius" => $request->radius,
            "picture" => "/images/" . $name,
            "quiz_id" => $request->quiz_id
        ];
        
        Question::create($newQuestion);

        return redirect(route('quiz.show', [$quiz_id]))->withOk("La question a été créée avec succès.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($quiz_id, $id)
    {
        $question = Quiz::find($quiz_id)->questions()->find($id);
        $question->clues;
        return view('admin.quizzes.questions.show_question', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id, $id)
    {
        $question = Question::find($id);
        return  view('admin.quizzes.questions.edit_question', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, $quiz_id, $id)
    {
        $updatedData = [
            "description" => $request->description,
            "coord_x" => $request->coord_x,
            "coord_y" => $request->coord_y
        ];

        // If new file is uploaded
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');

            // Saving image
            $name = "Q$quiz_id"."Q$id.".$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);

            $updatedData["picture"] = "/images/" . $name;
        }

        Question::findOrFail($id)->update($updatedData);

        return redirect(route('question.show', [$quiz_id, $id]))->withOk("La question " . $id . " a été modifiée.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id, $id)
    {
        $question = Question::find($id);
        
        // Deleting the clues linked to the question
        foreach ($question->clues as $clue) {
            $clue->delete();
        }

        // Deleting the question itself
        $question->delete();
        return redirect(route('quiz.show', [$quiz_id]))->withOk("La question " . $id . " a été supprimée.");
    }
}
