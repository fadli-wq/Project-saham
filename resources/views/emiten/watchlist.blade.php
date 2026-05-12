@extends('layouts.app')
@section('title', 'Watchlist Saya')
@section('content')
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h1 class="page-title" style="margin-bottom: 0;">⭐ Watchlist Saya</h1>
        <button onclick="showClearModal()" class="btn btn-danger" style="background: var(--red-dim); color: var(--red); border: 1px solid var(--red);">Hapus Semua</button>
    </div>

    @if(request()->has('codes') && $emitens->count() > 0)
        <div class="grid-4">
            @foreach($emitens as $emiten)
            <a href="{{ route('emiten.show', $emiten->kode) }}" class="emiten-card" id="emiten-{{ $emiten->kode }}">
                <div class="emiten-header">
                    <div>
                        <span class="emiten-kode">{{ $emiten->kode }}</span>
                        <span class="emiten-grade" style="color:{{ $emiten->grade_color }}">{{ $emiten->stat_grade }}</span>
                    </div>
                    <button class="watchlist-btn active" style="color: #ffd700;" data-watchlist="{{ $emiten->kode }}" onclick="event.preventDefault(); removeFromWatchlist('{{ $emiten->kode }}');">☆</button>
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
    @elseif(request()->has('codes'))
        <div class="empty-state">
            <p>Anda belum menambahkan saham apapun ke Watchlist.</p>
            <p class="text-muted">Klik ikon bintang (☆) pada halaman daftar emiten untuk menyimpannya di sini.</p>
            <a href="{{ route('emiten.index') }}" class="btn btn-primary" style="margin-top: 16px;">Cari Emiten</a>
        </div>
    @else
        <div class="empty-state">
            <p>Memuat data Watchlist Anda...</p>
        </div>
    @endif
</div>

<!-- Custom Modal Warning -->
<div id="deleteModal" class="modal-overlay" style="display: none;">
    <div class="modal-box">
        <div class="modal-icon">⚠️</div>
        <h3 class="modal-title">Kosongkan Watchlist?</h3>
        <p class="modal-desc">Semua saham favorit yang telah Anda simpan akan dihapus. Anda tidak dapat membatalkan tindakan ini.</p>
        <div class="modal-actions">
            <button onclick="closeModal()" class="btn" style="background: var(--bg-secondary); color: var(--text-primary); border: 1px solid var(--border);">Batal</button>
            <button onclick="confirmClear()" class="btn" style="background: var(--red); color: white;">Ya, Hapus Semua</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Jika tidak ada parameter codes di URL, baca dari localStorage lalu redirect
    const urlParams = new URLSearchParams(window.location.search);
    if (!urlParams.has('codes')) {
        const list = StockWatchlist.get();
        window.location.href = "{{ route('emiten.watchlist') }}?codes=" + list.join(',');
        return;
    }

    // Render chart mini
    @if(isset($emitens))
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
    @endif
    // ... existing ...
});

function removeFromWatchlist(kode) {
    StockWatchlist.toggle(kode);
    const list = StockWatchlist.get();
    window.location.href = "{{ route('emiten.watchlist') }}?codes=" + list.join(',');
}

function showClearModal() {
    const modal = document.getElementById('deleteModal');
    modal.style.display = 'flex';
    // Gunakan setTimeout untuk memicu animasi CSS transition
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
}

function closeModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('show');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300); // Sesuaikan dengan durasi transition CSS
}

function confirmClear() {
    localStorage.setItem(StockWatchlist.KEY, '[]');
    window.location.href = "{{ route('emiten.watchlist') }}?codes=";
}
</script>
@endsection
