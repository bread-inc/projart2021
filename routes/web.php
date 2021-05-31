<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\GameController;

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
Route::get('/adminOnly', function () {
    return view('admin_page');
})->middleware("admin");

Route::get('/userOnly', function () {
    return "User only";
})->middleware("auth");

// ##### Auth routes #####
Auth::routes();


// ##### Public routes #####
Route::get('/', function () {
    return "Login or continue without registering page";
});


Route::get('/globalRanking', [HomeController::class, 'globalRanking']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/scoreboard', [HomeController::class, 'scoreboard']);



// ##### User routes #####
Route::resource('user', UserController::class)->only(['index', 'create']);

Route::resource('user', UserController::class)->only(['show'])
    ->middleware('auth');

Route::resource('user', UserController::class)->except(['index', 'create', 'show'])
    ->middleware('admin');


// ##### Region routes #####
Route::prefix('region')->group(function () {
    Route::get('/', [RegionController::class, "index"]);
    Route::get('/{id}', [RegionController::class, "show"]);
    Route::get('/{id}/scores', [RegionController::class, "scores"]);
});

// ##### Game controller route #####
Route::prefix('quizz')->group(function () {
    Route::get('/{id}/start', [GameController::class, "afficheQuiz"]);
    Route::get('/{id}/game', [GameController::class, "startQuiz"]);
});

// ##### Badge routes #####
Route::prefix('badge')->group(function () {
    Route::get('/', [BadgeController::class, "index"]);
    Route::get('/{id}', [BadgeController::class, "show"]);
    Route::get('/{id}/users', [BadgeController::class, "users"]);
});



// ##### Quiz routes #####
Route::resource('quiz', QuizController::class)->only(['index', 'show']);
Route::resource('quiz', QuizController::class)->except(['index', 'show'])
    ->middleware('admin');
