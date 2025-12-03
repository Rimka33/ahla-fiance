<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = [
        'users_count',
        'users_suffix',
        'reviews_count',
        'reviews_suffix',
        'countries_count',
        'countries_suffix',
        'subscribers_count',
        'subscribers_suffix',
    ];

    protected $casts = [
        'users_count' => 'integer',
        'reviews_count' => 'integer',
        'countries_count' => 'integer',
        'subscribers_count' => 'integer',
    ];
}
