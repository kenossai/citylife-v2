<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Sermon extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('sermons');
    }

    public function tapActivity(\Spatie\Activitylog\Models\Activity $activity, string $eventName): void
    {
        $activity->category     = 'Content Management';
        $activity->severity     = match ($eventName) {
            'deleted' => 'high',
            'created' => 'low',
            default   => 'medium',
        };
        $activity->is_sensitive = false;
    }
    protected static function booted(): void
    {
        static::creating(function (Sermon $sermon) {
            if (empty($sermon->slug)) {
                $sermon->slug = Str::slug($sermon->title);
            }
        });
    }
    protected $fillable = [
        'title',
        'slug',
        'sermon_series_id',
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
        'notes_format',
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

    public function series(): BelongsTo
    {
        return $this->belongsTo(SermonSeries::class, 'sermon_series_id');
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
