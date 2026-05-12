<?php

namespace App\Http\Controllers;

use App\Models\Emiten;
use App\Models\Sector;

class DashboardController extends Controller
{
    public function index()
    {
        $topGainers = Emiten::orderByDesc('ytd_return')->limit(5)->get();
        $topLosers = Emiten::orderBy('ytd_return')->limit(5)->get();
        $sectors = Sector::withCount('emitens')->get();
        $totalEmitens = Emiten::count();
        $avgPER = round(Emiten::where('per', '>', 0)->avg('per'), 1);
        $totalMarketCap = round(Emiten::sum('market_cap'), 1);

        return view('dashboard', compact(
            'topGainers', 'topLosers', 'sectors', 'totalEmitens', 'avgPER', 'totalMarketCap'
        ));
    }
}
