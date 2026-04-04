<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class BibleSchoolEvent extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'year',
        'start_date',
        'end_date',
        'location',
        'image',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'year'       => 'integer',
        'sort_order' => 'integer',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speaker::class, 'bible_school_event_speaker');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(BibleSchoolSession::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(BibleSchoolSession::class)->where('type', 'video');
    }

    public function audios(): HasMany
    {
        return $this->hasMany(BibleSchoolSession::class)->where('type', 'audio');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming')->orderBy('start_date');
    }

    public function scopeOngoing($query)
    {
        return $query->where('status', 'ongoing')->orderBy('start_date');
    }

    public function scopePast($query)
    {
        return $query->where('status', 'past')->orderByDesc('start_date');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/slide-1.png');
    }
}
