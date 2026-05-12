<?php

namespace App\Http\Controllers;

use App\Models\Emiten;
use App\Models\Sector;
use Illuminate\Http\Request;

class EmitenController extends Controller
{
    public function index(Request $request)
    {
        $query = Emiten::with('sector');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('kode', 'like', "%{$s}%")
                  ->orWhere('nama', 'like', "%{$s}%");
            });
        }

        if ($request->filled('sector')) {
            $query->where('sector_id', $request->sector);
        }

        $sort = $request->get('sort', 'kode');
        $dir = $request->get('dir', 'asc');
        $allowed = ['kode','nama','harga','market_cap','npm','per','pbv','der','ytd_return','one_year_return'];
        
        if ($request->filled('grade')) {
            // Karena grade dihitung dinamis di Model, kita perlu filter dari Collection
            $allEmitens = $query->get();
            $filtered = $allEmitens->filter(function($e) use ($request) {
                return $e->stat_grade === strtoupper($request->grade);
            });
            
            // Sorting collection
            if (in_array($sort, $allowed)) {
                $filtered = $dir === 'desc' 
                    ? $filtered->sortByDesc($sort) 
                    : $filtered->sortBy($sort);
            }
            
            // Manual pagination
            $page = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;
            $perPage = 20;
            $emitens = new \Illuminate\Pagination\LengthAwarePaginator(
                $filtered->forPage($page, $perPage),
                $filtered->count(),
                $perPage,
                $page,
                ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
            );
        } else {
            // Jika tidak ada filter grade, gunakan DB pagination agar lebih optimal
            if (in_array($sort, $allowed)) {
                $query->orderBy($sort, $dir === 'desc' ? 'desc' : 'asc');
            }
            $emitens = $query->paginate(20);
        }

        $sectors = Sector::orderBy('name')->get();

        return view('emiten.index', compact('emitens', 'sectors'));
    }

    public function show(string $kode)
    {
        $emiten = Emiten::with('sector')->where('kode', strtoupper($kode))->firstOrFail();
        $sectorPeers = Emiten::where('sector_id', $emiten->sector_id)
            ->where('id', '!=', $emiten->id)
            ->limit(4)->get();

        return view('emiten.show', compact('emiten', 'sectorPeers'));
    }

    public function compare(Request $request)
    {
        $codes = $request->get('codes', '');
        $codeList = array_filter(array_map('trim', explode(',', $codes)));
        $emitens = collect();
        if (!empty($codeList)) {
            $emitens = Emiten::with('sector')->whereIn('kode', array_map('strtoupper', $codeList))->get();
        }
        $allEmitens = Emiten::orderBy('kode')->get(['id', 'kode', 'nama']);

        return view('emiten.compare', compact('emitens', 'allEmitens'));
    }

    public function watchlist(Request $request)
    {
        $codes = $request->get('codes', '');
        $codeList = array_filter(array_map('trim', explode(',', $codes)));
        
        $emitens = collect();
        if (!empty($codeList)) {
            $emitens = Emiten::with('sector')->whereIn('kode', array_map('strtoupper', $codeList))->get();
        }

        return view('emiten.watchlist', compact('emitens'));
    }
}
