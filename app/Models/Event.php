<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('events');
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
        'requires_payment',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'event_at'               => 'datetime',
        'is_active'              => 'boolean',
        'is_featured'            => 'boolean',
        'requires_registration'  => 'boolean',
        'requires_payment'       => 'boolean',
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
