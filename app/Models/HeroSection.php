<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'main_title',
        'subtitle',
        'description',
        'typed_strings',
        'background_image',
        'cta_button_text',
        'cta_button_link',
        'video_url',
        'order',
        'is_active',
    ];

    protected $casts = [
        'typed_strings' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
