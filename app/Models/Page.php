<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'badge_text',
        'subtitle',
        'content',
        'image',
        'meta_title',
        'meta_description',
        'is_published',
        // Champs pour page Contact
        'form_badge',
        'form_title',
        'form_description',
        // Champs pour page À propos
        'presentation_who',
        'presentation_mission',
        'presentation_vision',
        'why_content',
        'engagements_content',
        // Champs pour page FAQ
        'ask_question_title',
        'ask_question_subtitle',
        'ask_question_description',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });

        static::updating(function ($page) {
            if ($page->isDirty('title') && empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
