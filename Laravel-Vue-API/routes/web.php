<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NogorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/form',[NogorController::class,'index'])->name('home');
Route::get('/form/add',[NogorController::class,'add'])->name('add');
Route::post('/form/store',[NogorController::class,'store'])->name('store');
Route::get('/form/edit/{id}',[NogorController::class,'edit'])->name('edit');
Route::post('/form/update/{id}',[NogorController::class,'update'])->name('update');
Route::delete('/form/delete/{id}',[NogorController::class,'destroy'])->name('delete');*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    /*Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');*/

    Route::get('/form',[NogorController::class,'index'])->name('home');
    Route::get('/form/add',[NogorController::class,'add'])->name('add');
    Route::post('/form/store',[NogorController::class,'store'])->name('store');
    Route::get('/form/edit/{id}',[NogorController::class,'edit'])->name('edit');
    Route::post('/form/update/{id}',[NogorController::class,'update'])->name('update');
    Route::delete('/form/delete/{id}',[NogorController::class,'destroy'])->name('delete');

});
