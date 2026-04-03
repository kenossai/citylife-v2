<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BibleSchoolSession extends Model
{
    protected $fillable = [
        'speaker_id',
        'title',
        'slug',
        'type',
        'year',
        'duration',
        'youtube_id',
        'audio_file',
        'scripture',
        'key_verse',
        'about',
        'is_locked',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_locked'  => 'boolean',
        'is_active'  => 'boolean',
        'year'       => 'integer',
        'sort_order' => 'integer',
    ];

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speaker::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    public function scopeAudios($query)
    {
        return $query->where('type', 'audio');
    }

    public function scopeUnlocked($query)
    {
        return $query->where('is_locked', false);
    }
}
