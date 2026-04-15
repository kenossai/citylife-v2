<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class MissionPillar extends Model
{
    protected $table = 'mission_pillars';

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'description',
        'about_text',
        'vision_quote',
        'image_path',
        'gallery_images',
        'type',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'gallery_images' => 'array',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $pillar) {
            if (empty($pillar->slug) && filled($pillar->title)) {
                $pillar->slug = Str::slug($pillar->title);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function leaders(): BelongsToMany
    {
        return $this->belongsToMany(Leader::class, 'leader_mission_pillar')
            ->withPivot('sort_order')
            ->orderBy('leader_mission_pillar.sort_order');
    }
}
