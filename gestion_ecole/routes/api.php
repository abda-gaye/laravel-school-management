<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\NiveauController;
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

Route::get("/classes/{classe}", [ClasseController::class, 'find']);
Route::get("/niveau", [NiveauController::class, 'index']);
Route::get("/niveau/{niveau}", [NiveauController::class, 'find'])->where('id', '[0-9]+');
Route::apiResource('/eleves',EleveController::class)->only(['store','index']);
Route::apiResource('/inscription',InscriptionController::class)->only(['store']);

Route::get('/classes/{id}/listes', [EleveController::class, 'indexByClass']);
//Route::post('/evaluation', [EvaluationController::class, 'store']);
//Route::post('classes/{id}/coef', [EvaluationController::class, 'store']);
Route::post('classes/{id}/coef', [DisciplineController::class, 'store']);
Route::apiResource('/discipline',DisciplineController::class)->only(['store','index']);
