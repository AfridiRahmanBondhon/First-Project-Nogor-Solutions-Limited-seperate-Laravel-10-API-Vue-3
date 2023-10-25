<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NogorController;
use App\Http\Controllers\FormController;

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

Route::get('/form',[FormController::class,'index']);
Route::post('/form',[FormController::class,'store']);
Route::get('/form/{id}',[FormController::class,'show']);
Route::get('/form/{id}/edit',[FormController::class,'edit']);
Route::post('/form/{id}/update',[FormController::class,'update']);
Route::delete('/form/{id}/delete',[FormController::class,'destroy']);
Route::delete('/form/{id}/softdelete',[FormController::class,'softDestroy']);

