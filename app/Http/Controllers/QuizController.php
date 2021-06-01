<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizRequest;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Region;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::all();

        foreach ($quizzes as $quiz) {
            $quiz->user;
            $quiz->region;
        }

        return view("admin.quizzes.index_quizzes", compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        return view("admin.quizzes.create_quiz", compact("regions"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizRequest $request)
    {
        $request->merge(['user_id' => auth()->id()]);
        $quiz = Quiz::create($request->all());
        return redirect(route('quiz.index'))->withOk("Le quiz " . $quiz->title . " a été créé avec succès.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        $questions = $quiz->questions;
        $scores = $quiz->scores;
        $badges = $quiz->badges;

        return view("admin.quizzes.show_quiz", compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $regions = Region::all();
        return view('admin.quizzes.edit_quiz', compact('quiz', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizRequest $request, $id)
    {        
        Quiz::findOrFail($id)->update($request->all());
        return redirect(route('quiz.index'))->withOk("Le quiz " . $id . " a été modifié avec succès.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id);  
        // Deleting the questions linked to the quiz
        foreach ($quiz->questions as $question) {
            // Deleting the clues linked to the question
            foreach ($question->clues as $clue) {
                $clue->delete();
            }
            $question->delete();
        }
        // Deleting the quiz itself
        $quiz->delete();

        return redirect(route('quiz.index'))->withOk("Le quiz " . $id . " a été supprimé avec succès.");
    }

    /**
     * Show profile, for users (not admin)
     */
    public function profile($id)
    {
        $quiz = Quiz::findOrFail($id);
        $questions = $quiz->questions;
        $scores = $quiz->scores;
        $badges = $quiz->badges;

        return compact('quiz');
    }
}
