<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/export/laporan', [ExportController::class, 'export'])
    ->middleware(['web'])
    ->name('laporan.export');
