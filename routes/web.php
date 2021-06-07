<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ClueController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ScoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ##### Test routes #####
Route::get('adminOnly', function () {
    return view('admin_page');
})->middleware("admin")->name('test.admin');

Route::get('userOnly', function () {
    return "User only";
})->middleware("auth")->name('test.user');

// ##### Auth routes #####
Auth::routes();


// ##### Public routes #####
Route::get('/', [HomeController::class, 'landingPage']);


Route::get('globalRanking', [ScoreController::class, 'index'])->name('global-ranking');
Route::get('home', [HomeController::class, 'home'])->name('home');
Route::get('scoreboard', [HomeController::class, 'scoreboard'])->name('scoreboard');



// ##### User routes #####
/*
Route::resource('user', UserController::class)->only(['index', 'create']);

Route::resource('user', UserController::class)->only(['show'])
    ->middleware('auth');

Route::resource('user', UserController::class)->except(['index', 'create', 'show'])
    ->middleware('admin');
*/
Route::prefix('user')->group(function () {
    Route::get('{user_id}', [UserController::class, 'showUser'])->name('profile.show');
});


// ##### Region routes #####
Route::prefix('region')->group(function () {
    Route::get('/', [RegionController::class, "index"])->name('region.index');
    Route::get('/{id}', [RegionController::class, "show"])->name('region.show');
    Route::get('/{id}/scores', [RegionController::class, "scores"])->name('region.scores');
});

// ##### Badge routes #####
/*
Route::prefix('badge')->group(function () {
    Route::get('/', [BadgeController::class, "index"]);
    Route::get('/{id}', [BadgeController::class, "show"]);
    Route::get('/{id}/users', [BadgeController::class, "users"]);
});
*/
// ##### Game controller route #####
Route::prefix('quizz')->group(function () {
    Route::get('/{id}/start', [GameController::class, "afficheQuiz"])->name('game.start'); // Attention aux noms des méthodes et des routes !!
    Route::get('/{id}/play', [GameController::class, "startQuiz"])->name('game.play');
    Route::get('/{id}/game/completed', [GameController::class, "endGame"])->name('game.completed');
});

// ##### Quiz routes #####
Route::resource('quiz', QuizController::class)->only(['index', 'show']);


// ##### Admin routes #####
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [HomeController::class, "adminDashboard"])->name('admin.dashboard');

    Route::get('user/{user_id}/addBadges', [UserController::class, "addBadges"])->name("user.addBadges");
    Route::post('user/{user_id}/addBadges', [UserController::class, "storeBadges"])->name("user.storeBadges");
    Route::post('user/{user_id}/badge/{badge_id}', [UserController::class, "deleteBadge"]);
    Route::post('user/{user_id}/score/{score_id}', [UserController::class, "deleteScore"]);

    Route::resource('badge', BadgeController::class);

    Route::resource('quiz', QuizController::class);

    Route::prefix('quiz/{quiz_id}')->group(function () {

        Route::resource('question', QuestionController::class);

        Route::prefix('question/{question_id}')->group(function() {
            Route::resource('clue', ClueController::class)->except(['index', 'show']);
        });
    });

    Route::resource('user', UserController::class); // Attention aux méthodes publiques, à voir si cela fonctionne avec le middleware
});
