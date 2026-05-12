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

// Rute darurat untuk update harga jika terminal tidak bisa diakses
Route::get('/update-harga-manual', function () {
    // Set time limit ke 0 agar browser tidak timeout (karena proses 500 saham sangat lama)
    set_time_limit(0);
    
    try {
        echo "Sedang memproses 500+ emiten... Mohon tunggu dan jangan tutup halaman ini.<br>";
        \Illuminate\Support\Facades\Artisan::call('saham:update');
        return "Berhasil! Seluruh harga saham telah diperbarui ke data terbaru. <br><br>Log:<br>" . nl2br(\Illuminate\Support\Facades\Artisan::output());
    } catch (\Exception $e) {
        return "Gagal melakukan update: " . $e->getMessage();
    }
});
