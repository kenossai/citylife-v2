<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $fillable = [
        'name',
        'role',
        'image_path',
        'bio',
        'is_featured',
        'social_instagram',
        'social_twitter',
        'social_youtube',
        'social_facebook',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
        'sort_order'  => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get bio as an array of paragraphs.
     */
    public function getBioParagraphsAttribute(): array
    {
        if (empty($this->bio)) {
            return [];
        }

        return array_filter(array_map('trim', preg_split('/\n{2,}/', $this->bio)));
    }
}
