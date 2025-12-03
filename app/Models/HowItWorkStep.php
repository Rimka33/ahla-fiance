<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowItWorkStep extends Model
{
    protected $fillable = [
        'title',
        'description',
        'tag_text',
        'icon',
        'step_number',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'step_number' => 'integer',
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('step_number');
    }
}
