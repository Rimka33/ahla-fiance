<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'client_name',
        'photo',
        'testimonial_text',
        'rating',
        'date',
        'is_active',
    ];

    protected $casts = [
        'rating' => 'integer',
        'date' => 'date',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
