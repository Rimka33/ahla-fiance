<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'question',
        'status',
        'admin_response',
        'replied_at',
        'replied_by',
        'published_in_faq',
    ];

    protected $casts = [
        'published_in_faq' => 'boolean',
        'replied_at' => 'datetime',
    ];

    public function repliedBy()
    {
        return $this->belongsTo(User::class, 'replied_by');
    }

    public function faqQuestion()
    {
        return $this->hasOne(FaqQuestion::class);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeUnread($query)
    {
        return $query->whereIn('status', ['new', 'read']);
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }
}
