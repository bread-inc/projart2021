<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\QuestionController;

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
    return "<a href='/login'>Login</a> or continue <a href='/home'>without registering page</a>";
});


Route::get('/globalRanking', [HomeController::class, 'globalRanking']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/scoreboard', [HomeController::class, 'scoreboard']);



// ##### User routes #####
/*
Route::resource('user', UserController::class)->only(['index', 'create']);

Route::resource('user', UserController::class)->only(['show'])
    ->middleware('auth');

Route::resource('user', UserController::class)->except(['index', 'create', 'show'])
    ->middleware('admin');
*/
Route::prefix('user')->group(function () {
    Route::get('{user_id}', [UserController::class, 'showUser']);
});


// ##### Region routes #####
Route::prefix('region')->group(function () {
    Route::get('/', [RegionController::class, "index"]);
    Route::get('/{id}', [RegionController::class, "show"]);
    Route::get('/{id}/scores', [RegionController::class, "scores"]);
});

// ##### Badge routes #####
/*
Route::prefix('badge')->group(function () {
    Route::get('/', [BadgeController::class, "index"]);
    Route::get('/{id}', [BadgeController::class, "show"]);
    Route::get('/{id}/users', [BadgeController::class, "users"]);
});
*/

// ##### Quiz routes #####
Route::resource('quiz', QuizController::class)->only(['index', 'show']);

Route::resource('quiz', QuizController::class)->except(['index', 'show'])
    ->middleware('admin');


// ##### Admin routes #####
Route::prefix('admin')->group(function () {
    Route::get('user/{user_id}/addBadges', [UserController::class, "addBadges"])->name("user.addBadges");
    Route::post('user/{user_id}/addBadges', [UserController::class, "storeBadges"])->name("user.storeBadges");
    Route::post('user/{user_id}/badge/{badge_id}', [UserController::class, "deleteBadge"]);
    Route::post('user/{user_id}/score/{score_id}', [UserController::class, "deleteScore"]);

    Route::get('/', [HomeController::class, "adminDashboard"])->middleware('admin');
    Route::resource('badge', BadgeController::class);

    Route::resource('quiz', QuizController::class);
    Route::prefix('quiz/{quiz_id}')->group(function () {
        Route::resource('question', QuestionController::class);
    });
    Route::resource('user', UserController::class);
});
