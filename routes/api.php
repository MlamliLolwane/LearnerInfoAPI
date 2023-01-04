<?php

use App\Http\Controllers\LearnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/learners/store', [LearnerController::class, 'store']);
Route::get('/learners/index', [LearnerController::class, 'index']);
Route::get('/learners/show/{learner_id}', [LearnerController::class, 'show']);
Route::patch('/learners/update/{learner_id}', [LearnerController::class, 'update']);
Route::delete('/learners/destroy/{id}', [LearnerController::class, 'destroy']);