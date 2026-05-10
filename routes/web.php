<?php

use App\Http\Controllers\API\LKPDController;
use Illuminate\Support\Facades\Route;

Route::get('/sorting', function () {
    return view('lkpd');
})->name('sorting.view');

Route::post('/simpan-hasil', [LKPDController::class, 'store'])->name('sorting.store');
Route::get('/lkpd-stats', [LKPDController::class, 'getStats'])->name('sorting.stats');