<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    public function run(): void
    {
        $sectors = [
            ['name' => 'Perbankan', 'slug' => 'perbankan', 'color' => '#6366f1', 'icon' => '🏦', 'description' => 'Sektor perbankan dan jasa keuangan'],
            ['name' => 'Telekomunikasi', 'slug' => 'telekomunikasi', 'color' => '#06b6d4', 'icon' => '📡', 'description' => 'Sektor telekomunikasi dan infrastruktur digital'],
            ['name' => 'Consumer Goods', 'slug' => 'consumer-goods', 'color' => '#10b981', 'icon' => '🛒', 'description' => 'Sektor barang konsumsi sehari-hari'],
            ['name' => 'Pertambangan', 'slug' => 'pertambangan', 'color' => '#f59e0b', 'icon' => '⛏️', 'description' => 'Sektor pertambangan mineral, batubara, dan logam mulia'],
            ['name' => 'Teknologi', 'slug' => 'teknologi', 'color' => '#8b5cf6', 'icon' => '💻', 'description' => 'Sektor teknologi dan startup digital'],
            ['name' => 'Properti', 'slug' => 'properti', 'color' => '#ec4899', 'icon' => '🏢', 'description' => 'Sektor properti dan real estate'],
            ['name' => 'Energi', 'slug' => 'energi', 'color' => '#ef4444', 'icon' => '⚡', 'description' => 'Sektor energi minyak, gas, dan energi terbarukan'],
            ['name' => 'Infrastruktur', 'slug' => 'infrastruktur', 'color' => '#64748b', 'icon' => '🏗️', 'description' => 'Sektor infrastruktur dan konstruksi'],
            ['name' => 'Healthcare', 'slug' => 'healthcare', 'color' => '#14b8a6', 'icon' => '🏥', 'description' => 'Sektor kesehatan dan farmasi'],
            ['name' => 'Otomotif', 'slug' => 'otomotif', 'color' => '#f97316', 'icon' => '🚗', 'description' => 'Sektor otomotif dan komponen'],
            ['name' => 'Media & Hiburan', 'slug' => 'media-hiburan', 'color' => '#a855f7', 'icon' => '🎬', 'description' => 'Sektor media, hiburan, dan entertainment'],
            ['name' => 'Transportasi', 'slug' => 'transportasi', 'color' => '#0ea5e9', 'icon' => '✈️', 'description' => 'Sektor transportasi dan logistik'],
        ];

        foreach ($sectors as $sector) {
            Sector::create($sector);
        }
    }
}
