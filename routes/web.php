<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmitenController;
use App\Http\Controllers\SectorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/emiten', [EmitenController::class, 'index'])->name('emiten.index');
Route::get('/emiten/watchlist', [EmitenController::class, 'watchlist'])->name('emiten.watchlist');
Route::get('/emiten/compare', [EmitenController::class, 'compare'])->name('emiten.compare');
Route::get('/emiten/{kode}', [EmitenController::class, 'show'])->name('emiten.show');
Route::get('/sektor', [SectorController::class, 'index'])->name('sector.index');
Route::get('/sektor/{slug}', [SectorController::class, 'show'])->name('sector.show');

// TODO: Hapus rute ini setelah berhasil dijalankan di server!
Route::get('/install-db-secret', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
        return "Berhasil! Database MySQL telah di-reset dan diisi ratusan data. <br><br>Log Output:<br>" . nl2br(\Illuminate\Support\Facades\Artisan::output());
    } catch (\Exception $e) {
        return "Gagal: " . $e->getMessage();
    }
});
