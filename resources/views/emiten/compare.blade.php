@extends('layouts.app')
@section('title', 'Compare Emiten')
@section('content')
<div class="container">
    <h1 class="page-title">Bandingkan Emiten</h1>

    <form method="GET" action="{{ route('emiten.compare') }}" class="filter-bar">
        <input type="text" name="codes" value="{{ request('codes') }}" placeholder="Masukkan kode emiten, pisahkan koma (cth: BBCA,AMMN,TLKM)" class="input" style="flex:1">
        <button type="submit" class="btn btn-primary">Bandingkan</button>
    </form>

    @if($emitens->count() > 0)
    <div class="compare-grid" style="grid-template-columns: repeat({{ min($emitens->count(), 3) }}, 1fr)">
        @foreach($emitens as $emiten)
        <div class="compare-card">
            <div class="compare-header" style="border-color: {{ $emiten->sector->color }}">
                <h2 class="compare-kode">{{ $emiten->kode }}</h2>
                <span class="emiten-grade" style="color:{{ $emiten->grade_color }}">{{ $emiten->stat_grade }}</span>
            </div>
            <p class="emiten-nama">{{ $emiten->nama }}</p>
            <p class="emiten-harga">{{ $emiten->formatted_harga }}</p>
            <canvas id="compare-chart-{{ $emiten->kode }}" width="250" height="250"></canvas>
            <div class="kinerja-box compact">
                <ul class="kinerja-list">
                    <li>YTD → <span class="return-badge return-{{ $emiten->ytd_return >= 0 ? 'pos' : 'neg' }}">{{ $emiten->ytd_return >= 0 ? '+' : '' }}{{ number_format($emiten->ytd_return, 2) }}%</span></li>
                    <li>1Y → <span class="return-badge return-{{ $emiten->one_year_return >= 0 ? 'pos' : 'neg' }}">{{ $emiten->one_year_return >= 0 ? '+' : '' }}{{ number_format($emiten->one_year_return, 2) }}%</span></li>
                    <li>3Y → <span class="return-badge return-{{ $emiten->three_year_return >= 0 ? 'pos' : 'neg' }}">{{ $emiten->three_year_return >= 0 ? '+' : '' }}{{ number_format($emiten->three_year_return, 2) }}%</span></li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state">
        <p>Masukkan kode emiten di atas untuk membandingkan (maks 3).</p>
        <p class="text-muted">Contoh: BBCA,AMMN,TLKM</p>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const colors = ['#6366f1','#06b6d4','#f59e0b'];
    let i = 0;
    @foreach($emitens as $emiten)
    (function(){
        const stats = @json($emiten->getRadarStats());
        const ctx = document.getElementById('compare-chart-{{ $emiten->kode }}');
        if (!ctx) return;
        const color = colors[{{ $loop->index }} % 3];
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: Object.keys(stats),
                datasets: [{
                    label: '{{ $emiten->kode }}',
                    data: Object.values(stats),
                    backgroundColor: color + '20',
                    borderColor: color,
                    borderWidth: 2, pointRadius: 4,
                    pointBackgroundColor: color,
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
                        pointLabels: { font: { size: 11, weight: '600' }, color: 'rgba(255,255,255,0.6)' }
                    }
                }
            }
        });
    })();
    @endforeach
});
</script>
@endsection
