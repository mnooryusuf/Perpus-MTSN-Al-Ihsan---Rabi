<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Auth;

Route::redirect('/', '/admin');

Route::get('/export/laporan', [ExportController::class, 'export'])
    ->middleware(['web'])
    ->name('laporan.export');

Route::get('/app/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/app/login');
})->name('app.logout.get');

Route::get('/admin/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/admin/login');
})->name('admin.logout.get');

