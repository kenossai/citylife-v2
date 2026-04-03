<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sermon extends Model
{
    protected $fillable = [
        'title',
        'leader_id',
        'guest_speaker_name',
        'scripture',
        'description',
        'preached_at',
        'service_label',
        'thumbnail_path',
        'video_url',
        'notes_path',
        'notes_content',
        'is_featured',
        'is_upcoming',
        'is_live',
        'auto_fetch_live',
        'youtube_channel_id',
        'is_active',
    ];

    protected $casts = [
        'preached_at'     => 'date',
        'is_featured'     => 'boolean',
        'is_upcoming'     => 'boolean',
        'is_live'         => 'boolean',
        'auto_fetch_live' => 'boolean',
        'is_active'       => 'boolean',
    ];

    public function leader(): BelongsTo
    {
        return $this->belongsTo(Leader::class);
    }

    public function getSpeakerNameAttribute(): string
    {
        return $this->guest_speaker_name ?? $this->leader?->name ?? '';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function featured(): ?self
    {
        return static::where('is_featured', true)->where('is_active', true)->latest('preached_at')->first();
    }
}
