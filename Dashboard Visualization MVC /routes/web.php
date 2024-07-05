<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\DataController;
use App\Http\Controllers\VisualizationController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


Route::resource('data', DataController::class)->names('data');

Route::get('visualization', [DataController::class, 'visualization'])->name('data.visualization');
Route::post('visualization/filter', [DataController::class, 'visualization']);
Route::get('export', [DataController::class, 'export'])->name('export');
Route::post('import', [DataController::class, 'import'])->name('import');
