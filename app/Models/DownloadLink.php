<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadLink extends Model
{
    protected $fillable = [
        'platform',
        'url',
        'icon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByPlatform($query, $platform)
    {
        return $query->where('platform', $platform);
    }
}
