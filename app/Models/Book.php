<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $fillable = [
        'leader_id',
        'title',
        'author',
        'slug',
        'subtitle',
        'description',
        'featured_image',
        'is_published',
        'page_count',
        'publisher',
        'published_month',
        'amazon_url',
        'kindle_url',
        'isbn',
        'language',
        'format',
        'categories',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'page_count'   => 'integer',
        'categories'   => 'array',
    ];

    public function leader(): BelongsTo
    {
        return $this->belongsTo(Leader::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image ? asset('storage/' . $this->featured_image) : null;
    }
}
