<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'event_at',
        'image_path',
        'slug',
        'description',
        'location',
        'category',
        'badge',
        'is_featured',
        'requires_registration',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'event_at'               => 'datetime',
        'is_active'              => 'boolean',
        'is_featured'            => 'boolean',
        'requires_registration'  => 'boolean',
        'sort_order'             => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_at', '>=', now())->orderBy('event_at');
    }
}
