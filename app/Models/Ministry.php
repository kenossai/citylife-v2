<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Ministry extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('ministries');
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
        'name',
        'slug',
        'subtitle',
        'description',
        'about_text',
        'vision_quote',
        'image_path',
        'gallery_images',
        'category_label',
        'meeting_schedule',
        'location',
        'leader_name',
        'leader_role',
        'leader_image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'sort_order'     => 'integer',
        'gallery_images' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function leaders(): BelongsToMany
    {
        return $this->belongsToMany(Leader::class)->withPivot('sort_order')->orderBy('leader_ministry.sort_order');
    }
}
