<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class SermonSeries extends Model
{
    protected $table = 'sermon_series';

    protected static function booted(): void
    {
        static::creating(function (SermonSeries $series) {
            if (empty($series->slug)) {
                $series->slug = Str::slug($series->title);
            }
        });
    }

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail_path',
        'color',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    public function sermons(): HasMany
    {
        return $this->hasMany(Sermon::class)->orderByDesc('preached_at');
    }

    public function getSermonCountAttribute(): int
    {
        return $this->sermons()->count();
    }
}
