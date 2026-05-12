<?php

namespace App\Http\Controllers;

use App\Models\Sector;

class SectorController extends Controller
{
    public function index()
    {
        $sectors = Sector::withCount('emitens')->get();
        return view('sector.index', compact('sectors'));
    }

    public function show(string $slug)
    {
        $sector = Sector::where('slug', $slug)->firstOrFail();
        $emitens = $sector->emitens()->orderByDesc('market_cap')->get();
        return view('sector.show', compact('sector', 'emitens'));
    }
}
