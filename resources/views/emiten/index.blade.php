@extends('layouts.app')
@section('title', 'Daftar Emiten')
@section('content')
<div class="container">
    <h1 class="page-title">Daftar Emiten</h1>

    <form method="GET" class="filter-bar" id="filterForm">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama..." class="input">
        <select name="sector" class="input" onchange="this.form.submit()">
            <option value="">Semua Sektor</option>
            @foreach($sectors as $s)
                <option value="{{ $s->id }}" {{ request('sector') == $s->id ? 'selected' : '' }}>{{ $s->icon }} {{ $s->name }}</option>
            @endforeach
        </select>
        <select name="grade" class="input" onchange="this.form.submit()">
            <option value="">Semua Grade</option>
            <option value="S" {{ request('grade') == 'S' ? 'selected' : '' }}>Grade S</option>
            <option value="A" {{ request('grade') == 'A' ? 'selected' : '' }}>Grade A</option>
            <option value="B" {{ request('grade') == 'B' ? 'selected' : '' }}>Grade B</option>
            <option value="C" {{ request('grade') == 'C' ? 'selected' : '' }}>Grade C</option>
            <option value="D" {{ request('grade') == 'D' ? 'selected' : '' }}>Grade D</option>
            <option value="F" {{ request('grade') == 'F' ? 'selected' : '' }}>Grade F</option>
        </select>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <div class="grid-4">
        @foreach($emitens as $emiten)
        <a href="{{ route('emiten.show', $emiten->kode) }}" class="emiten-card" id="emiten-{{ $emiten->kode }}">
            <div class="emiten-header">
                <div>
                    <span class="emiten-kode">{{ $emiten->kode }}</span>
                    <span class="emiten-grade" style="color:{{ $emiten->grade_color }}">{{ $emiten->stat_grade }}</span>
                </div>
                <button class="watchlist-btn" data-watchlist="{{ $emiten->kode }}" onclick="event.preventDefault(); StockWatchlist.toggle('{{ $emiten->kode }}'); StockWatchlist.updateButtons();">☆</button>
            </div>
            <p class="emiten-nama">{{ $emiten->nama }}</p>
            <p class="emiten-harga">{{ $emiten->formatted_harga }}</p>
            <div class="emiten-stats-mini">
                <span class="return-badge return-{{ $emiten->ytd_return >= 0 ? 'pos' : 'neg' }}">
                    YTD {{ $emiten->ytd_return >= 0 ? '+' : '' }}{{ number_format($emiten->ytd_return, 1) }}%
                </span>
            </div>
            <canvas id="mini-chart-{{ $emiten->kode }}" width="120" height="120" class="mini-radar"></canvas>
        </a>
        @endforeach
    </div>

    <div class="pagination-wrap">{{ $emitens->withQueryString()->links() }}</div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    @foreach($emitens as $emiten)
    (function() {
        const stats = @json($emiten->getRadarStats());
        const ctx = document.getElementById('mini-chart-{{ $emiten->kode }}');
        if (!ctx) return;
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: Object.keys(stats),
                datasets: [{
                    data: Object.values(stats),
                    backgroundColor: 'rgba(99, 102, 241, 0.15)',
                    borderColor: 'rgba(99, 102, 241, 0.8)',
                    borderWidth: 1.5,
                    pointRadius: 2,
                    pointBackgroundColor: 'rgba(99, 102, 241, 1)',
                }]
            },
            options: {
                responsive: false,
                plugins: { legend: { display: false } },
                scales: {
                    r: {
                        beginAtZero: true, max: 10,
                        ticks: { display: false },
                        grid: { color: 'rgba(255,255,255,0.06)' },
                        angleLines: { color: 'rgba(255,255,255,0.06)' },
                        pointLabels: { font: { size: 8 }, color: 'rgba(255,255,255,0.4)' }
                    }
                }
            }
        });
    })();
    @endforeach
});
</script>
@endsection
