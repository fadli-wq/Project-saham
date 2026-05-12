@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    {{-- Hero --}}
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Stock<span class="text-accent">Stats</span> ID</h1>
            <p class="hero-subtitle">Statistik fundamental emiten Indonesia — visualisasi ala game stats</p>
        </div>
        <div class="hero-stats">
            <div class="stat-box">
                <span class="stat-number">{{ $totalEmitens }}</span>
                <span class="stat-label">Emiten</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ number_format($totalMarketCap, 0) }} T</span>
                <span class="stat-label">Total Market Cap</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ $avgPER }}x</span>
                <span class="stat-label">Avg PER</span>
            </div>
        </div>
    </section>

    {{-- Top Gainers & Losers --}}
    <div class="grid-2">
        <section class="card">
            <h2 class="card-title"><span class="badge badge-green">▲</span> Top Gainers (YTD)</h2>
            <div class="mini-list">
                @foreach($topGainers as $e)
                <a href="{{ route('emiten.show', $e->kode) }}" class="mini-item">
                    <div class="mini-left">
                        <span class="mini-kode">{{ $e->kode }}</span>
                        <span class="mini-nama">{{ $e->nama }}</span>
                    </div>
                    <span class="return-badge return-{{ $e->ytd_return >= 0 ? 'pos' : 'neg' }}">
                        {{ $e->ytd_return >= 0 ? '+' : '' }}{{ number_format($e->ytd_return, 2) }}%
                    </span>
                </a>
                @endforeach
            </div>
        </section>
        <section class="card">
            <h2 class="card-title"><span class="badge badge-red">▼</span> Top Losers (YTD)</h2>
            <div class="mini-list">
                @foreach($topLosers as $e)
                <a href="{{ route('emiten.show', $e->kode) }}" class="mini-item">
                    <div class="mini-left">
                        <span class="mini-kode">{{ $e->kode }}</span>
                        <span class="mini-nama">{{ $e->nama }}</span>
                    </div>
                    <span class="return-badge return-{{ $e->ytd_return >= 0 ? 'pos' : 'neg' }}">
                        {{ $e->ytd_return >= 0 ? '+' : '' }}{{ number_format($e->ytd_return, 2) }}%
                    </span>
                </a>
                @endforeach
            </div>
        </section>
    </div>

    {{-- Sectors --}}
    <section class="section">
        <h2 class="section-title">Sektor</h2>
        <div class="grid-3">
            @foreach($sectors as $sector)
            <a href="{{ route('sector.show', $sector->slug) }}" class="sector-card" style="--accent: {{ $sector->color }}">
                <span class="sector-icon">{{ $sector->icon }}</span>
                <h3 class="sector-name">{{ $sector->name }}</h3>
                <span class="sector-count">{{ $sector->emitens_count }} emiten</span>
            </a>
            @endforeach
        </div>
    </section>
</div>
@endsection
