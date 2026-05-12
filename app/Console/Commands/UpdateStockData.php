<?php

namespace App\Console\Commands;

use App\Models\Emiten;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateStockData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'saham:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape harga terbaru dari Yahoo Finance API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $emitens = Emiten::all();
        $total = $emitens->count();
        $this->info("Memulai update data saham massal untuk {$total} emiten...");

        // Kita proses dalam kelompok (chunk) berisi 50 saham agar tidak ditolak Yahoo
        $chunks = $emitens->chunk(50);
        
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        foreach ($chunks as $chunk) {
            $symbols = $chunk->map(fn($e) => $e->kode . '.JK')->implode(',');
            
            try {
                // Menggunakan Quote API v7 yang mendukung multiple symbols
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
                ])->get("https://query2.finance.yahoo.com/v7/finance/quote?symbols={$symbols}");

                if ($response->successful()) {
                    $results = $response->json()['quoteResponse']['result'] ?? [];
                    
                    foreach ($results as $quote) {
                        $kode = str_replace('.JK', '', $quote['symbol']);
                        $emiten = $chunk->where('kode', $kode)->first();
                        
                        if ($emiten) {
                            $emiten->update([
                                'harga' => $quote['regularMarketPrice'] ?? $emiten->harga,
                                'ytd_return' => $quote['regularMarketChangePercent'] ?? $emiten->ytd_return,
                                'market_cap' => isset($quote['marketCap']) ? ($quote['marketCap'] / 1000000000000) : $emiten->market_cap, // Convert to Trillion
                                'volume' => $quote['regularMarketVolume'] ?? $emiten->volume,
                                'per' => $quote['trailingPE'] ?? $emiten->per,
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } catch (\Exception $e) {
                $this->error("\nGagal update kelompok: " . $e->getMessage());
            }

            $bar->advance($chunk->count());
            // Jeda singkat antar kelompok
            usleep(200000);
        }

        $bar->finish();
        $this->info("\nBerhasil mengupdate seluruh data statistik!");
    }
}
