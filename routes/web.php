<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('competition', [\App\Http\Controllers\CompetitionController::class, 'index'])->name('competition')->middleware('can:admin');
Route::post('competition/create', [\App\Http\Controllers\CompetitionController::class, 'createCompetition'])->name('createCompetition')->middleware('can:admin');
Route::delete('competition/delete/{id}', [\App\Http\Controllers\CompetitionController::class, 'delete'])->middleware('can:admin');
Route::get('competition/update/{id}', [\App\Http\Controllers\CompetitionController::class, 'showUpdate']);
Route::post('competition/update/{id}', [\App\Http\Controllers\CompetitionController::class, 'update']);
Route::get('competitor', [\App\Http\Controllers\CompetitorController::class, 'index'])->name('competitor')->middleware('can:admin');
Route::post('competitor/create', [\App\Http\Controllers\CompetitorController::class, 'createCompetitor'])->name('createCompetitor')->middleware('can:admin');
Route::get('round/{id}', [\App\Http\Controllers\RoundController::class, 'index'])->name('round')->middleware('can:admin');
Route::post('round/create/{id}', [\App\Http\Controllers\RoundController::class, 'createRound'])->name('createRound')->middleware('can:admin');
