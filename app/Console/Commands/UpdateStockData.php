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
        $this->info("Memulai update data saham dari Yahoo Finance untuk {$emitens->count()} emiten...");

        $bar = $this->output->createProgressBar($emitens->count());
        $bar->start();

        foreach ($emitens as $emiten) {
            // Format kode saham untuk Yahoo Finance Indonesia (tambah .JK)
            $symbol = $emiten->kode . '.JK';
            
            try {
                // Menggunakan endpoint Chart API v8 yang tidak memerlukan Crumb/Auth
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
                ])->get("https://query2.finance.yahoo.com/v8/finance/chart/{$symbol}");

                if ($response->successful()) {
                    $data = $response->json();
                    
                    if (isset($data['chart']['result'][0]['meta']['regularMarketPrice'])) {
                        $meta = $data['chart']['result'][0]['meta'];
                        $price = $meta['regularMarketPrice'];
                        
                        // Update database
                        $emiten->update([
                            'harga' => $price,
                            // Touch updated_at agar waktu terakhir diperbarui berubah
                            'updated_at' => now(),
                        ]);
                    }
                }
            } catch (\Exception $e) {
                $this->error("\nGagal update {$emiten->kode}: " . $e->getMessage());
            }

            $bar->advance();
            // Jeda 500ms agar tidak terkena rate limit dari Yahoo
            usleep(500000);
        }

        $bar->finish();
        $this->info("\nBerhasil mengupdate data saham!");
    }
}
