<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'slogan',
        'description',
        'phone',
        'email',
        'address',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'pinterest_url',
        'meta_description',
        'google_analytics_id',
        'meta_pixel_id',
        'google_maps_url',
    ];
}
