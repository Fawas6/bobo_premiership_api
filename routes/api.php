<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Games\GameController;
use App\Http\Controllers\Gameweek\GetFootballGameweekController;
use App\Http\Controllers\Players\PlayerController;
use App\Http\Controllers\Season\CreateNewFootballSeasonController;
use App\Http\Controllers\Season\GetFootballSeasonController;
use App\Http\Controllers\Season\SetSeasonCurrentGameweekController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['throttle:global'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('login', LoginController::class);
    });

    Route::get('players', [PlayerController::class, 'index']);
    Route::get('games', [GameController::class, 'index']);
    Route::get('seasons', GetFootballSeasonController::class);
    Route::get('seasons/{season}/gameweeks', GetFootballGameweekController::class);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::post('logout', LogoutController::class);
            Route::post('create-new-football-season', CreateNewFootballSeasonController::class);
            Route::apiResource('players', PlayerController::class)->except(['index']);
            Route::apiResource('games', GameController::class)->except(['index']);
            Route::get('get', CreateNewFootballSeasonController::class);
            Route::post('seasons/{season}/set-current-gameweek', SetSeasonCurrentGameweekController::class);
        });
    });
});
