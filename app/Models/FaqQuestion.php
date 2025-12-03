<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqQuestion extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'category',
        'order',
        'is_published',
        'is_featured',
        'client_email',
        'admin_notes',
        'status',
        'answered_at',
        'contact_message_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'order' => 'integer',
        'answered_at' => 'datetime',
    ];

    public function contactMessage()
    {
        return $this->belongsTo(ContactMessage::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
