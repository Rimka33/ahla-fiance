<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'author',
        'published_at',
        'is_published',
        'is_featured',
        'views_count',
        'meta_title',
        'meta_description',
        'category_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'views_count' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });

        static::updating(function ($news) {
            if ($news->isDirty('title') && empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc');
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function category()
    {
        return $this->belongsTo(NewsCategory::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where(function($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            });
    }

    public function scopeScheduled($query)
    {
        return $query->where('is_published', true)
            ->where('published_at', '>', now());
    }
}
