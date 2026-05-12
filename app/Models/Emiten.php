<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emiten extends Model
{
    protected $fillable = [
        'sector_id', 'kode', 'nama', 'deskripsi', 'harga',
        'market_cap', 'npm', 'per', 'pbv', 'der', 'roe', 'roa',
        'dividend_yield', 'ytd_return', 'one_year_return', 'three_year_return', 'volume',
    ];

    protected $casts = [
        'market_cap' => 'float',
        'npm' => 'float',
        'per' => 'float',
        'pbv' => 'float',
        'der' => 'float',
        'roe' => 'float',
        'roa' => 'float',
        'dividend_yield' => 'float',
        'ytd_return' => 'float',
        'one_year_return' => 'float',
        'three_year_return' => 'float',
    ];

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    /**
     * Normalize a value to 0-10 scale for radar chart
     * Uses min-max normalization with predefined ranges per metric
     */
    public function getRadarStats(): array
    {
        return [
            'Market Cap' => $this->normalizeValue($this->market_cap, 0, 1500, false),
            'NPM'        => $this->normalizeValue($this->npm, -20, 50, false),
            'PBV'        => $this->normalizeValue($this->pbv, 0, 10, true), // lower is better
            'PER'        => $this->normalizeValue($this->per, 0, 50, true), // lower is better
            'DER'        => $this->normalizeValue($this->der, 0, 5, true),  // lower is better
        ];
    }

    /**
     * Get overall stat score (0-100) based on fundamentals
     */
    public function getStatScoreAttribute(): int
    {
        $stats = $this->getRadarStats();
        $avg = array_sum($stats) / max(count($stats), 1);
        return (int) round($avg * 10);
    }

    /**
     * Get stat grade (S, A, B, C, D, F)
     */
    public function getStatGradeAttribute(): string
    {
        $score = $this->stat_score;
        if ($score >= 85) return 'S';
        if ($score >= 70) return 'A';
        if ($score >= 55) return 'B';
        if ($score >= 40) return 'C';
        if ($score >= 25) return 'D';
        return 'F';
    }

    /**
     * Get grade color for UI
     */
    public function getGradeColorAttribute(): string
    {
        return match($this->stat_grade) {
            'S' => '#ffd700',
            'A' => '#00ff88',
            'B' => '#4ecdc4',
            'C' => '#f59e0b',
            'D' => '#ef4444',
            'F' => '#6b7280',
            default => '#6b7280',
        };
    }

    /**
     * Normalize value to 0-10 scale
     */
    private function normalizeValue(float $value, float $min, float $max, bool $inverted = false): float
    {
        $clamped = max($min, min($max, $value));
        $normalized = ($clamped - $min) / max(($max - $min), 0.01);
        if ($inverted) {
            $normalized = 1 - $normalized;
        }
        return round($normalized * 10, 1);
    }

    /**
     * Format market cap in human-readable format (T for Triliun)
     */
    public function getFormattedMarketCapAttribute(): string
    {
        if ($this->market_cap >= 1000) {
            return number_format($this->market_cap / 1000, 1) . ' Kuadriliun';
        }
        if ($this->market_cap >= 1) {
            return number_format($this->market_cap, 1) . ' T';
        }
        return number_format($this->market_cap * 1000, 0) . ' M';
    }

    /**
     * Format price in Rupiah
     */
    public function getFormattedHargaAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
