@extends('layouts.app')
@section('title', 'Sektor')
@section('content')
<div class="container">
    <h1 class="page-title">Sektor Pasar</h1>
    <div class="grid-3">
        @foreach($sectors as $sector)
        <a href="{{ route('sector.show', $sector->slug) }}" class="sector-card" style="--accent: {{ $sector->color }}">
            <span class="sector-icon">{{ $sector->icon }}</span>
            <h3 class="sector-name">{{ $sector->name }}</h3>
            <span class="sector-count">{{ $sector->emitens_count }} emiten</span>
            <p class="sector-desc">{{ $sector->description }}</p>
        </a>
        @endforeach
    </div>
</div>
@endsection
