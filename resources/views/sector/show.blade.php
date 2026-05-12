@extends('layouts.app')
@section('title', $sector->name)
@section('content')
<div class="container">
    <a href="{{ route('sector.index') }}" class="back-link">← Kembali</a>
    <div class="sector-hero" style="--accent: {{ $sector->color }}">
        <span class="sector-icon-lg">{{ $sector->icon }}</span>
        <h1 class="page-title">{{ $sector->name }}</h1>
        <p class="text-muted">{{ $sector->description }}</p>
    </div>

    <div class="grid-2">
        @foreach($emitens as $emiten)
        <div class="stat-card-full">
            <div class="stat-card-left">
                <canvas id="sector-chart-{{ $emiten->kode }}" width="200" height="200"></canvas>
            </div>
            <div class="stat-card-right">
                <a href="{{ route('emiten.show', $emiten->kode) }}" class="stat-card-link">
                    <h2 class="stat-card-kode">{{ $emiten->kode }}</h2>
                    <span class="emiten-grade" style="color:{{ $emiten->grade_color }}">{{ $emiten->stat_grade }}</span>
                </a>
                <p class="emiten-nama">{{ $emiten->nama }}</p>
                <p class="emiten-harga">{{ $emiten->formatted_harga }}</p>
                <div class="kinerja-box compact">
                    <h4>Kinerja harga saham:</h4>
                    <ul class="kinerja-list">
                        <li>YTD ——→ <span class="return-badge return-{{ $emiten->ytd_return >= 0 ? 'pos' : 'neg' }}">{{ $emiten->ytd_return >= 0 ? '+' : '' }}{{ number_format($emiten->ytd_return, 2) }}%</span></li>
                        <li>1Y ——→ <span class="return-badge return-{{ $emiten->one_year_return >= 0 ? 'pos' : 'neg' }}">{{ $emiten->one_year_return >= 0 ? '+' : '' }}{{ number_format($emiten->one_year_return, 2) }}%</span></li>
                        <li>3Y ——→ <span class="return-badge return-{{ $emiten->three_year_return >= 0 ? 'pos' : 'neg' }}">{{ $emiten->three_year_return >= 0 ? '+' : '' }}{{ number_format($emiten->three_year_return, 2) }}%</span></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    @foreach($emitens as $emiten)
    (function(){
        const stats = @json($emiten->getRadarStats());
        const ctx = document.getElementById('sector-chart-{{ $emiten->kode }}');
        if (!ctx) return;
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: Object.keys(stats),
                datasets: [{
                    data: Object.values(stats),
                    backgroundColor: '{{ $sector->color }}20',
                    borderColor: '{{ $sector->color }}',
                    borderWidth: 2, pointRadius: 3,
                    pointBackgroundColor: '{{ $sector->color }}',
                }]
            },
            options: {
                responsive: false,
                plugins: { legend: { display: false } },
                scales: {
                    r: {
                        beginAtZero: true, max: 10,
                        ticks: { stepSize: 2, color: 'rgba(255,255,255,0.3)', backdropColor: 'transparent' },
                        grid: { color: 'rgba(255,255,255,0.08)' },
                        angleLines: { color: 'rgba(255,255,255,0.08)' },
                        pointLabels: { font: { size: 10, weight: '600' }, color: 'rgba(255,255,255,0.6)' }
                    }
                }
            }
        });
    })();
    @endforeach
});
</script>
@endsection
