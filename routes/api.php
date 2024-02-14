<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'characters'], function () {
    Route::get('/', [CharacterController::class, 'index']);
    Route::get('/{id}', [CharacterController::class, 'show']);
    Route::post('/', [CharacterController::class, 'store']);
    Route::put('/{id}', [CharacterController::class, 'update']);
    Route::delete('/{id}', [CharacterController::class, 'destroy']);
});
Route::group(['prefix' => 'episodes'], function () {
    Route::get('/', [EpisodeController::class, 'index']);
    Route::get('/{id}', [EpisodeController::class, 'show']);
    Route::post('/', [EpisodeController::class, 'store']);
    Route::put('/{id}', [EpisodeController::class, 'update']);
    Route::delete('/{id}', [EpisodeController::class, 'destroy']);
});
Route::group(['prefix' => 'locations'], function () {
    Route::get('/', [LocationController::class, 'index']);
    Route::get('/{id}', [LocationController::class, 'show']);
    Route::post('/', [LocationController::class, 'store']);
    Route::put('/{id}', [LocationController::class, 'update']);
    Route::delete('/{id}', [LocationController::class, 'destroy']);
});
