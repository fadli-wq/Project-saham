<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Jadwal update harga saham secara otomatis
// Akan dijalankan setiap jam 09:00 hingga 16:00 (Jam kerja Bursa) pada hari Senin-Jumat
Schedule::command('saham:update')
    ->weekdays()
    ->hourly()
    ->between('9:00', '16:00')
    ->withoutOverlapping()
    ->appendOutputTo(storage_path('logs/saham-update.log'));
