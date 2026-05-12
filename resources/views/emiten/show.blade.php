@extends('layouts.app')
@section('title', $emiten->kode . ' — ' . $emiten->nama)
@section('content')
<div class="container">
    <a href="{{ route('emiten.index') }}" class="back-link">← Kembali</a>

    <div class="detail-hero">
        <div class="detail-info">
            <div class="detail-top">
                <h1 class="detail-kode">{{ $emiten->kode }}</h1>
                <span class="grade-badge" style="background:{{ $emiten->grade_color }}20; color:{{ $emiten->grade_color }}; border:1px solid {{ $emiten->grade_color }}40">
                    Grade {{ $emiten->stat_grade }} · Score {{ $emiten->stat_score }}
                </span>
                <button class="watchlist-btn lg" data-watchlist="{{ $emiten->kode }}" onclick="StockWatchlist.toggle('{{ $emiten->kode }}'); StockWatchlist.updateButtons();">☆</button>
            </div>
            <p class="detail-nama">{{ $emiten->nama }}</p>
            <span class="sector-tag" style="--accent:{{ $emiten->sector->color }}">{{ $emiten->sector->icon }} {{ $emiten->sector->name }}</span>
            <p class="detail-harga">{{ $emiten->formatted_harga }}</p>
            <p class="detail-mcap">Market Cap: {{ $emiten->formatted_market_cap }}</p>

            <div class="kinerja-box">
                <h3>Kinerja harga saham:</h3>
                <ul class="kinerja-list">
                    <li>YTD ——→ <span class="return-badge return-{{ $emiten->ytd_return >= 0 ? 'pos' : 'neg' }}">{{ $emiten->ytd_return >= 0 ? '+' : '' }}{{ number_format($emiten->ytd_return, 2) }}%</span></li>
                    <li>1Y ——→ <span class="return-badge return-{{ $emiten->one_year_return >= 0 ? 'pos' : 'neg' }}">{{ $emiten->one_year_return >= 0 ? '+' : '' }}{{ number_format($emiten->one_year_return, 2) }}%</span></li>
                    <li>3Y ——→ <span class="return-badge return-{{ $emiten->three_year_return >= 0 ? 'pos' : 'neg' }}">{{ $emiten->three_year_return >= 0 ? '+' : '' }}{{ number_format($emiten->three_year_return, 2) }}%</span></li>
                </ul>
            </div>
        </div>
        <div class="detail-chart">
            <canvas id="radarChart" width="350" height="350"></canvas>
        </div>
    </div>

    {{-- Detailed Metrics --}}
    <section class="card metrics-card">
        <h2 class="card-title">Detail Fundamental</h2>
        <div class="metrics-grid">
            @foreach([
                ['PER', $emiten->per, 'x', 'lower'],
                ['PBV', $emiten->pbv, 'x', 'lower'],
                ['DER', $emiten->der, 'x', 'lower'],
                ['NPM', $emiten->npm, '%', 'higher'],
                ['ROE', $emiten->roe, '%', 'higher'],
                ['ROA', $emiten->roa, '%', 'higher'],
                ['Div Yield', $emiten->dividend_yield, '%', 'higher'],
            ] as [$label, $value, $suffix, $better])
            <div class="metric-item">
                <span class="metric-label">{{ $label }}</span>
                <span class="metric-value">{{ number_format($value, 2) }}{{ $suffix }}</span>
                <div class="metric-bar">
                    <div class="metric-fill" style="width: {{ min(abs($value) / ($suffix == '%' ? 50 : 10) * 100, 100) }}%; background: {{ $value > 0 ? ($better == 'higher' ? '#00ff88' : '#f59e0b') : '#ef4444' }}"></div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Sector Peers --}}
    @if($sectorPeers->count() > 0)
    <section class="section">
        <h2 class="section-title">Emiten Lain di {{ $emiten->sector->name }}</h2>
        <div class="grid-4">
            @foreach($sectorPeers as $peer)
            <a href="{{ route('emiten.show', $peer->kode) }}" class="emiten-card">
                <div class="emiten-header">
                    <span class="emiten-kode">{{ $peer->kode }}</span>
                    <span class="emiten-grade" style="color:{{ $peer->grade_color }}">{{ $peer->stat_grade }}</span>
                </div>
                <p class="emiten-nama">{{ $peer->nama }}</p>
                <p class="emiten-harga">{{ $peer->formatted_harga }}</p>
            </a>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stats = @json($emiten->getRadarStats());
    const ctx = document.getElementById('radarChart').getContext('2d');

    const gradient = ctx.createRadialGradient(175, 175, 0, 175, 175, 175);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.3)');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0.05)');

    new Chart(ctx, {
        type: 'radar',
        data: {
            labels: Object.keys(stats),
            datasets: [{
                label: '{{ $emiten->kode }}',
                data: Object.values(stats),
                backgroundColor: gradient,
                borderColor: 'rgba(99, 102, 241, 0.9)',
                borderWidth: 2.5,
                pointRadius: 5,
                pointBackgroundColor: '#6366f1',
                pointBorderColor: '#fff',
                pointBorderWidth: 1,
                pointHoverRadius: 8,
            }]
        },
        options: {
            responsive: false,
            animation: { duration: 1200, easing: 'easeOutQuart' },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(10,14,39,0.95)',
                    titleColor: '#fff',
                    bodyColor: '#a5b4fc',
                    borderColor: '#6366f1',
                    borderWidth: 1,
                }
            },
            scales: {
                r: {
                    beginAtZero: true, max: 10,
                    ticks: { stepSize: 2, color: 'rgba(255,255,255,0.3)', backdropColor: 'transparent', font: { size: 11 } },
                    grid: { color: 'rgba(255,255,255,0.08)' },
                    angleLines: { color: 'rgba(255,255,255,0.08)' },
                    pointLabels: { font: { size: 13, weight: '600', family: 'Inter' }, color: 'rgba(255,255,255,0.7)' }
                }
            }
        }
    });
});
</script>
@endsection
