<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ElectricController;
use App\Http\Controllers\SurveyController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/electric', [ElectricController::class, 'index'])->name('electric.index');
Route::post('/electric', [ElectricController::class, 'store'])->name('electric.store');
Route::post('/electric/{id}', [ElectricController::class, 'show'])->name('electric.show');
Route::post('/survey/edit/wat',  [ElectricController::class, 'editWatt'])->name('survey.edit.watt');

Route::get('electric/data', [ElectricController::class, 'getData'])->name('electric.data');
Route::get('electric/ajax/data', [ElectricController::class, 'getDataElectric'])->name('electric.getDataElectric');

Route::get('/survey', [SurveyController::class, 'index'])->name('survey.index');
Route::post('/survey', [SurveyController::class, 'storeSurvey'])->name('survey.store');
Route::delete('/survey/{id}', [SurveyController::class, 'deleteSurvey'])->name('survey.delete');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
