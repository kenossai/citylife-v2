<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    protected $fillable = [
        'title',
        'speaker',
        'scripture',
        'description',
        'preached_at',
        'service_label',
        'thumbnail_path',
        'video_url',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'preached_at' => 'date',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function featured(): ?self
    {
        return static::where('is_featured', true)->where('is_active', true)->latest('preached_at')->first();
    }
}
