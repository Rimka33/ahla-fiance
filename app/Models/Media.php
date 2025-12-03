<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'title',
        'file_path',
        'file_type',
        'mime_type',
        'file_size',
        'alt_text',
        'description',
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    public function scopeImages($query)
    {
        return $query->where('file_type', 'image');
    }

    public function scopeVideos($query)
    {
        return $query->where('file_type', 'video');
    }

    public function scopeDocuments($query)
    {
        return $query->where('file_type', 'document');
    }
}
