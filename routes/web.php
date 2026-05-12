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
