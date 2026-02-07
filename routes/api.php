<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Players\PlayerController;
use App\Http\Controllers\Season\CreateNewFootballSeasonController;
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

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::post('logout', LogoutController::class);
            Route::post('create-new-football-season', CreateNewFootballSeasonController::class);
            Route::apiResource('players', PlayerController::class)->except(['index']);
        });

        Route::get('players', [PlayerController::class, 'index']);
    });
});
