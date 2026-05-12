<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'StockStats ID') — Statistik Saham Indonesia</title>
    <meta name="description" content="Statistik fundamental saham emiten Indonesia dengan visualisasi radar chart bergaya game stats">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    {{-- Navigation --}}
    <nav class="navbar" id="mainNav">
        <div class="nav-container">
            <a href="{{ route('dashboard') }}" class="nav-logo">
                <span class="logo-icon">📊</span>
                <span class="logo-text">Stock<span class="logo-accent">Stats</span></span>
            </a>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('emiten.index') }}" class="nav-link {{ request()->routeIs('emiten.index', 'emiten.show') ? 'active' : '' }}">Emiten</a>
                <a href="{{ route('sector.index') }}" class="nav-link {{ request()->routeIs('sector.*') ? 'active' : '' }}">Sektor</a>
                <a href="{{ route('emiten.compare') }}" class="nav-link {{ request()->routeIs('emiten.compare') ? 'active' : '' }}">Compare</a>
                <a href="{{ route('emiten.watchlist') }}" class="nav-link {{ request()->routeIs('emiten.watchlist') ? 'active' : '' }}" style="color: #ffd700;">⭐ Watchlist</a>
            </div>
            <button class="nav-toggle" id="navToggle" onclick="document.querySelector('.nav-links').classList.toggle('show')">☰</button>
        </div>
    </nav>

    <main class="main-content">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <p>© {{ date('Y') }} StockStats ID — Data bersifat ilustratif, bukan rekomendasi investasi.</p>
            @php
                $lastUpdated = \App\Models\Emiten::max('updated_at');
            @endphp
            <p style="margin-top: 8px; font-size: 0.85rem; color: var(--accent);">
                <span class="logo-icon" style="font-size: 0.9rem;">⏱️</span> Data terakhir diperbarui: {{ $lastUpdated ? \Carbon\Carbon::parse($lastUpdated)->locale('id')->diffForHumans() : 'Belum diupdate' }}
            </p>
        </div>
    </footer>

    @yield('scripts')

    <script>
    // Watchlist using localStorage
    window.StockWatchlist = {
        KEY: 'stock_watchlist',
        get() {
            return JSON.parse(localStorage.getItem(this.KEY) || '[]');
        },
        has(kode) {
            return this.get().includes(kode);
        },
        toggle(kode) {
            let list = this.get();
            if (list.includes(kode)) {
                list = list.filter(k => k !== kode);
            } else {
                list.push(kode);
            }
            localStorage.setItem(this.KEY, JSON.stringify(list));
            return list.includes(kode);
        },
        updateButtons() {
            document.querySelectorAll('[data-watchlist]').forEach(btn => {
                const kode = btn.dataset.watchlist;
                const isWatched = this.has(kode);
                btn.classList.toggle('watched', isWatched);
                btn.innerHTML = isWatched ? '★' : '☆';
                btn.title = isWatched ? 'Hapus dari Watchlist' : 'Tambah ke Watchlist';
            });
        }
    };
    document.addEventListener('DOMContentLoaded', () => StockWatchlist.updateButtons());
    </script>
</body>
</html>
