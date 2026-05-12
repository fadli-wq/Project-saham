<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sector extends Model
{
    protected $fillable = [
        'name', 'slug', 'color', 'icon', 'description',
    ];

    public function emitens(): HasMany
    {
        return $this->hasMany(Emiten::class);
    }

    public function getEmitenCountAttribute(): int
    {
        return $this->emitens()->count();
    }

    public function getAvgMarketCapAttribute(): float
    {
        return round($this->emitens()->avg('market_cap') ?? 0, 2);
    }
}
