<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageSection extends Model
{
    protected $fillable = [
        'section_key',
        'title',
        'content',
        'subtitle',
        'badge_text',
        'button_text',
        'button_link',
        'image',
        'video_thumbnail',
        'video_url',
        'description',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public static function getByKey($key)
    {
        return static::where('section_key', $key)->where('is_active', true)->first();
    }
}
