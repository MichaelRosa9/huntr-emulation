<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\StageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/stage', [StageController::class, 'index']);

Route::get('/job', [JobController::class, 'index']);
Route::post('/job', [JobController::class, 'store']);
Route::patch('/job', [JobController::class, 'update']);
Route::delete('/job', [JobController::class, 'delete']);
