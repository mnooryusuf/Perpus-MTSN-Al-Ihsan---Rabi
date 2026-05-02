<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;

Route::redirect('/', '/admin');

Route::get('/export/laporan', [ExportController::class, 'export'])
    ->middleware(['web'])
    ->name('laporan.export');
