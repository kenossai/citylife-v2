<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Speaker extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'role',
        'church',
        'bio',
        'image',
        'cover_image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/slide-1.png');
    }

    public function getCoverImageUrlAttribute(): string
    {
        return $this->cover_image
            ? asset('storage/' . $this->cover_image)
            : asset('images/slide-1.png');
    }

    public function getFirstNameAttribute(): string
    {
        return explode(' ', $this->name)[0];
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(BibleSchoolEvent::class, 'bible_school_event_speaker');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    protected static function booted(): void
    {
        static::creating(function (Speaker $speaker) {
            if (empty($speaker->slug)) {
                $speaker->slug = Str::slug($speaker->name);
            }
        });
    }
}
